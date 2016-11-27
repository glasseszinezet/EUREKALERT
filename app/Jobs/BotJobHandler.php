<?php

namespace App\Jobs;

use App\AnswerOption;
use App\Http\Controllers\UserRequestController;
use App\Participant;
use App\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BotJobHandler implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $_requestJSON;

    /**
     * Create a new job instance.
     * @param $requestJSON
     */
    public function __construct($requestJSON)
    {
        $this->_requestJSON = $requestJSON;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::debug("Job Handler Called Starting to Examine object ");
        $requestArray = json_decode($this->_requestJSON,true);

        if (array_key_exists('entry',$requestArray) && count($requestArray['entry']) > 0)
        {
            foreach ($requestArray['entry'] as $entry)
            if (array_key_exists('messaging',$entry) && count($entry['messaging']) > 0)
                foreach ($entry['messaging'] as $messagingElement)
                {
                    $senderId = null;
                    if (array_key_exists('sender',$messagingElement))
                        $senderId = $messagingElement['sender']['id'];

                    if ($senderId != null && $senderId != "")
                    {
                        $senderProfile = self::getUserProfile($senderId);

                        $requestObject = null;
                        if (array_key_exists('postback',$messagingElement))
                        {
                            if (array_key_exists('payload',$messagingElement['postback']))
                                $requestObject = self::handlePayloads($messagingElement['postback']['payload'],$senderId,$senderProfile);

                        } else if (array_key_exists('message',$messagingElement))
                            if (array_key_exists('quick_reply',$messagingElement['message']))
                                $requestObject = self::handlePayloads($messagingElement['message']['quick_reply']['payload'],$senderId,$senderProfile);
                            else if (array_key_exists('text',$messagingElement['message']))
                                $requestObject = self::handleGreetings($messagingElement['message']['text'],$senderId,$senderProfile);

                        if ($requestObject !== null)
                        {
                            \Log::debug("Will be calling FB with ".$requestObject);
                            self::sendMessagingRequest($requestObject);
                        }
                    }


                }
        }
    }

    private function handlePayloads($payload, $senderId, $senderProfile)
    {
        \Log::debug("Handling Payload with : ".$payload);
        switch ($payload)
        {
            case "GET_STARTED_PAYLOAD":
                    return "{ \"recipient\":{ \"id\":\"".$senderId."\" }, \"message\":{ \"text\":\"Welcome ".$senderProfile['first_name']." our current poll is on the December 7, 2016 elections in GH.\", \"quick_replies\":[ { \"content_type\":\"text\", \"title\":\"GREAT. LET'S DO THIS\", \"payload\":\"GET_QUESTIONS_PAYLOAD\" }, { \"content_type\":\"text\", \"title\":\"NOT INTERESTED\", \"payload\":\"NOT_INTERESTED_PAYLOAD\"}]}}";
                break;
            case "GET_QUESTIONS_PAYLOAD":
                return self::getQuestionRequestObject(Question::find(1),$senderId);
                break;
            case "NOT_INTERESTED_PAYLOAD":
                self::sendMessagingRequest("{\"recipient\":{\"id\":\"".$senderId."\"},\"message\":{\"text\":\"Okay ".$senderProfile['first_name'].", You can still invite friends and family to partake in the polls. You can win prizes if they take part. :)\"}}");
                self::sendMessagingRequest(self::getShareCart($senderId));
                break;
            default:
                if (starts_with($payload,"QUESTION_REPLY_"))
                {
                    $previousQuestionDetails = explode("_",str_replace("QUESTION_REPLY_","",$payload));
                    UserRequestController::storeParticipantAnswer(AnswerOption::find($previousQuestionDetails[1]),Participant::where('fb_id',$senderId)->first(),Question::find($previousQuestionDetails[0]));

                    if (intval($previousQuestionDetails[0]) == Question::count())
                    {
                        self::sendMessagingRequest("{\"recipient\":{\"id\":\"".$senderId."\"},\"message\":{\"text\":\"Thanks so much ".$senderProfile['first_name'].", We really appreciate your effort. Share the following attachment with your friends/family and stand chance of winning prices.\"}}");
                        return self::getShareCart($senderId);
                    }else
                    {
                        return self::getQuestionRequestObject(Question::find((intval($previousQuestionDetails[0])+1)),$senderId);
                    }
                }else if (starts_with($payload,"GET_STARTED_VIA_SHARE_"))
                {
                    \Redis::sadd("M_BOT_SHARES_".str_replace("GET_STARTED_VIA_SHARE_","",$payload), $senderId);
                    return "{ \"recipient\":{ \"id\":\"".$senderId."\" }, \"message\":{ \"text\":\"Welcome ".$senderProfile['first_name']." our current poll is on the December 7, 2016 elections in GH.\", \"quick_replies\":[ { \"content_type\":\"text\", \"title\":\"GREAT. LET'S DO THIS\", \"payload\":\"GET_QUESTIONS_PAYLOAD\" }, { \"content_type\":\"text\", \"title\":\"NOT INTERESTED\", \"payload\":\"NOT_INTERESTED_PAYLOAD\"}]}}";
                }
                else
                {
                    return "{\"recipient\":{\"id\":\"".$senderId."\"},\"message\":{\"text\":\"Sorry ".$senderProfile['first_name'].", Couldn't find any matching your request.\"}}";
                }
                break;
        }
        return null;
    }

    private function getUserProfile($senderId)
    {

        $profile = \Redis::get("M_BOT_USER_PROFILE_".$senderId);

        if ($profile == null && $profile == "")
        {
            $requestHandler = curl_init(str_replace("@@userId@@",$senderId,str_replace("@@PAGE_ACCESS_TOKEN@@",config("custom.fb_details.pageToken"),config("custom.fb_details.userProfileEndPoint"))));
            curl_setopt($requestHandler, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($requestHandler);

            if ($return !== false)
            {
                $profile = $return;
                \Redis::set("M_BOT_USER_PROFILE_".$senderId,$profile);
                $return = json_decode($return,true);
                Participant::firstOrCreate(["fb_id" => $senderId, "first_name" => $return['first_name'], "last_name" => $return['last_name'], "gender" => $return['gender']]);
            }

        }

        return json_decode($profile,true);
    }

    private function sendMessagingRequest($requestBody)
    {

        $requestHandler = curl_init(str_replace("@@PAGE_ACCESS_TOKEN@@",config("custom.fb_details.pageToken"),config("custom.fb_details.messagingGateWay")));
        curl_setopt($requestHandler, CURLOPT_HEADER, 1);
        curl_setopt($requestHandler, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: '.strlen($requestBody)));
        curl_setopt($requestHandler, CURLOPT_POSTFIELDS, ($requestBody));
        curl_setopt($requestHandler, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($requestHandler);
        \Log::debug("Response From FB. ".$return);
    }

    private function getQuestionRequestObject(Question $question, $senderId)
    {
        $quickReplies = "";
        foreach ($question->answerOptions as $option)
            $quickReplies .= "{ \"content_type\":\"text\", \"title\":\"".$option->text."\", \"payload\":\"QUESTION_REPLY_".$question->id."_".$option->id."\" },";

        $quickReplies = substr($quickReplies,0,(strlen($quickReplies)-1));

        return "{ \"recipient\":{ \"id\":\"".$senderId."\" }, \"message\":{ \"text\":\"".$question->text."\", \"quick_replies\":[ ".$quickReplies."]}}";
    }

    private function getShareCart($senderId)
    {
        return "{ \"recipient\":{ \"id\":\"".$senderId."\" }, \"message\":{ \"attachment\":{ \"type\":\"template\", \"payload\":{  \"template_type\":\"generic\", \"elements\":[ { \"title\":\"Get Your Voice heard with GHPOLLS\", \"image_url\":\"https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQqROAh5b_LTOaShz4Ci3z6BPiCrpRMiNh7y-aGsI1aeHFn4h_H\", \"subtitle\":\"Win amazing prices whiles getting your voice across. What do you have to do? Just Take the poll and share with your friends. Click 'Get Started'\", \"buttons\":[ { \"type\":\"postback\", \"title\":\"GET STARTED\", \"payload\":\"GET_STARTED_VIA_SHARE_".$senderId."\" },{ \"type\":\"element_share\"}]}]}}}}";
    }

    private function handleGreetings($senderText, $senderId, $senderProfile)
    {
        $greetings = array("great","morning","good morning","afternoon","good afternoon","evening","good evening","hello","hi","okay","Holla","Hey","good","good bye","how are you");
        $responses = array(":)","Heya!! @@user_first_name@@. What enquiry do you have today?", "Heya!! @@user_first_name@@. What enquiry do you have today?", "Hello!! @@user_first_name@@. What enquiry do you have today?", "Hello!! @@user_first_name@@. What enquiry do you have today?", "Hello!! @@user_first_name@@. What enquiry do you have today?", "Hello!! @@user_first_name@@. What enquiry do you have today?", "Hi @@user_first_name@@, Hope you're well today", "Hi @@user_first_name@@!!, Hope you're well today", "(y)", "Holla @@user_first_name@@", "Hey @@user_first_name@@", ";)", "Bye Bye @@user_first_name@@", "Great @@user_first_name@@, you?");

       $response_index =array_search(strtolower($senderText), $greetings);
        if ($response_index !== false)
            return "{\"recipient\":{\"id\":\"".$senderId."\"},\"message\":{\"text\":\"".str_replace("@@user_first_name@@",$senderProfile['first_name'],$responses[$response_index])."\"}}";
        else
            return null;
    }
}
