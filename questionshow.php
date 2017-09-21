<!DOCTYPE HTML>
<html>
<head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
<?php

/**
 * @author hehejeson
 * @copyright 2017
 */
 include 'sql.php';
 
 $UID=$_GET["UID"];
 $sql="select * from stxk_question where UID='".$UID."'";
 
 $questionlists=Get($sql);
 
 ?>
<div class="formbody">
<form action="updatequestion.php" method="post">
<ul class="forminfo">
 
 <?
 while($questionlists_row=mysqli_fetch_array($questionlists, MYSQLI_BOTH))
 {
    if($questionlists_row["TYPE"]=="choice")
    $typebegin="<li><label>题型</label><cite>   
            <input name='type' type='radio' value='choice' checked />单选题&nbsp;&nbsp;&nbsp;&nbsp;
            <input name='type' type='radio' value='blank'/>填空题";
    if($questionlists_row["TYPE"]=="blank")
    $typebegin="<li><label>题型</label><cite>   
            <input name='type' type='radio' value='choice'  />单选题&nbsp;&nbsp;&nbsp;&nbsp;
            <input name='type' type='radio' value='blank' checked/>填空题";
    
    $typeend="</cite></li>";  
    $coursebegin="<li><label>课程</label><input type='text' required='required' value='".$questionlists_row["COURSE"]."' name='course' class=\"dfinput\">";
    $courseend="</li>";  
    $chapterbegin="<li><label>章节</label><input type='text' required='required' value='".$questionlists_row["CHAPTER"]."' name='chapter' class=\"dfinput\"> ";
    $chapterend="</li>";
    $NObegin="<li><label>题号</label><input type='text' required='required' value='".$questionlists_row["NO"]."' name='No' class=\"dfinput\"> ";
    $NOend="</li>";
    $titlebegin="<li><label>题目</label><textarea name='title' required='required' class=\"textinput\"> ".$questionlists_row["TITLE"];
    $titleend="</textarea></li>";
    $questionbegin="<li><label>内容</label><input type='text' required='required' value='".$questionlists_row["QUESTION"]."' name='question' class=\"dfinput\"> ";
    $questionend="</li>";
    $answerbegin="<li><label>答案</label><input type='text' required='required' value='".$questionlists_row["ANSWER"]."' name='answer' class=\"dfinput\"> ";
    $answerend="</li>";
    $scorebegin="<li><label>分值</label><input type='text' required='required' value='".$questionlists_row["SCORE"]."' name='score' class=\"dfinput\"> ";
    $scoreend="</li>";
        echo $coursebegin.$courseend;
        echo $typebegin.$typeend;
        echo $chapterbegin.$chapterend;
        echo $NObegin.$NOend;
        echo $titlebegin.$titleend;
        echo $questionbegin.$questionend;
        echo $answerbegin.$answerend;
        echo $scorebegin.$scoreend;
 }

?>
<li><label>&nbsp;</label><input type="submit" name="btn_submit" value="更改" class="btn"/></td></tr> 
</ul>
    <input type="hidden" value="<?php echo $UID ?>" name="UID"/> 
</form>
    </div>
</body>
</html>