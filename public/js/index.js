$(document).ready(function (){
    
    const scoreCard = {
        correct     :   0,
        incorrect   :   0,
        total       : 0,
        currentQuestion : 0,
        question : "",
        questionId: null,
        questionBank:null,
        timer:null
    }

    const enterOperations = {
        enable:true,
        showNext:false,

    }

        //variables for timer
    var start,diff,minutes,seconds,duration;
    var countdown;
    var clearTimer = false;


    getQuestions();


    function getQuestions() {
        $.ajax({
            url: "../api/?s=getQue&exercise="+exercise,
            dataType: "json",
            success: function (data){
                console.log(data);
                if(data.status === 1)
                {
                    scoreCard.questionBank = data.questions;

                    scoreCard.total = data.totalCount;
                    scoreCard.question = scoreCard.questionBank[0].question;
                    scoreCard.questionId = scoreCard.questionBank[0].id;
                    makePage();
                }
            }
        });
    }
    

    $("#start_quiz").click(function () {
        $("#instructions_div").css({"display":"none"});
        $("#q1").removeClass("hide");
        $("#q1").fadeIn();
    

        duration = 60 * 10,
        display = document.querySelector('#time_left');
        startTimer(display);
    });


    function makePage() {
        $("#correctAns").text(scoreCard.correct);
        $("#incorrectAns").text(scoreCard.incorrect);
        let question = (scoreCard.currentQuestion + 1) + ". " + scoreCard.question;
        $("#question").html(question);
        let number = (scoreCard.currentQuestion + 1) + " of " + scoreCard.total;
        $("#number").text(number);

        $("#result_div").html(``);

        $("#operation_div").html(
            `<button class="btn btn-primary" id="check">Check<span class="fas fa-arrow-right"></span> </button> `
        );

        $("#answer").val("");

        enterOperations.enable = true;
        enterOperations.showNext = false;
        initSubmit_enter_listener();

        $("#answer").focus();

        updateProgress();
    }

    $("body").on('click', 'button[id^=check]',function(e){
        e.preventDefault();
        $(this).prop('disabled', true);
        //process this question checking
        checkCurrentAnswer();

    });

    $("body").on('click', 'button[id^=next]',function(e){
        e.preventDefault();
        // alert("next button clicked");
        $(this).prop('disabled', true);
        //process this question checking
        // checkCurrentAnswer();
        getNextQuestion();

    });

    $("body").on('click', 'button[id^=reset]',function(e){
        e.preventDefault();
        $(this).prop('disabled', true);
        location.reload();

    });

    function checkCurrentAnswer()
    {
        let answer = $("#answer").val();
        if(answer.length == 0)
        {
            alert("Please enter the answer");
            $("#check").prop("disabled",false);
            enterOperations.enable = true;
            return;
        }


        $.ajax({
            type:"POST",
            url: "../api/",
            data : {
                s:"checkAns",
                id:scoreCard.questionId,
                ans:answer
            },
            dataType: "json",
            success: function (data){
                console.log(data);
                if(data.status === 1)
                {
                    if(data.result === 1)
                    {
                        scoreCard.correct += 1;

                        $("#correctAns").text(scoreCard.correct);
                        $("#result_div").html(
                            ` <div class="alert alert-success">
                            <strong>Correct Answer!</strong>
                        </div>`
                        );
                        $("#operation_div").html(
                            `<button class="btn btn-primary" id="next">Next<span class="fas fa-arrow-right"></span> </button> `
                        );

                    }else{
                        scoreCard.incorrect += 1;
                        $("#incorrectAns").text(scoreCard.incorrect);
                        $("#result_div").html(
                            `<div class="alert alert-danger">
                            <strong>Incorrect Answer</strong> <span style="color:green;margin-left:10px">${data.correctAnswer}</span>
                        </div>`
                        );
                        $("#operation_div").html(
                            `<button class="btn btn-primary" id="next">Next<span class="fas fa-arrow-right"></span> </button> `
                        );
                    }
                    enterOperations.enable = true;
                    enterOperations.showNext  = true;

                    checkFinish();
                }

               
            }
        });
    }

    function getNextQuestion()
    {
        scoreCard.currentQuestion += 1;

        if(scoreCard.currentQuestion >= scoreCard.total)
        {
            alert("end of test");
        }else{
            scoreCard.question = scoreCard.questionBank[scoreCard.currentQuestion].question;
            scoreCard.questionId = scoreCard.questionBank[scoreCard.currentQuestion].id;
            makePage();    
        }
    }

    function updateProgress()
    {
        let current = scoreCard.currentQuestion + 1;
        let total = scoreCard.total ;

        let percentage = ((current/total)*100) + "%";
        console.log("percentage: " + percentage);
        
        $("#progress_bar").css({"width":percentage});
    }


    function checkFinish()
    {
        let current = scoreCard.currentQuestion + 1;
        let total = scoreCard.total ;
        if(current == total)
        {
            $("#operation_div").html(
                `<button class="btn btn-primary" id="view_result">View Result <span class="fas fa-arrow-right"></span> </button> `
            );

            clearTimer = true;
            enterOperations.enable = false;
            $("#view_result").click(function(){
                finishTest();
            });
           
        }
    }

    function startTimer(display) {
        start = Date.now();
        // we don't want to wait a full second before the timer starts
        timer();
        countdown = setInterval(timer, 1000);
    }

    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);
        if(clearTimer)
        {
            clearInterval(countdown);
        }

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        if(minutes === 0 && seconds === 0)
        {
            console.log("time up");
            clearInterval(countdown);
            finishTest();
        }



        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $("#time_left").text(minutes + ":" + seconds);

        // display.textContent = minutes + ":" + seconds; 

        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
        }

       
    };

    function initSubmit_enter_listener() {
        document.querySelector('#answer').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();

             if(enterOperations.enable)
             {
                enterOperations.enable = false;
                if(enterOperations.showNext)
                {
                    getNextQuestion();
                }else{
                    checkCurrentAnswer();
                }
                
             }   
            }
        });
    }

    function finishTest(){

        
        let x = (10*60) - ((minutes*60) + seconds);

        // does the same job as parseInt truncates the float
        minutes1 = (x / 60) | 0;
        seconds1 = (x % 60) | 0;

        minutes1 = minutes1 < 10 ? "0" + minutes1 : minutes1;
        seconds1 = seconds1 < 10 ? "0" + seconds1 : seconds1;


        $("#main_div").removeClass('main_div_class');
        $("#main_div").addClass('result_div_class');
        $("#main_div").html(
            `<div>
                <h4 class="modal-title">Result</h4>
            </div>
            <div>
                <div id="header_score" class="d-flex" >
                    <div class="p-2">
                        <h3 style="color:black"> <i class="far fa-check-square"></i> <span >${scoreCard.correct}</span> </h3>
                        
                    </div>
        
                    <div class="p-2" style="margin-left: 20px;">
                        <h3 style="color:black"> <i class="far fa-times-circle"></i> <span>${scoreCard.incorrect}</span> </h3>
                        
                    </div>
        
                    <div class="p-2 ml-auto" style="margin-left: 20px;">
                        <h3 style="color:black"> Time Taken : ${minutes1} : ${seconds1}</h3>
                    </div>
                </div>

                <div>
                    <h3>Total Questions - ${scoreCard.total}</h3>
                </div>

                <div>
                    <h3>Attempted - ${scoreCard.correct + scoreCard.incorrect}</h3>
                </div>

                <div>
                    <h3>Percentage - ${Math.round((scoreCard.correct * 100)/scoreCard.total)} %</h3>
                </div>

                <div>
                    <h3>Total Score - ${scoreCard.correct}/${scoreCard.total}</h3>
                </div>


            </div>
            <div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:black" id="reset">Reset</button>
            </div>`
        );

    }



});