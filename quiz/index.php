<?php

if(isset($_GET['exercise']))
{
    $exercise = $_GET['exercise'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../public/css/index.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    const exercise = "<?php echo $exercise; ?>";
</script>

<script src="../public/js/index.js" type="text/javascript"></script>
</head>
<body>



<div class="main_div_class"  id="main_div">

    <div class="modal-content" id="instructions_div">

        <!-- Modal Header -->
        <div class="modal-header">
        <h4 class="modal-title">Instructions</h4>
        
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">First item</li>
                    <li class="list-group-item">Second item</li>
                    <li class="list-group-item">Third item</li>
                    <li class="list-group-item">Fourth item</li>
                    <li class="list-group-item">First item</li>
                    <li class="list-group-item">Second item</li>
                    <li class="list-group-item">Third item</li>
                    <li class="list-group-item">Fourth item</li>
                </ul>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" style="color:black" id="start_quiz">Start</button>
        </div>

    </div>

    <div class="wrap hide" id="q1">
        <div style="margin-bottom: 5vh;">
            <div id="header_score" class="d-flex" >
                <div class="p-2">
                    <h3 style="color:black"> <i class="far fa-check-square"></i> <span id="correctAns">0</span> </h3>
                    
                </div>

                <div class="p-2" style="margin-left: 20px;">
                    <h3 style="color:black"> <i class="far fa-times-circle"></i> <span id="incorrectAns">0</span> </h3>
                    
                </div>

                <div class="p-2 ml-auto" style="margin-left: 20px;">
                    <h3 style="color:black"> Time Left : <span id="time_left"></span></h3>
                    
                </div>

            </div>

            <div class="progress">
                <div class="progress-bar bg-info" id="progress_bar" style="width:0%"></div>
            </div>
        </div>


        <div class="text-center pb-4">
            <div class="h5 font-weight-bold"><span id="number"> </span></div>
        </div>
        <div class="h4 font-weight-bold" id="question"> 1. Who is the Prime Minister of India?</div>
     
        <div class="pt-4" id="result_div" style="min-height: 80px">
            
        </div>
        <div class="d-flex justify-content-end pt-2" id="operation_div"> 
          
        </div>
    </div>
</div>


<div style="position:absolute; left:5vw;bottom:1vh;">
    <div class="h3 font-weight-bold text-white">Go Dark</div> <label class="switch"> <input type="checkbox"> <span class="slider round"></span> </label>
</div>




<script>

 
    document.addEventListener('DOMContentLoaded', function() {
        const main = document.querySelector('body')
        const toggleSwitch = document.querySelector('.slider')
        toggleSwitch.addEventListener('click', () => {
            main.classList.toggle('dark-theme')
        })
    })
</script>
    
</body>
</html>


