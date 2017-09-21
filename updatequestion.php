<!DOCTYPE HTML>
<html> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>

 <?php
 $UID=$_POST["UID"];
 $course=$_POST['course'];
 $posttype = $_POST['type']; 
 $postchapter = $_POST['chapter'];
 $postno = $_POST['No'];
 $posttitle = $_POST['title'];
 $postquestion = $_POST['question'];
 $postanswer = $_POST['answer'];
 $postscore = $_POST['score'];
error_reporting(0);
include 'sql.php';
//数据获取
//$rs = GetAllCondition($table,$condition);
//$rs=$conn->query("select * from  group by DEPARTMENT ORDER BY DEPARTMENTORDER");
$sqlupdate="update stxk_question set CHAPTER='".$postchapter."',NO='".$postno."',TITLE='".$posttitle."',QUESTION='".$postquestion."',ANSWER='".$postanswer."',SCORE='".$postscore."',TYPE='".$posttype."',COURSE='".$course."' where UID='".$UID."'";

$result=Get($sqlupdate);
if($result==1){
    
        echo "试题修改成功！";
        echo"<a href=\"information.php\">返回主界面</a>";
       

}
else{
?>
试题添加失败
<a href=<?php echo $_SERVER['HTTP_REFERER']?>>返回</a>

<?php }?>
</body>
</html>
