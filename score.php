<!DOCTYPE HTML>
<html>
    
    <head>
    <meta charset="UTF-8">
    <title>随堂小考管理平台</title>
    </head>
    
<?php

/**
 * @author hehejeson
 * @copyright 2017
 */
  include 'sql.php';
  $course=$_GET["course"];
  $class=$_GET["class"];
  $chapter=$_GET["chapter"];
  $thsc;//用于记录每道题错题人数的数组；
  $th;//用于记录每列题号的数组
  
  echo "<div style=\"text-align: left;\"><strong>以下是".$class."班&nbsp".$chapter."&nbsp".$course."课程的答题情况。</strong></div><br/><br/>";
  echo"<table width=80% style=\"text-align: center;\">";
  echo"<tr><th width='100px'>姓名</th>";
  
  $sqlhang="select distinct QUID from stxk_score INNER JOIN stxk_student on stxk_score.STUDENTID=stxk_student.ID 
  where stxk_score.COURSE='".$course."' and stxk_student.CLASS='".$class."' and CHAPTER='".$chapter."'";
  $quidlists=Get($sqlhang);
  $i=0;//计数器
  
  while($quidlist_row=mysqli_fetch_array($quidlists, MYSQLI_BOTH))
  {
    echo"<th>";
    //echo $quidlist_row["QUID"];
    $sqlforNO="select NO,TYPE from stxk_question where UID='".$quidlist_row["QUID"]."'";
    //echo $sqlforNO;
    $nolists=Get($sqlforNO);
    while($nolist_row=mysqli_fetch_array($nolists, MYSQLI_BOTH))
    {
        if($nolist_row["TYPE"]=="choice")
        echo $nolist_row["NO"]."(选)";
        if($nolist_row["TYPE"]=="blank")
        echo $nolist_row["NO"]."(填)";
    }
    $th[$i]=$quidlist_row["QUID"];
    $thsc[$i]=0;
    $i++;
    echo"</th>";
  }
  $all=$i;
  $i=0;
  echo"<th>分数</th>";
  echo"</tr>";
  
  $sqllie="select distinct ID,NAME from stxk_score INNER JOIN stxk_student on stxk_score.STUDENTID=stxk_student.ID 
  where stxk_score.COURSE='".$course."' and stxk_student.CLASS='".$class."' and CHAPTER='".$chapter."'";
  $idlists=Get($sqllie);
 $numofstudent=0;
  while($idlist_row=mysqli_fetch_array($idlists, MYSQLI_BOTH))
  {
    echo"<tr><td width='100px'>".$idlist_row["NAME"]."</td>";
    $numofstudent++;
    $allscore=0;
    while($i!=$all)
    {
        $sql="select * from stxk_score where STUDENTID='".$idlist_row["ID"]."' and QUID='".$th[$i]."'";
        $lists=Get($sql);
         while($list_row=mysqli_fetch_array($lists, MYSQLI_BOTH))
         {
            if($list_row["CORRECT"]=="0")
            {
                echo "<td><div style=\"color:#F00\">".$list_row["CORRECT"]."</div></td>";
                $thsc[$i]++;
            }
            
            else
            {
                $sqlforscore="select * from stxk_question where UID='".$th[$i]."'";
                $listsforsc=Get($sqlforscore);
                while($listforsc_row=mysqli_fetch_array($listsforsc, MYSQLI_BOTH))
                {
                    $sc=$listforsc_row["SCORE"];
                    $allscore=$allscore+$sc;
                }
                echo"<td>".$list_row["CORRECT"]."</td>";
                
            } 
         }
         $i++;
     }
     echo"<td>".$allscore."</td></tr>";
     $i=0;
  }
  echo"<tr><td>错题数目</td>";
  for($w=0;$w<$all;$w++)
  {
    echo "<td><a href='questionshow.php?UID=".$th[$w]."'>".$thsc[$w]."</a></td>";
  }
  echo"<td>共".$numofstudent."人</td>";
  echo"</tr>";
  echo"</table><br /><br /><br /><br />";
  
  
   
?>
<body>

</body>

</html>