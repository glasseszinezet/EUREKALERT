<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function handleUserRequests(Request $request)
    {
        \Log::debug("New Request with URI ".$request->getRequestUri());

        if ($request->has('msisdn') && $request->has('msg'))
        {
            if ($this->isValidMsisdn($request->input('msisdn')))
            {
                $msisdn = self::formatMSISDN($request->input('msisdn'));
                $participant = Participant::firstOrCreate(['msisdn' => $msisdn]);


                $user_input = strtoupper(trim($request->input('msg')));

                if (starts_with($user_input,config("custom.keyword")))
                    $user_input = substr($user_input,strlen(config("custom.keyword")),strlen($user_input));

                \Log::debug("After triming user input of keyword: ".$user_input);

                $user_level = \Redis::get($msisdn."_prev_level");

                if($user_level == null)
                {
                    \Redis::set($msisdn."_prev_level",1);
                    $question = Question::first();
                }else
                {
                    $user_level++;
                    if ($user_level > Question::all()->count())
                    {
                        \Redis::del($msisdn."_prev_level");
                        return "Thanks for partaking in our survey. We're very grateful. you can start all over by texting ".config('custom.keyword')." to ".config('custom.shortcode')." across network\r\n";
                    }else
                    {
                        $previousQuestion = Question::findOrFail(($user_level-1));
                        \Log::debug("Previous Question");
                        \Log::debug($previousQuestion);
                        if ($previousQuestion->answerOptions()->count() > 0 )
                        {
                            \Log::debug("Got answer options for the above. Proceeding");
                            if (intval($user_input) > 0 && intval($user_input) <= $previousQuestion->answerOptions()->count())
                            {
                                \Log::debug("User Input is correct. Proceeding to do mapping");
                                $count = 1;
                                foreach ($previousQuestion->answerOptions as $option)
                                {
                                    if ($count == intval($user_input))
                                    {
                                        self::storeParticipantAnswer($option, $participant, $previousQuestion);
                                        \Log::debug("Done");
                                        break;
                                    }
                                    $count++;
                                }
                            }else
                            {
                                \Log::error("User Input is wrong.... Replying");
                                return "Sorry. Your input is invalid. Please find below the question again...\r\n".$previousQuestion->text."\r\n".$returnString = $this->getAnswerString($previousQuestion);
                            }
                        }else
                        {
                            \Log::error("Previous Question doesn't have any answer options attached. this is weird :(");
                        }


                        $question = Question::findOrFail($user_level);
                        \Redis::set($msisdn."_prev_level",$user_level);
                    }

                }

                $returnString = $question->text;

                $returnString .= $this->getAnswerString($question);

                \Redis::set($msisdn."_answer_expect_",$question->id);
                return $returnString."\r\n";
            }else
            {
                return "Invalid/Missing Parameters\r\n";
            }
        }else
        {
            return "Invalid/Missing Parameters\r\n";
        }
    }

    private function isValidMsisdn($msisdn)
    {
        return $msisdn  != null && preg_match('/(00233|0233|\+233|233|0)(2|5)\d{8}/',$msisdn);
    }

    public static function formatMSISDN($msisdn)
    {
        if (starts_with($msisdn,"00233"))
        {
            $msisdn = "+".substr($msisdn,2);
        }if (starts_with($msisdn,"0233"))
    {
        $msisdn = "+".substr($msisdn,1);
    }if (starts_with($msisdn,"233"))
    {
        $msisdn = "+".$msisdn;
    }if (starts_with($msisdn,"0"))
    {
        $msisdn = "+233".substr($msisdn,1);
    }


        return $msisdn;
    }

    /**
     * @param $question
     * @return string
     */
    public function getAnswerString($question)
    {
        $returnString = "";
        $count = 0;
        foreach ($question->answerOptions as $option) {
            $count++;
            $returnString .= "\r\n" . $count . ": " . $option->text;
        }
        return $returnString."\r\nPlease prefix all answers with ".config('custom.keyword')." e.g ".config('custom.keyword')." 1";
    }

    /**
     * @param $option
     * @param $participant
     * @param $previousQuestion
     */
    public static function  storeParticipantAnswer($option, $participant, $previousQuestion)
    {
        $insertArray = array($option->id, $participant->id, $previousQuestion->id, \Carbon\Carbon::now()->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString());
        \DB::insert('INSERT INTO answer_participant_question(answer_id,participant_id,question_id,created_at,updated_at) VALUES (?,?,?,?,?)', $insertArray);
    }
}
