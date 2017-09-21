<!DOCTYPE HTML>
<html> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>

 <?php
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
$result=InsertQuestion($course,$posttype,$postchapter,$postno,$posttitle,$postquestion,$postanswer,$postscore);
if($result==1){
    
        echo "试题添加成功      ";
        echo"<a href=\"input.php\">继续添加</a>     ";
        echo"<a href=\"information.php\">结束添加</a>";
       

}
else{
?>
试题添加失败
<a href=<?php echo $_SERVER['HTTP_REFERER']?>>返回</a>

<?php }?>
</body>
</html>
