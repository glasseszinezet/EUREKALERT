<?php

namespace App\Http\Controllers;

use App\AnswerOption;
use App\Participant;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
                if (\Redis::get($msisdn."_answer_expect_") == null)
                {
                    $question = Question::find(11);
                    $returnString = $question->text;

                    $returnString .= $this->getAnswerString($question);

                    \Redis::set($msisdn."_answer_expect_",$question->id);
                    \Log::debug("Returning ......".$returnString."\r\n");
                    return $returnString."\r\n";
                }else
                {
                    \Redis::del($msisdn."_answer_expect_");
                    self::storeParticipantAnswer(AnswerOption::find($user_input), $participant, Question::find(11));
                }

            }else
            {
                return "Invalid/Missing Parameters\r\n";
            }
        }else
        {
            return "Invalid/Missing Parameters\r\n";
        }
    }

    public function index()
    {
        return redirect("/");
    }
    public function store(Request $request)
    {
        \Log::debug("New Web User ".$request->getClientIp());
        $questionExists = false;
        foreach ($request->all() as $key=>$value)
        {
            if (starts_with($key,"question_"))
            {
                $questionExists = true;
                break;
            }
        }

        if ($questionExists)
        {
            \Log::debug("User Sent some questions. Going ahead to preview them");
            $requestArray = Input::except("_token");
            $questionAnswerOptions = array();
            foreach ($requestArray as $key=>$value)
            {
                if (starts_with($key,"question_"))
                {
                    $options = explode("_",$value);
                    array_push($questionAnswerOptions,array("question" => $options[0],'answerOption'=>$options[1]));
                    array_forget($requestArray,$key);
                }
            }

            \Log::debug("Done Extracting Questions and Answers");

            if ($requestArray['first_name'] == null || $requestArray['first_name'] == "")
                $requestArray['first_name'] = "WEB USER";

            \Log::debug("Getting Participant with the following details");
            \Log::debug($requestArray);

            $participant = Participant::firstOrCreate(['first_name' => $requestArray['first_name'], 'last_name' => $requestArray['last_name'], 'other_name' => $requestArray['other_name'], 'location' => $requestArray['location'],
                'occupation' => $requestArray['occupation'],  'gender' => $requestArray['gender'],'msisdn' => $requestArray['msisdn'], 'email' => $requestArray['email'],  ]);

            \Log::debug("Now Mapping Question Participant AnswerOption");
            foreach ($questionAnswerOptions as $answerOption)
            {
                self::storeParticipantAnswer(AnswerOption::find($answerOption['answerOption']),$participant,Question::find($answerOption['question']));
            }
            $request->session()->flash("success","Thanks For Partaking in the December 7th Ghana Election Polls. We are grateful");
            \Log::debug("All done. Responding to User Now");
        }else
        {
            $request->session()->flash("error","Hello, Please Answer At least one question");
            \Log::error("Web request has no questions added... Asking user to at least answer one question");
        }
        return redirect("/");
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

    public function getReportingData()
    {
        \Log::debug("Log Generator Called....");
        $result = array();
        $questions = Question::all();
        foreach ($questions as $key=>$question)
        {
            $categories = array();
            $data = array();
            foreach($question->answerOptions as $optionKey=>$option)
            {
                array_push($categories,$option->text);
                $totals = \DB::select("SELECT COUNT('answer_id') AS TOTAL FROM answer_participant_question WHERE question_id = ? AND answer_id = ?",[$question->id, $option->id]);
                array_push($data,$totals[0]->TOTAL);
            }
            array_push($result,array("questionId" => $question->id, "questionText" => $question->text, "data" => $data, "categories" => $categories));
        }
        return $result;
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
        \Log::debug($option);
        \Log::debug($participant);
        \Log::debug($previousQuestion);
         if (isset($option) && $option != null  && isset($participant) && $participant != null && isset($previousQuestion) && $previousQuestion != null)
         {
             $insertArray = array($option->id, $participant->id, $previousQuestion->id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
             \DB::insert('INSERT INTO answer_participant_question(answer_id,participant_id,question_id,created_at,updated_at) VALUES (?,?,?,?,?)', $insertArray);
         }else
         {
             \Log::debug("One option parsed is empty ");
         }

    }
}
