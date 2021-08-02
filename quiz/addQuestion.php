<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add question</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>
    <div style="position:relative;left:20vw;top:5vh;margin:auto;">
        <h2>Add Question Panel</h2>
    </div>
    <div class="container" style="margin:auto; width:60%;margin-top:10vh;border:1px solid black;padding:10px;">
        <div class="form-group">
            
            <label for="uname">Question:  <span><button onclick="addInput()" class="btn btn-info">Add blank</button></span> </label>
            <textarea type="text" class="form-control" id="uname" placeholder="Enter Question" name="que" required></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="ans">Answer:</label>
            <input type="text" class="form-control" id="ans" placeholder="Enter answer" name="ans" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group d-flex">
            <div class="p-2">
                <label for="exercise">Exercise</label>
                <input type="text" class="form-control" id="exercise" placeholder="exercise name" name="exercise" required>
            </div>    
        </div>

        <button type="submit" onclick="submitQuestion()" class="btn btn-primary" id="add_question_button">Submit</button>

        <div style="margin-top:50px" id="response_div">

        </div>
    </div>


    
</body>
</html>

<script type="text/javascript">

function addInput() {
    let txt = $("#uname").val();
    txt += `<input type="text" class="fill_in_holder" id="answer">`;
    $("#uname").val(txt);
    $("#uname").focus();
}

function submitQuestion() {
    let que = $("#uname").val();
    let ans = $("#ans").val();
    let exercise = $("#exercise").val();

    $("#add_question_button").prop('disabled', true);
    
    if(que.length === 0 || ans.length === 0 || exercise.length === 0) 
    {
        alert("please enter all fields");
        $("#add_question_button").prop('disabled', false);
        return;
    } 

    $.ajax({
            type:"POST",
            url: "../api/",
            data : {
                s:"addQue",
                que:que,
                ans:ans,
                type:exercise
            },
            dataType: "json",
            success: function (data){
                if(data.status === 1)
                {
                    console.log(data);
                    $("#uname").val("");
                    $("#ans").val("");
                    $("#add_question_button").prop('disabled', false);

                    $("#response_div").append(
                        `<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> Question added successfully.
                    </div>`
                    );

                }else{
                    $("#response_div").append(
                        `<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error</strong> 
                    </div>`
                    );
                }
                
            }
        });
    
}

</script>

