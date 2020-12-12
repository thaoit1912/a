<?php
//index.php

?>
<!DOCTYPE html>
<html>
 <head>
  <title>FeedBack</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>

 <body style="   background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url(2.jpeg);
    background-size: cover;">
  <br />
  <h2 align="center"><a href="index.php" style=" text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
    color: #fff6a9;
  font-size: 60px;
  text-align: center;
  animation: blink 12s infinite;
  -webkit-animation: blink 12s infinite;
  text-decoration: none;">HOME</a></h2>
  <br />
  <div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group" >
     <input style="  background: rgba(0, 0, 0, 0.5) ;color:white" type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
     <textarea style="  background: rgba(0, 0, 0, 0.5) ;color:white" name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input style="  background: rgba(0, 0, 0, 0.5) ;color:white" type="hidden" name="comment_id" id="comment_id" value="0" />
     <input style="  background: rgba(0, 0, 0, 0.5) ;color:white" type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span  id="comment_message" ></span>
   <br />
   <div id="display_comment"></div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>

