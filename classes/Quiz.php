<?php

require_once dirname(__DIR__ ).'/classes/DB.php';

class Quiz{
    /**
     * function to insert a question in database
     */

    public function insertQuestion($ques,$ans,$type)
    {
        $db = DB::getInstance();
        $insertData  = array(
            "que"   => $ques,
            "ans"   => $ans,
            "name"  => $type
        );

        if($db->insert("Questions",$insertData))
        {
            return json_encode(array("status" => 1, "msg" => "question added successfully"));
        }else{
            return json_encode(array("status" => 0, "msg" => "database insertion failed"));
        }
    }


    /**
     * function to getQuiz Questions
     */

    public function getQuizQuestion($exercise)
    {
        $db = DB::getInstance();
        $data = $db->getQues("Questions",$exercise);
        // print_r($data[0]->que);
        $count = count($data);
        $dataToReturn = array();

        
        
        if($count > 0)
        {
            $dataToReturn['totalCount'] = $count;
            $dataToReturn['status'] = 1;
            foreach($data as $question)
            {
                $dataToReturn['questions'][] = array(
                    "question" => $question->que,
                    "id"        => $question->id
                );
            }
            shuffle($dataToReturn['questions']);
             
        }else{
            $dataToReturn['status'] = 0;
            $dataToReturn['msg'] = "no questions found";
        }
        return json_encode($dataToReturn);
    }

    /**
     * function to check answer
     */

    public function checkAnswer($id,$answer)
    {
        $db = DB::getInstance();
        $data = $db->get("Questions",array("id","=",$id))->results();
        if(count($data) == 1)
        {
            $answer = trim($answer);
            $correctAnswer = trim($data[0]->ans);

            if(strcasecmp($answer,$correctAnswer) == 0)
            {
                return json_encode(array("status" => 1, "result" => 1));
            }else{
                return json_encode(array("status" => 1, "result" => 0,"correctAnswer" => $correctAnswer));
            }
        }else{
            return json_encode(array("status" => 0, "msg" => "question id not exists"));
        }
    }
}
