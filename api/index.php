<?php

require_once dirname(__DIR__).'/classes/Quiz.php';

if(isset($_POST['s']))
{
    switch($_POST['s'])
    {
        case 'addQue':
            addQue();
            break;
        case 'checkAns':
            checkAns();
            break;
        
    }
}

if(isset($_GET['s']))
{
    switch($_GET['s']){
        case 'getQue':
            getQue();
            break;
    }
}

function addQue()
{
    if(isset($_POST['que'],$_POST['ans'],$_POST['type']))
    {
        // echo "imhere";
        $quiz = new Quiz();
        echo $quiz->insertQuestion($_POST['que'],$_POST['ans'],$_POST['type']);
    }
}

function getQue()
{
    $qno = null;
    if(isset($_GET['exercise']))
    {
        $quiz = new Quiz();
        echo $quiz->getQuizQuestion($_GET['exercise']);
    }
   
}

function checkAns()
{
    if(isset($_POST['id'],$_POST['ans']))
    {
        // echo "imhere";
        $quiz = new Quiz();
        echo $quiz->checkAnswer($_POST['id'],$_POST['ans']);
    }    
}