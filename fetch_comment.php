<?php

//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0' 
ORDER BY comment_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default" style="background: rgba(0, 0, 0, 0.1) ;color:white">
  <div class="panel-heading" style="background: rgba(0, 0, 0, 0.1) ;color:white">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body" style="background: rgba(0, 0, 0, 0.1) ;color:white">'.$row["comment"].'</div>
  <div class="panel-footer" align="right" style="background: rgba(0, 0, 0, 0.9) ;color:white"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'" style="background: rgba(0, 0, 0, 0.1) ;color:white">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px;background: rgba(0, 0, 0, 0.1) ;color:white">
    <div class="panel-heading" style="background: rgba(0, 0, 0, 0.1) ;color:white">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body" style="background: rgba(0, 0, 0, 0.1) ;color:white">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"style="background: rgba(0, 0, 0, 0.9
    ) ;color:white"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'" style="background: rgba(0, 0, 0, 0.9) ;color:white">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}

?>
