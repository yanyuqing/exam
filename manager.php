
<!DOCTYPE HTML>
<html>
    
    <head>
    <meta charset="UTF-8"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>top</title>
    <div class="rightinfo">
    </head>
    
    <body>
    <?php
    include 'sql.php';
    $username=$_GET["name"];
    echo"<table border='1' class=\"tablelist\">
        <tr>
            <th>课程</th>
            <th>章节</th>
            <th>试题开放状态</th>
            <th>试题开放状态控制</th>
        </tr>";
    $rs=GetCourse($username);
    while ($a_row = mysqli_fetch_array($rs, MYSQLI_BOTH))
    {
        $course=$a_row["COURSE"];
        $rs1=GetCharter($course);
        while ($a_row2 = mysqli_fetch_array($rs1, MYSQLI_BOTH))
        {
            $chapter=$a_row2["CHAPTER"];
            $rs2=GetOpened($course,$chapter);
            while ($a_row3 = mysqli_fetch_array($rs2, MYSQLI_BOTH))
            {
                if($a_row3["OPENED"]=='0') $opened="已开放";
                else if($a_row3["OPENED"]=='1') $opened="未开放";
                echo"<tr>
                <td>".$course."</td>
                <td>".$chapter."</td>
                <td>".$opened."</td>
                <td>";
                if($a_row3["OPENED"]=='0') echo "<a href=\"changeopened.php?opened=1&chapter=".$chapter."&course=".$course."\" class=\"tablelink\">关闭开放</a></td></tr>";
                else echo "<a href=\"changeopened.php?opened=0&chapter=".$chapter."&course=".$course."\" class=\"tablelink\">开放</a></td></tr>";
            }
            
        }
    }
    ?>
    </div>
</body>
</html>