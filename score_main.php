<!DOCTYPE HTML>
<html>
    <head>
    <link rel="stylesheet" href="css/text.css"/>     
    <meta charset="UTF-8"/>
    </head>
    <body>
<?php

/**
 * @author hehejeson
 * @copyright 2017
 */

include 'sql.php';

$username=$_GET["name"];

$scoretable = "stxk_score";
$coursetable = "stxk_course";
$studenttable = "stxk_student";
$questiontable = "stxk_question";
$teachertable = "stxk_teacher";

$teachercondition=" teacher='".$username."' group by COURSE";
$teacherlistrs = GetAllCondition($teachercondition,$coursetable);


echo"<div id=\"tabContent1\" class = \"tab1\">";
while ($teacherlist_row = mysqli_fetch_array($teacherlistrs, MYSQLI_BOTH))
{
	   $courselist=$teacherlist_row["COURSE"];
       echo "<h3 style =\"padding-left: 200px;\">".$courselist."</h3>";       
       $classcondition=" COURSE='".$courselist."' and teacher='".$username."' group by CLASS";
       $classlists=GetAllCondition($classcondition,$coursetable);
       
       echo"<table align = \"center\" class =\"tab2\">";
       while($classlist_row=mysqli_fetch_array($classlists, MYSQLI_BOTH))
       {
            echo "<tr><td>".$classlist_row["CLASS"]."</td><br>";
            $classlist=$classlist_row["CLASS"];
            
            $chaptercondition="select distinct CHAPTER from stxk_score INNER JOIN stxk_student on stxk_score.STUDENTID=stxk_student.ID 
            where stxk_score.COURSE='".$courselist."' and stxk_student.CLASS='".$classlist."' group by CHAPTER";
            $chapterlists=Get($chaptercondition);
           
            echo"<td>";
            while($chapterlist_row=mysqli_fetch_array($chapterlists, MYSQLI_BOTH))
            {
                echo "<a href=\"score.php?class=".$classlist."&course=".$courselist."&chapter=".$chapterlist_row["CHAPTER"]."\">".$chapterlist_row["CHAPTER"]."</a>";
                echo "&nbsp;&nbsp;";
                         
            }
                echo"</td></tr>";
       }
       echo"</table>";
}
?>
</body>
</html>