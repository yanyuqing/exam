<!DOCTYPE HTML>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<style type="text/css">
		.table{
			width: 100%;
			border-collapse:collapse; 
			border-spacing:0; 
		}
		.fixedThead{		  
			display: block;
			width: 100%;
		}
		.scrollTbody{
			display: block;
			height: 262px;
			overflow: auto;
			width: 100%;
		}
		.table td,.table th {
            text-align:center;
			width:100px;
			border-bottom: none;
			border-left: none;
			border-right: 1px solid #CCC;
			border-top: 1px solid #DDD;
			
		}
		.table tr{
			border-left: 1px solid #EB8;
			border-bottom: 1px solid #B74;
		}
		thead.fixedThead tr th:last-child {
			color:#FF0000;
			width:100px;
		}
	</style>
    
</head>
<body>
<?php
//error_reporting(0);
include 'sql.php';
//数据获取

$username=$_GET["name"];


$scoretable = "stxk_score";
$coursetable = "stxk_course";
$studenttable = "stxk_student";
$questiontable = "stxk_question";
$teachertable = "stxk_teacher";
/*
$coursecondition=" teacher='".$username."' group by COURSE";
$coursers = GetAllCondition($coursecondition,$coursetable);
$course_array[]=array();
if(mysqli_num_rows($coursers) == 0) die("<br/>无课程，请<a href='index.php'>返回</a>");
while ($course_row = mysqli_fetch_array($coursers, MYSQLI_BOTH))
	{
	   echo $course_array[]=$course_row["COURSE"];
       echo "<br/>";
	}
    
$classcondition=" teacher='".$username."' group by class";
$classrs = GetAllCondition($classcondition,$coursetable);
$class_array[]=array();
if(mysqli_num_rows($classrs) == 0) die("<br/>无班级，请<a href='index.php'>返回</a>");
while ($class_row = mysqli_fetch_array($classrs, MYSQLI_BOTH))
	{
	   echo $class_array[]=$class_row["CLASS"];
       echo "<br/>";
	} 
    
$summaryrs=MyQuery($username);
$summary_array[]=array();
if(mysqli_num_rows($summaryrs) == 0) die("<br/>无成绩，请<a href='index.php'>返回</a>");
echo mysqli_num_rows($summaryrs);
while ($summary_row = mysqli_fetch_array($summaryrs, MYSQLI_BOTH))
	{
	   echo $summary_array[]=$summary_row["CLASS"];
       echo "<br/>";
	}  
*/    



$teachercondition=" teacher='".$username."' group by COURSE";
$teacherlistrs = GetAllCondition($teachercondition,$coursetable);



while ($teacherlist_row = mysqli_fetch_array($teacherlistrs, MYSQLI_BOTH))
{
	   $courselist=$teacherlist_row["COURSE"];
       echo "<h4>".$courselist."</h4>";
?>
       

<!--
<table border='1' class="table">
-->
<?php

    $coursecondition="  COURSE='".$courselist."' group by CHAPTER";
    $chapterlistrs = GetAllCondition($coursecondition,$questiontable);
    while ($chapterlist_row = mysqli_fetch_array($chapterlistrs, MYSQLI_BOTH))
	{
	    $chapterlist=$chapterlist_row["CHAPTER"];
        //echo "<tr><th>".$chapterlist."随堂考试</th></tr>";
        echo $chapterlist."随堂考试";
        
        $chaptercondition=" AND sco.CHAPTER='".$chapterlist."' group by CLASS";
        $classlistrs = SummaryQuery($chaptercondition);
        $questionNo=CountQuery(" CHAPTER='".$chapterlist."'",$questiontable); 
        //echo " <thead class='fixedThead'>";
        while ($classlist_row = mysqli_fetch_array($classlistrs, MYSQLI_BOTH))
	       {
	          // if(mysqli_num_rows($classlist_row)!=0)
               {
	            $classlist=$classlist_row["CLASS"];
                $studetnNo= CountQuery(" CLASS='".$classlist."'",$studenttable);
                
                echo "<table border='1' class='table'>";
                //echo "<thead class='fixedThead'>";
               
                //$echostring ="<tr><th>班级</th><td>学号</td><td>姓名</td>";
                $echostring ="<tr><th>班级</th><th>姓名</th>";
                for($number=1;$number<=$questionNo;$number++)
                {
                    $echostring=$echostring."<th>".$number."</th>";
                } 
                       
                echo $echostring."<td>总分</td></tr>";
                
                //echo "</thead>";
                //echo "<tbody class='scrollTbody'>";
                
                $classcondition="  CLASS='".$classlist."' group by ID";                
                $idlistrs = GetAllCondition($classcondition,$studenttable);
                $rowspan=$studetnNo+3;
                
                echo "<td rowspan='".$rowspan."' valign='top' >".$classlist."</td>";
                echo "<tr>";
                
                $countarray[]=array();
                for($i=1;$i<=$questionNo;$i++)
                    $countarray[$i]=0; 
                                                 
                $average=0; 
                $studentNo=mysqli_num_rows($idlistrs);    
                           
                while ($idlist_row = mysqli_fetch_array($idlistrs, MYSQLI_BOTH))
        	       {
        	           
        	           $idlist=$idlist_row["ID"];
                       $studentname=$idlist_row["NAME"];
                                                                                                                         
                       echo "<td>".$studentname."</td>";
                                              
            	       $idcondition=" AND sco.COURSE='".$courselist."' AND sco.CHAPTER='".$chapterlist."' AND std.ID='".$idlist."' order by NO";
                       $scorelistrs =  SummaryQuery($idcondition);
                       
                       $sumscore=0;
                       $countarrayi=1;

                       while ($scorelist_row = mysqli_fetch_array($scorelistrs, MYSQLI_BOTH))
                	       {     
                	           $countarray[$countarrayi]=$countarray[$countarrayi]+$scorelist_row["CORRECT"];
                               $countarrayi=$countarrayi+1;
                               
                	           $score=$scorelist_row["CORRECT"]*$scorelist_row["SCORE"];
                	           $sumscore=$sumscore+$score;

                               if($score==0)
                               {
                                    echo "<td style='color:red';>".$score."</td>";
                               }
                               else
                               {
                                    echo "<td style='color:green';>".$score."</td>";
                               }
                            }                             
                        echo "<th >".$sumscore."</th></tr>";               
                        $average=$average+$sumscore;       
                    }
                    $average=$average/$studentNo;
                    echo "<tr><th>题号</th>";
                    for($number=1;$number<=$questionNo;$number++)
                    {
                        echo "<th>".$number."</th>";
                    } 
                    echo "<th>平均分</th></tr>";
                    echo "<tr><td>正确数量</td>";
                    for($i=1;$i<=$questionNo;$i++)
                        echo "<td>".$countarray[$i]."</td>";
                    echo "<td>".sprintf('%.1f', $average)."</td></tr>";
                     
                    //echo "</tbody>";                    
            	}  
        
        } 
	}
}
?>
</table>
 </body>
 </html>