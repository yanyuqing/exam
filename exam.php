<!DOCTYPE HTML>
<html>
<head>
    <title>随堂小考</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>
<?php 
//error_reporting(0);

include 'sql.php';
//数据获取
$STUDENTID = $_GET["STUDENTID"];
$studentname = $_GET["studentname"];
 $chapter = $_GET["chapter"];
 $course = $_GET["course"];


$chaptercondition=" COURSE='".$course."' AND CHAPTER='".$chapter."'";
//$rs = GetAllCondition($table,$condition);
//$rs=$conn->query("select * from  group by DEPARTMENT ORDER BY DEPARTMENTORDER");
$rs = GetAllCondition($chaptercondition." order by TYPE desc,NO ",$questiontable);
if(mysqli_num_rows($rs) == 0) die("<br/>现无考试，请<a href='index.php'>返回</a>");

?>

<form action="mark_exam.php" method="post"> 
<table style='TABLE-LAYOUT: fixed' width='100%' height='17' border='1'> 
    <?php
        $answer[]=array();
        echo $STUDENTID;
        echo "<br/>";
        echo $studentname."<br/>欢迎来到<br/>--随堂小考--"; 
    echo "<br/>本场考试为".$course."课程的".$chapter."考试";
    $titlebegin="<tr><td  align='left'>";
    $titleend="</td></tr>";
    $questionbegin="<tr><td  align='left' style='WORD-WRAP: break-word' width='20'><pre>";
    $questionend="</pre></td></tr>";   
    $answerblankbegin="<tr><td  align='left'>答案：<input type='text'  required='required' name='answer[]' ";
    $answerblankend="/></td></tr>";
    $count=0;
    $answercorrect=array();
    $resultarray=array();
    while ($a_row = mysqli_fetch_array($rs, MYSQLI_ASSOC))
	{
	   $resultarray[]=$a_row;
	   $count=$count+1;
       
       //$No="第".$count."题 ";
       echo $titlebegin.$a_row['NO'].". ".$a_row['TITLE']."(".$a_row["SCORE"]."分)".$titleend;
       echo $questionbegin.$a_row['QUESTION'].$questionend;
       echo $answerblankbegin.$answer.$answerblankend;
        $answercorrect[]=$a_row['ANSWER'];
   	}
    echo count($resultarray);
    echo "=======================";
    //echo "<pre>"; print_r($resultarray);
    for($i=0;$i<count($resultarray);$i++)
    {
        echo $i."<br>";
        echo $resultarray[$i]['TITLE']."<br>";
    }
    /*
    $arr = ......;//这个是你要插入的数组
foreach( $arr as $info )
{
    $sql = "insert into  users set  username= '" . $info['username'] . "',password = '" . $info['password'] . "'  email ='" . $info['email'] . "'";
    //这里是插入数据库的语句
    */

    ?>
    
    <tr><td><input type="submit" name="btn_submit" value="提交"/></td></tr> 
    </table>
    <input type="hidden" value="<?php echo $STUDENTID ?>" name="STUDENTID"/>
    <input type="hidden" value="<?php echo $studentname ?>" name="studentname"/>
    <input type="hidden" value="<?php echo $count ?>" name="count"/>
    <input type="hidden" value="<?php echo $chapter ?>" name="chapter"/>
    <input type="hidden" value="<?php echo $course ?>" name="course"/>    
    <input type="hidden" value="<?php echo $answercorrect ?>" name="answercorrect[]"/>
    </form>
</body>
</html>
