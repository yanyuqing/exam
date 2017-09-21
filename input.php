<!DOCTYPE HTML>
<html>
<head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
<?php
error_reporting(0);
include 'sql.php';
//数据获取
$table = "stxk_question";
//$condition="TIME=1";
//$rs = GetAllCondition($table,$condition);
//$rs=$conn->query("select * from  group by DEPARTMENT ORDER BY DEPARTMENTORDER");
$rs = GetAll($table);
?>
<div class="formbody">
<form action="insert_question.php" method="post">
<ul class="forminfo">
    <?php
    $typebegin="<li><label>题型</label><cite>   
            <input name='type' type='radio' value='choice' checked />单选题&nbsp;&nbsp;&nbsp;&nbsp;
            <input name='type' type='radio' value='blank'/>填空题";
    $typeend="</cite></li>";  
    $coursebegin="<li><label>课程</label><input type='text' required='required' name='course' class=\"dfinput\">";
    $courseend="</li>";  
    $chapterbegin="<li><label>章节</label><input type='text' required='required' name='chapter' class=\"dfinput\"> ";
    $chapterend="</li>";
    $NObegin="<li><label>题号</label><input type='text' required='required' name='No' class=\"dfinput\"> ";
    $NOend="</li>";
    $titlebegin="<li><label>题目</label><input type='text' required='required' name='title' class=\"dfinput\"> ";
    $titleend="</li>";
    $questionbegin="<li><label>内容</label><textarea name='question' required='required' class=\"textinput\"> ";
    $questionend="</textarea></li>";
    $answerbegin="<li><label>答案</label><input type='text' required='required' name='answer' class=\"dfinput\"> ";
    $answerend="</li>";
    $scorebegin="<li><label>分值</label><input type='text' required='required' name='score' class=\"dfinput\"> ";
    $scoreend="</li>";
        echo $coursebegin.$courseend;
        echo $typebegin.$typeend;
        echo $chapterbegin.$chapterend;
        echo $NObegin.$NOend;
        echo $titlebegin.$titleend;
        echo $questionbegin.$questionend;
        echo $answerbegin.$answerend;
        echo $scorebegin.$scoreend;
       //$answer="name='answer[]' value='".$count."'";
	   /*echo $titlebegin.$No.$a_row['TITLE'].$titleend;
       echo $questionbegin.$a_row['TEXT'].$questionend;
       echo $answerbegin.$answer.$answerend;*/

    ?>
    
    <li><label>&nbsp;</label><input type="submit" name="btn_submit" value="提交" class="btn"/></td></tr> 
    </ul>
    <input type="hidden" value="<?php echo $count ?>" name="count"/> 
    </form> 
    </div>
</body>
</html>
