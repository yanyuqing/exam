<!DOCTYPE HTML>
<html>
    
    <head>
    <meta charset="UTF-8"> 
    <title>随堂小考管理平台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
   <?php
 include 'sql.php';
$USERNAME = $_POST["USERNAME"];
$PASSWORD = $_POST["PASSWORD"];
$table="stxk_teacher";
$condition=" USERNAME='".$USERNAME."' AND PASSWORD='".$PASSWORD."'";
$rs=GetAllCondition($condition,$table);
if(mysqli_num_rows($rs) == 0) die("用户名或密码错误，请<a href='login.php'>返回</a>");

?>
 <frameset rows=20%,*,10%>
<frame src="top.php?name=<?php echo $USERNAME; ?>" name="top" frameborder=0>
    <frameset cols=10%,*>
        <frame src="left.php?name=<?php echo $USERNAME; ?>" name="left" frameborder=0>
        <frame src="information.php?name=<?php echo $USERNAME; ?>" name="main" frameborder=0>
    </frameset>
<frame src="bottom.php" name="bottom" frameborder=0>
</frameset> 



 <body>
 

    </body>
</html>