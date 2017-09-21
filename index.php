<!DOCTYPE HTML>
<html> 
<head>
    <title>随堂小考</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/style.css"/>
 </head>
 <body>
<div class= "cla1">
    <form action="check.php" method="post" >
            <p class= "cla2">Contact</p>
            <p class= "cla3"><input type="text" name="STUDENTID" placeholder= "请输入学号" style= "width: 200px;height: 20px;"/></p>
            <p class= "cla4"><input type="submit" value= "登录" style= "width: 100px;height: 30px;"/></p>     
    </form>
 </div>
<?php
/*
$url = "http://sist.stdu.edu.cn/sy/templates/ja_purity/kcap_stop.php";
$contents = file_get_contents($url);
//如果出现中文乱码使用下面代码
$contents = iconv("gb2312", "utf-8",$contents);
echo $contents;
echo "<br>";
//if (preg_match("/[\x7f-\xff]/", $str))  判断字符串里是否有中文
$hello = explode(" ",$contents);
print_r($hello);
for($i=14;$i<count($hello);$i++)
{
    if($hello[$i]=="")
    {
        while(!preg_match("/[\x7f-\xff]/",$hello[$i+4])&&$i<count($hello))
        {
            $i=$i+4;
            echo $hello[$i]."我TM进来了";
			$newarray=$newarray.$hello[$i];
        }
        $i=$i+4;
        echo $hello[$i];
		$newarray=$newarray."-".$hello[$i];
    }
    else 
	{	
		echo $hello[$i];
		$newarray=$newarray.$hello[$i]."|";
	}

}
//$hello= array_filter($hello);
//print_r($hello);

//$hello = explode(' ',$contents);
/*for($i=0;$i<strlen($contents);$i++)
{echo $contents[$i];}

/*for($i=0;$i<strlen($contents);$i++)
{
    if($contents[$i]=='>')
    {
        $i++;
        if(is_numeric($contents[$i]))
        {
            $c_begin;
            switch($contents[$i])
            {
                case 1:
                $c_begin=date("Y-m-d")." 8:00:00";
                break;
                case 3:
                $c_begin=date("Y-m-d")." 10:10:00";
                break;
                case 5:
                $c_begin=date("Y-m-d")." 14:00:00";
                break;
                case 7:
                $c_begin=date("Y-m-d")." 16:10:00";
                break;                    
            }
            
            if($contents[$i]=='-')
            {
                $i++;
                if(is_numeric($contents[$i]))
                {
                    $c_over;
                    switch($contents[$i])
                    {
                        case 2:
                        $c_over=date("Y-m-d")." 9:50:00";
                        break;
                        case 4:
                        $c_over=date("Y-m-d")." 12:00:00";
                        break;
                        case 6:
                        $c_over=date("Y-m-d")." 15:50:00";
                        break;
                        case 8:
                        $c_over=date("Y-m-d")." 18:00:00";
                        break;                    
                    }
                    $i++;
                    while(!is_numeric($contents[$i]))
                    {
                       $i++; 
                    }
                    $cname=$contents[$i];
                    $i++;
                    $cname.=$contents[$i];
                    $i++;
                    $cname.=$contents[$i];
                    update($c_begin,$c_over,$cname);
                }
            }
            
        }
        
    }
}

function update($c_begin,$c_over,$cname)
{
    $mysqli=new mysqli("localhost","hehejeson","hjxhzz864357","hehejeson");

    if(mysqli_connect_errno())
    {
	   printf("Connect failed:  ",mysqli_connect_errno());
	   exit();
    }
    else
    {
        
	   $sql="update class set c_begin='$c_begin',c_over='$c_over' where cname='$cname'";
       mysqli_query($mysqli,"set names 'utf-8'");
	   $mysqli->set_charset("utf8");
	   $res=mysqli_query($mysqli,$sql);

	   if($res===true)
   	    {
		  header("Location:success.html");
		  exit;
	   }
	   else
	   {
		  printf("could not insert record :", mysqli_errno($mysqli));
	   }
	   mysqli_close($mysqli);
    }
}
*/
?> 
 </body>
 </html>
 