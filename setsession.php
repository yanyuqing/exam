<?php
session_start();
include 'sql.php';
$STUDENTID = $_POST["STUDENTID"];
$studentname = $_POST["studentname"];
$chapter = $_POST["chapter"];
$course = $_POST["course"];

if($_POST["start"]) $start=$_POST["start"];
else $start=0;
$a=1;
$chaptercondition=" COURSE='".$course."' AND CHAPTER='".$chapter."'";
$table = "stxk_question";
$rs1 = GetAllCondition($chaptercondition."order by NO",$table);
$rs = GetAllCondition($chaptercondition."order by NO limit $start,$a",$table);
if($_POST["all"]) $all=$_POST["all"];
else $all=mysqli_num_rows($rs1);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="refresh" content="0.5;url=http://sistlab.applinzi.com/exam/exam_choice_blank.php?STUDENTID=<?php echo $STUDENTID?>&studentname=<?php echo $studentname?>&course=<?php echo $course?>&chapter=<?php echo $chapter?>&all=<?php echo $all?>&start=<?php echo $start?>" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
 <body>
<?php
    if($_POST["answer"])
    {
        
        $_SESSION["answer".$start]=$_POST["answer"];
        //echo $_SESSION["answer".$start]."is now session's value.";
        
    }
?>
</body>
</html>