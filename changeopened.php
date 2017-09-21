<!DOCTYPE HTML>
<html> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>
<?php

/**
 * @author hehejeson
 * @copyright 2017
 */


$chapter=$_GET["chapter"];
$course=$_GET["course"];
$opened=$_GET["opened"];
include 'sql.php';
$result=UpdateOpened($course,$chapter,$opened);

if($result==1){
    
        echo "操作成功<br>";
        echo"<a href=\"manager.php\">继续操作</a> &nbsp;&nbsp;  ";
        echo"<a href=\"information.php\">结束操作</a>";
       

}
else{
?>
试题添加失败
<a href=<?php echo $_SERVER['HTTP_REFERER']?>>返回</a>

<?php }?>

</body>
</html>