
<?php


//error_reporting(0); 
//error_reporting(E_ALL ^ E_DEPRECATED);
//$conn=mysql_connect(SAE_MYSQL_HOST_M.":".SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);//函数打开非持久的 MySQL 连接。
$conn=new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);//函数打开持久的 MySQLi 连接。
  
//$chaptercondition="CHAPTER='第六章'";

$scoretable = "stxk_score";
$coursetable = "stxk_course";
$studenttable = "stxk_student";
$questiontable = "stxk_question";
$teachertable = "stxk_teacher";

//$conn->select_db('SAE_MYSQL_DB');
if(!$conn)
{
    die("db failed");
}

//$conn=new mysqli("172.16.192.101","exam","maxe","exam",3306);//函数打开持久的 MySQLi 连接。

$conn->set_charset("utf8");

function CountQuery($condition,$table)
{
    global $conn;
    $sqlstr="select * from ".$table. " where ".$condition;
    $result=$conn->query($sqlstr);
    
    $return=mysqli_num_rows($result);
    
    return $return;
}

function MyQuery($teachername)
{
    global $conn;
    $sqlstr="SELECT que.COURSE,que.CHAPTER,std.CLASS,std.ID,std.NAME,sco.QUID,que.NO,sco.CORRECT,que.SCORE FROM stxk_score as sco,stxk_student as std,stxk_question as que WHERE sco.STUDENTID=std.ID AND sco.QUID=que.UID AND STUDENTID IN (SELECT ID FROM stxk_student where class IN (SELECT CLASS FROM stxk_course WHERE TEACHER='".$teachername."' group by CLASS order by CLASS)) ";
    $result=$conn->query($sqlstr);
    
    return $result;
}

function SummaryQuery($condition)
{
    global $conn;
    $basestr="SELECT que.COURSE,que.CHAPTER,std.CLASS,std.ID,std.NAME,sco.QUID,que.NO,sco.CORRECT,que.SCORE FROM stxk_score as sco,stxk_student as std,stxk_question as que WHERE sco.STUDENTID=std.ID AND sco.QUID=que.UID ";
    $sqlstr=$basestr.$condition;
    $result=$conn->query($sqlstr);//mysqli
    

    //if(is_resource($result))
    {
        return $result;
    }
}
//取出固定科目与章节试题的开放状态
function GetOpened($course,$chartep)
{
    global $conn;
    $sqlstr="select distinct OPENED from stxk_question where COURSE='".$course."' and CHAPTER='".$chartep."'";
    $result=$conn->query($sqlstr);
    
    return $result;
}
//取出所有该科目考试章节并且去重
function GetCharter($course)
{
    global $conn;
    $sqlstr="select distinct CHAPTER from stxk_question where COURSE='".$course."'";
    $result=$conn->query($sqlstr);
    
    return $result;
}
//取出所有该老师教学科目并且去重
function GetCourse($teacher)
{
    global $conn;
    $sqlstr="select distinct COURSE from stxk_course where TEACHER='".$teacher."'";
    $result=$conn->query($sqlstr);
    
    return $result;
}
//获取表内所有内容
function GetAll($table)
{
    global $conn;
    //$result=mysql_query("select TITLE from BUDGETLIST where BUDGETNAME=".$sqlname);//mysql
    $result=$conn->query("select * from ".$table);//mysqli
    

    //if(is_resource($result))
    {
        return $result;
    }
}
function Get($sql)
{
    global $conn;
    //$result=mysql_query("select TITLE from BUDGETLIST where BUDGETNAME=".$sqlname);//mysql
    $result=$conn->query($sql);//mysqli
    

    //if(is_resource($result))
    {
        return $result;
    }
}
function GetQuery($str)
{
    global $conn;
    $result=$conn->query($str);
    return $result;
}
//获取指定表内单条件记录
function GetAllCondition($condition,$table)
{
    global $conn;
    //$result=mysql_query("select TITLE from BUDGETLIST where BUDGETNAME=".$sqlname);//mysql
    $result=$conn->query("select * from ".$table." where ".$condition);//mysqli
    
    {
        return $result;
    }
}


function InsertQuestion($course,$type,$chapter,$No,$title,$question,$answer,$score)
{
    global $conn;
    $result=$conn->query("insert into stxk_question(COURSE,TYPE,CHAPTER,NO,TITLE,QUESTION,ANSWER,SCORE) values('".$course."','".$type."','".$chapter."','".$No."','".$title."','".$question."','".$answer."','".$score."')");//mysqli
    {
        return $result;
    }
}
function InsertScore($STUDENTID,$UID,$Correct,$Chapter,$Course)
{
    global $conn;
    $result=$conn->query("insert into stxk_score(STUDENTID,QUID,CORRECT,CHAPTER,COURSE) values('".$STUDENTID."','".$UID."','".$Correct."','".$Chapter."','".$Course."')");//mysqli
    {
        return $result;
    }
}
function UpdateOpened($course,$chapter,$opened)
{
    global $conn;
    $result=$conn->query("update stxk_question set OPENED='".$opened."' where CHAPTER='".$chapter."'and COURSE='".$course."'");
    {
        return $result;
    }
}

?>