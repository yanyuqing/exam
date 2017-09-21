<!DOCTYPE HTML>
<html> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <body>
     <form action='test.php' method='GET'>
     <input type='radio' name='radio' value="eat">Eat</input>
     <input type='radio' name='radio' value='drink'>Drink</input>  
     <input type='radio' name='radio' value='sleep'>Sleep</input>  
     <input type='submit' name='search_radio' value='Button'/>  
     </form>  
       
       
       
    <?php  
    error_reporting(E_ALL ^ E_NOTICE);  
 

    $radio_name = $_GET['radio'];  

    ?>  
     <form action='test.php' method='GET'>
     <input type='radio' name='radio1' value="eat">Eat</input>
     <input type='radio' name='radio1' value='drink'>Drink</input>  
     <input type='radio' name='radio1' value='sleep'>Sleep</input>  
     <input type='submit' name='search_radio' value='Button'/>  
     </form> 
         <?php  
    error_reporting(E_ALL ^ E_NOTICE);  
 
echo $radio_name;
    echo $radio_name = $_GET['radio1'];  

    ?>
    

<form id="form1" name="form1" method="post" action="">
<p>
<label>
<input type="radio" name="RadioGroup1" value="1" />
单选</label>
1<br />
<label>
<input type="radio" name="RadioGroup1" value="2" />
单选</label>
2</p>
<p>
<label>
<input type="submit" name="Submit" value="提交" />
</label>
<br />
</p>
</form>

<?php
if($_POST )
{
echo '你选择了单选择',$_POST['RadioGroup1'];
//由于单选按钮的属性同一时间只能被选中一个就所直接把他们名字相同就OK了。
}
?>   
</body>
</html>
