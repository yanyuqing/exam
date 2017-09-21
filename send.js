var arr_s=new Array();
xmlHttp=creat_obj();
//创建对象函数**********************************************************************
function creat_obj()
{
	var xmlHttp;
	var textlinshi;
	if (window.XMLHttpRequest)
 	 {// code for IE7+, Firefox, Chrome, Opera, Safari
 	 xmlHttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
 	 xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	return xmlHttp;
}
//发送请求函数***********************************************************************8
function send(a)
{
	xmlHttp.open("POST","setsession.php",true);
	//表示客户端提交给服务器文本内容的编码方式 是URL编码，即除了标准字符外，每字节以双字节16进制前加个“%”表示
	xmlHttp.setRequestHeader ("content-type", "application/x-www-form-urlencoded");
	//说明字节大小
	xmlHttp.setRequestHeader ("content-length",a.length );
	xmlHttp.send(a);
}
//返回选中radio的值******************************************************************
function getRadioBoxValue(radioName) 
 { 
     var obj = document.getElementsByName(radioName);  //这个是以标签的name来取控件
     for(i=0; i<obj.length;i++)    
     {
          if(obj[i].checked)    
          { 
            return obj[i].value; 
          } 
     }         
     return "undefined";       
 } 
 function click(name,no)
 {
    alert("我还是可以执行的");
    a="name="+name;
    a=a+"&value="+getRadioBoxValue(name);
    a=a+"&no="+no;
    send(a);
 }