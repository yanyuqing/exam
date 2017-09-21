<!DOCTYPE HTML>
<html>
<head> 
    <title>随堂小考</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>
 
 <?php
include 'sql.php';
$STUDENTID = $_POST["STUDENTID"];
//$table = "stxk_student";
$condition=" ID=".$STUDENTID." ";
$studentidrs=GetAllCondition($condition,$studenttable);

if(mysqli_num_rows($studentidrs) == 0) die("查无此人，请<a href='index.php'>返回</a>");
    while ($s_row = mysqli_fetch_array($studentidrs, MYSQLI_BOTH))
       {
            $studentname=$s_row["NAME"];
            $studentclass=$s_row["CLASS"];        
       }
?>
<br />

<!--
<form action='exam.php' method='post'>
-->
<?php
        echo $STUDENTID;
        echo "<br/>";
        echo $studentname."<br/>欢迎来到<br/>--随堂小考--";
        echo "<br/>";
        


$coursers=GetAllCondition(" CLASS='".$studentclass."'",$coursetable);
while ($course_row = mysqli_fetch_array($coursers, MYSQLI_BOTH))
	{
	   
	   echo "课程：";
	   echo $course=$course_row["COURSE"];     
       echo "<br/>";
       $chapterrs=GetAllCondition(" COURSE='".$course."' and OPENED='0' GROUP BY CHAPTER",$questiontable);
       while ($chapter_row = mysqli_fetch_array($chapterrs, MYSQLI_BOTH))
	   {
	       echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    	   echo $chapter=$chapter_row["CHAPTER"];       
           
           $scoresqlstr="SELECT q.SCORE,s.CORRECT FROM stxk_question as q,stxk_score as s where q.UID=s.QUID AND s.STUDENTID='".$STUDENTID."' AND s.CHAPTER='".$chapter."' AND s.COURSE='".$course."' ";
           $scorers=GetQuery($scoresqlstr);
           
           if(mysqli_num_rows($scorers)==0)
           {                
               echo "&nbsp;<a href='exam_choice_blank.php?STUDENTID=$STUDENTID&studentname=$studentname&course=$course&chapter=$chapter'>参加考试</a>";
               
           }
           else
           {
                $sumscore=0;
                while ($score_row = mysqli_fetch_array($scorers, MYSQLI_BOTH))
                  {
                    $sumscore=$sumscore+$score_row["SCORE"]*$score_row["CORRECT"];                    
                  }
                echo " 得分".$sumscore;
           }
           echo "<br/>";
    	}
        
	}

?>    
<!--
<input type="hidden" value="<?php //echo $STUDENTID ?>" name="STUDENTID"/>
<input type="hidden" value="<?php //echo $studentname ?>" name="studentname"/>
<input type="submit" name="btn_submit" value="进行考试">
</form>
-->
 
 </body>
 </html>
 