SELECT * FROM `stxk_score` WHERE STUDENTID IN (SELECT ID FROM stxk_student where class='机1504') AND CORRECT =1

SELECT * FROM `stxk_score` WHERE STUDENTID IN (SELECT ID FROM stxk_student where class IN (SELECT CLASS FROM stxk_course where TEACHER='lsj'))

SELECT std.class,std.id,std.NAME,sco.QUID,sco.CORRECT FROM `stxk_score` as sco,stxk_student as std WHERE sco.STUDENTID=std.ID AND STUDENTID IN (SELECT ID FROM stxk_student where class='机1504') AND CORRECT =1

SELECT std.class,std.id,std.NAME,sco.QUID,sco.CORRECT FROM `stxk_score` as sco,stxk_student as std WHERE sco.STUDENTID=std.ID AND STUDENTID IN (SELECT ID FROM stxk_student where class IN (SELECT CLASS FROM stxk_course WHERE TEACHER='lsj' group by CLASS order by CLASS)) AND CORRECT =1

SELECT que.COURSE,que.CHAPTER,std.CLASS,std.ID,std.NAME,sco.QUID,que.NO,sco.CORRECT,que.SCORE FROM stxk_score as sco,stxk_student as std,stxk_question as que WHERE sco.STUDENTID=std.ID AND sco.QUID=que.UID AND STUDENTID IN (SELECT ID FROM stxk_student where class IN (SELECT CLASS FROM stxk_course WHERE TEACHER='lsj' group by CLASS order by CLASS))

SELECT q.SCORE,s.CORRECT FROM stxk_question as q,stxk_score as s where q.UID=s.QUID AND s.STUDENTID='20151202' AND s.CHAPTER='第六章'


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
}
?>