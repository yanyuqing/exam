var arr_s=new Array();
xmlHttp=creat_obj();
//����������**********************************************************************
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
//����������***********************************************************************8
function send(a)
{
	xmlHttp.open("POST","setsession.php",true);
	//��ʾ�ͻ����ύ���������ı����ݵı��뷽ʽ ��URL���룬�����˱�׼�ַ��⣬ÿ�ֽ���˫�ֽ�16����ǰ�Ӹ���%����ʾ
	xmlHttp.setRequestHeader ("content-type", "application/x-www-form-urlencoded");
	//˵���ֽڴ�С
	xmlHttp.setRequestHeader ("content-length",a.length );
	xmlHttp.send(a);
}
//����ѡ��radio��ֵ******************************************************************
function getRadioBoxValue(radioName) 
 { 
     var obj = document.getElementsByName(radioName);  //������Ա�ǩ��name��ȡ�ؼ�
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
    alert("�һ��ǿ���ִ�е�");
    a="name="+name;
    a=a+"&value="+getRadioBoxValue(name);
    a=a+"&no="+no;
    send(a);
 }