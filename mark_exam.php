<?php 
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>
 <?php 
 error_reporting(0);
include 'sql.php';
$STUDENTID = $_POST["STUDENTID"];
$studentname = $_POST["studentname"];
//$count=$_POST['count']; 

//$postedanswer = $_POST['answer'];
//$postedanswercorrect = $_POST['answercorrect'];

$Postchapter = $_POST["chapter"];
$Postcourse = $_POST["course"];
if($_POST["start"]) $start=$_POST["start"];
if($_POST["answer"])
{   
$_SESSION["answer".$start]=$_POST["answer"];
// echo "answer".$start."session是".$_SESSION[$name.$start];
        
 }
$chaptercondition=" COURSE='".$Postcourse."' AND CHAPTER='".$Postchapter."'";

$againtestrs=GetAllCondition($chaptercondition." AND STUDENTID='".$STUDENTID."'",$scoretable);
if(mysqli_num_rows($againtestrs)!= 0) die("<br/>您已参加过此次考试，请<a href='index.php'>返回</a>");

//$chaptercondition="CHAPTER='第六章'";
$questiontable="stxk_question";
$rs = GetAllCondition($chaptercondition."order by NO",$questiontable);
$answercorrect[]=array();
$UID[]=array();
$chapter[]=array();
$count=mysqli_num_rows($rs);
while ($a_row = mysqli_fetch_array($rs, MYSQLI_BOTH))
{    
      $answercorrect[]= $a_row['ANSWER'];
      $UID[]=$a_row['UID']; 
      //$chapter[]=$a_row['CHAPTER'];
      
}

echo $_SESSION["answer1"];
?>
<table style='TABLE-LAYOUT: fixed' width='100%' height='17' border='1'>
  <tr>
            <th>题号</th>
            <th>评判</th>
        </tr>
<?php
$rightcount=0;
$wrongcount=0;
$wr;
$wrboolean;
for ($x=0; $x<$count; $x++) {
    $No=$x+1;
    if(strtolower(trim($_SESSION["answer".$No]))==strtolower(trim($answercorrect[$No])))
           {
            $wr="正确";
            $rightcount=$rightcount+1;
            $wrboolean=1;
           }
          else
            {
            $wr="错误";
            $wrongcount=$wrongcount+1;
            $wrboolean=0;   
            }
    echo "  <tr><td>".$No."</td><td>".$wr."</td></tr>";
    insertscore($STUDENTID,$UID[$No],$wrboolean,$Postchapter,$Postcourse);   
  }
?>
</table>
正确数量：<?php echo $rightcount ?>
<br/>
错误数量：<?php echo $wrongcount ?>

<br />
<div style="text-align: right;">
<form action="check.php" method="post">
<input type="hidden" name="STUDENTID" value="<?php echo $STUDENTID?>" /><br />
<input type="submit" value="返回"/>
</form>
</div>
</body>
</html> 