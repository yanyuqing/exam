
<!DOCTYPE HTML>
<html>
    
    <head>
    <link rel="stylesheet" href="css/text.css"/>     
    <meta charset="UTF-8">
    <style>
        #round{
        width:400px;
        height:200px;
        }
        #round p{
            color:#f00;
            }
            </style>
    <title>top</title>
    </head>
    
    
    <body style="overflow:-Scroll;overflow-y:hidden" >

     <?php
    $USERNAME=$_GET["name"];
    ?>
    <div id = tabDiv>
    <div id = tabsHead class = "cla7">
		&nbsp;&nbsp;&nbsp;&nbsp;<a id = " tabs1" class = "tex1" href="manager.php?name=<?php echo $USERNAME; ?>" target="main">试题控制</a>&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;<a id = " tabs2" class = "tex1" href="input.php?name=<?php echo $USERNAME; ?>" target="main">试题管理</a>&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;<a id = " tabs3" class = "tex1" href="score_main.php?name=<?php echo $USERNAME; ?>" target="main">成绩查看</a>&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
    </div>

	

    
        </body>
</html>