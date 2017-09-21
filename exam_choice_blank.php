<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>
<?php 
//error_reporting(0);
$type;
include 'sql.php';
//数据获取
//$STUDENTID = $_POST["STUDENTID"];
//$studentname = $_POST["studentname"];
//$start=$_GET["start"];
//$all=$_GET["all"];
//$start;
//$all;
$STUDENTID = $_GET["STUDENTID"];
$studentname = $_GET["studentname"];
$chapter = $_GET["chapter"];
$course = $_GET["course"];

if($_GET["start"]) $start=$_GET["start"];
else $start=0;
$a=1;
$chaptercondition=" COURSE='".$course."' AND CHAPTER='".$chapter."'";

echo "<br/>";

$table = "stxk_question";

//$rs = GetAllCondition($table,$condition);
//$rs=$conn->query("select * from  group by DEPARTMENT ORDER BY DEPARTMENTORDER");
$rs1 = GetAllCondition($chaptercondition."order by NO",$table);
$rs = GetAllCondition($chaptercondition."order by NO limit $start,$a",$table);
if($_GET["all"]) $all=$_GET["all"];
else $all=mysqli_num_rows($rs1);
if(mysqli_num_rows($rs) == 0) die("<br>现无考试，请<a href='index.php'>返回</a>");
?>


<table style='TABLE-LAYOUT: fixed' width='100%' height='17' border='1'> 
 <form action="setsession.php"  id="exam_turn" method="post">
    <?php
        $answer[]=array();
        echo $STUDENTID;
        echo "<br>";
        echo $studentname."<br>欢迎来到<br>--随堂小考--"; 
    
    $titlebegin="<tr><td  align='left'>";
    $titleend="</td></tr>";
    $questionbegin="<tr><td  align='left' style='WORD-WRAP: break-word' width='20'><pre>";
    $questionend="</pre></td></tr>";
    
    
    
    $answercorrect=array();
    while ($a_row = mysqli_fetch_array($rs, MYSQLI_BOTH))
	{
	
	   
       $answerchoicebegin="<tr><td  align='left'>答案:<label><input name='answer' type='radio' value='A' />A</label>
            <label><input name='answer' type='radio' value='B' />B</label>
            <label><input name='answer' type='radio' value='C' />C</label>
            <label><input name='answer' type='radio' value='D' />D</label>";
       $answerchoiceend="</td></tr>";
       $answerblankbegin="<tr><td  align='left'>答案：<input type='text'  required='required' name='answer' ";
       $answerblankend="/></td></tr>";
       $count=$count+1;
       //$No="第".$count."题 ";
       echo $titlebegin.$a_row['NO'].". ".$a_row['TITLE']."(".$a_row["SCORE"]."分)".$titleend;
       echo $questionbegin.$a_row['QUESTION'].$questionend;
       $type=$a_row["TYPE"];
       
       
        //$answercorrect[]=$a_row['ANSWER'];
       
   
	}
    $all=$all-1;
    if($all>0){
        //echo $_SESSION["answer".$start];
        $newstart=$start+1;
        if($type=="choice")
       {
       echo $answerchoicebegin.$answerchoiceend;
       }
       else
       {
       echo $answerblankbegin.$answerblankend;  
       }
    ?>
    
    </table>
    
    <input type="hidden" value="<?php echo $all ?>" name="all"/>
    <input type="hidden" value="<?php echo $newstart ?>" name="start"/>
    <input type="hidden" value="<?php echo $STUDENTID ?>" name="STUDENTID"/>
    <input type="hidden" value="<?php echo $chapter ?>" name="chapter"/>
    <input type="hidden" value="<?php echo $course ?>" name="course"/>
    <input type="hidden" value="<?php echo $studentname ?>" name="studentname"/>
    
    <?php
        
        echo "<input type=\"submit\" name=\"btn_submit\" value=\"下一页\"/>";
        //echo"<tr><td><a href=\"exam_choice_blank.php?STUDENTID=".$STUDENTID."&studentname=".$studentname."&course=".$course."&chapter=".$chapter."&all=".($all+1)."&start=".$start.">上一页</a></td></tr>";
        
    }
    else{
    //echo $_SESSION["answer".$start];
    $newstart=$start+1;
    ?>
    </form>
    
    <form action="mark_exam.php"  id="exam_choice" method="post">
    <input type="hidden" value="<?php echo $newstart ?>" name="start"/>
    <input type="hidden" value="<?php echo $STUDENTID ?>" name="STUDENTID"/>
    <input type="hidden" value="<?php echo $chapter ?>" name="chapter"/>
    <input type="hidden" value="<?php echo $course ?>" name="course"/>
    <input type="hidden" value="<?php echo $studentname ?>" name="studentname"/>
    <? 
        if($type=="choice")
       {
       echo $answerchoicebegin.$answerchoiceend;
       }
       else
       {
       echo $answerblankbegin.$answerblankend;  
       }
    echo "<tr><td><input type=\"submit\" name=\"btn_submit\" value=\"提交\"/></td></tr>";
    }
    ?>
    </form>
    <?php
    if($start==0)
        {echo"啥都没得！";}
    else{
        $newall=$all+2;
        $startnow=$start-1;
        echo"<a href='exam_choice_blank.php?STUDENTID=".$STUDENTID."&studentname=".$studentname."&course=".$course."&chapter=".$chapter."&all=".$newall."&start=".$startnow."'><button>上一页</button></a>&nbsp;&nbsp;&nbsp;";
        }
    ?>
</body>
</html>
