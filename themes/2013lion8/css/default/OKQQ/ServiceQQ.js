document.write("<div class='QQbox' id='divQQbox' >");
document.write("<div class='Qlist' id='divOnline' onmouseout='hideMsgBox(event);' style='display : none;'>");
document.write("<div class='t'></div>");
document.write("<div class='infobox'>�ͷ����߷���ʱ��<br>��һ������ 9:00-18:00</div>");
document.write("<div class='con'>");

document.write("<ul>");

document.write("<li class=odd><a href='http://wpa.qq.com/msgrd?V=1&amp;Uin=1436681558&amp;Site=QQ��ѯ&amp;Menu=yes' target='_blank'><img src=' http://wpa.qq.com/pa?p=1:1436681558:4'  border='0' alt='QQ' /> �µ���ѯ</a></li>");

document.write("<li class=odd><a href='http://wpa.qq.com/msgrd?V=1&amp;Uin=1436681558&amp;Site=QQ��ѯ&amp;Menu=yes' target='_blank'><img src=' http://wpa.qq.com/pa?p=1:1436681558:4'  border='0' alt='QQ' /> �ۺ����</a></li>");

document.write("<li class=odd><a href='http://wpa.qq.com/msgrd?V=1&amp;Uin=1436681558&amp;Site=QQ��ѯ&amp;Menu=yes' target='_blank'><img src=' http://wpa.qq.com/pa?p=1:1436681558:4'  border='0' alt='QQ' /> ��Ա����</a></li>");

//document.write('<li><img src="OKQQ/images/msn.gif" width="18" height="17" border="0" alt="MSN" /> <a href="msnim:chat?contact=besoo@live.cn">MSN��ѯ</a></li>');

//document.write('<li><a href="http://amos1.taobao.com/msg.ww?v=2&uid=besoo&s=2" target="_blank"><img src="http://amos1.taobao.com/online.ww?v=2&uid=besoo&s=2" width="16" height="16" border="0" alt="besoo" />��������</a></li>');


document.write('<tr><td><li>��ѯ�绰��400-050607-1</li></td></tr>');

document.write("</ul>");

document.write("</div>");

document.write("<div class='b'></div>");

document.write("</div>");

document.write("<div id='divMenu' onmouseover='OnlineOver();'><a class='press' title='������ѯ'></a></div>");

document.write("</div>");



//<![CDATA[

var tips; var theTop = 205/*����Ĭ�ϸ߶�,Խ��Խ����*/; var old = theTop;

function initFloatTips() {

tips = document.getElementById('divQQbox');

moveTips();

};

function moveTips() {

var tt=50;

if (window.innerHeight) {

pos = window.pageYOffset

}

else if (document.documentElement && document.documentElement.scrollTop) {

pos = document.documentElement.scrollTop

}

else if (document.body) {

pos = document.body.scrollTop;

}

pos=pos-tips.offsetTop+theTop;

pos=tips.offsetTop+pos/10;



if (pos < theTop) pos = theTop;

if (pos != old) {

tips.style.top = pos+"px";

tt=10;

//alert(tips.style.top);

}



old = pos;

setTimeout(moveTips,tt);

}

//!]]>

initFloatTips();







function OnlineOver(){

document.getElementById("divMenu").style.display = "none";

document.getElementById("divOnline").style.display = "block";

document.getElementById("divQQbox").style.width = "171px";

}



function OnlineOut(){

document.getElementById("divMenu").style.display = "block";

document.getElementById("divOnline").style.display = "none";



}


if(typeof(HTMLElement)!="undefined")    //��firefox����contains()������ie�²�������
{   
      HTMLElement.prototype.contains=function(obj)   
      {   
          while(obj!=null&&typeof(obj.tagName)!="undefind"){ //ͨ��ѭ���Ա����ж��ǲ���obj�ĸ�Ԫ��
   ��������if(obj==this) return true;   
   ��������obj=obj.parentNode;
   ����}   
          return false;   
      };   
}  


function hideMsgBox(theEvent){ //theEvent���������¼���Firefox�ķ�ʽ

�� if (theEvent){

�� var browser=navigator.userAgent; //ȡ�����������

�� if (browser.indexOf("Firefox")>0||browser.indexOf("Chrome")>0||browser.indexOf("Safari")>0){ //�����Firefox��Chrome��Safari

���� if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //�������Ԫ��

���� return; //������ʽ

} 

} 

if (browser.indexOf("MSIE")>0|| browser.indexOf("Presto")>=0){ //�����IE��Opera


if (document.getElementById('divOnline').contains(event.toElement)) { //�������Ԫ��

return; //������ʽ

}

}

}

/*Ҫִ�еĲ���*/

document.getElementById("divMenu").style.display = "block";

document.getElementById("divOnline").style.display = "none";

}









   