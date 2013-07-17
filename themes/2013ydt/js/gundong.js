// JavaScript Document
   /*--ͨ�ù���ͼ����--*/
   (function ($) {
    $.fn.marquee = function (o) {
     //��ȡ���������ڸ�Ԫ�������Ϣ
     o = $.extend({
      speed: parseInt($(this).attr('speed')) || 30, // �����ٶ�
      step: parseInt($(this).attr('step')) || 1, // ��������
      direction: $(this).attr('direction') || 'up', // ��������
      pause: parseInt($(this).attr('pause')) || 1000 // ͣ��ʱ��
     }, o || {});
     var dIndex = jQuery.inArray(o.direction, ['right', 'down']);
     if (dIndex > -1) {
      o.direction = ['left', 'up'][dIndex];
      o.step = -o.step;
     }
     var mid;
     var div = $(this); // ��������
     var divWidth = div.innerWidth(); // ������
     var divHeight = div.innerHeight(); // ������
     var ul = $("ul", div);
     var li = $("li", ul);
     var liSize = li.size(); // ��ʼԪ�ظ���
     var liWidth = li.width(); // Ԫ�ؿ�
     var liHeight = li.height(); // Ԫ�ظ�
     var width = liWidth * liSize;
     var height = liHeight * liSize;
     if ((o.direction == 'left' && width > divWidth) ||
   (o.direction == 'up' && height > divHeight)) {
      // Ԫ�س�������ʾ��Χ�Ź���
      if (o.direction == 'left') {
       ul.width(2 * liSize * liWidth);
       if (o.step < 0) div.scrollLeft(width);
      } else {
       ul.height(2 * liSize * liHeight);
       if (o.step < 0) div.scrollTop(height);
      }
      ul.append(li.clone()); // ����Ԫ��
      mid = setInterval(_marquee, o.speed);
      div.hover(
    function () { clearInterval(mid); },
    function () { mid = setInterval(_marquee, o.speed); }
   );
     }
     function _marquee() {
      // ����
      if (o.direction == 'left') {
       var l = div.scrollLeft();
       if (o.step < 0) {
        div.scrollLeft((l <= 0 ? width : l) + o.step);
       } else {
        div.scrollLeft((l >= width ? 0 : l) + o.step);
       }
       if (l % liWidth == 0) _pause();
      } else {
       var t = div.scrollTop();
       if (o.step < 0) {
        div.scrollTop((t <= 0 ? height : t) + o.step);
       } else {
        div.scrollTop((t >= height ? 0 : t) + o.step);
       }
       if (t % liHeight == 0) _pause();
      }
     }
     function _pause() {
      // ͣ��
      if (o.pause > 0) {
       var tempStep = o.step;
       o.step = 0;
       setTimeout(function () {
        o.step = tempStep;
       }, o.pause);
      }
     }
    };
   })(jQuery);
   $(document).ready(function () {
    $(".marquee").each(function () {
     $(this).marquee();
    });
   });
   
   
   
//�������
(function($){
$.fn.extend({
        Scroll:function(opt,callback){
                //������ʼ��
                if(!opt) var opt={};
                var _this=this.eq(0).find("ul:first");
                var        lineH=_this.find("li:first").height(), //��ȡ�и�
                        line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //ÿ�ι�����������Ĭ��Ϊһ�������������߶�
                        speed=opt.speed?parseInt(opt.speed,10):500, //���ٶȣ���ֵԽ���ٶ�Խ�������룩
                        timer=opt.timer?parseInt(opt.timer,10):3000; //������ʱ���������룩
                if(line==0) line=1;
                var upHeight=0-line*lineH;
                //��������
                scrollUp=function(){
                        _this.animate({
                                marginTop:upHeight
                        },speed,function(){
                                for(i=1;i<=line;i++){
                                        _this.find("li:first").appendTo(_this);
                                }
                                _this.css({marginTop:0});
                        });
                }
                //����¼���
                _this.hover(function(){
                        clearInterval(timerID);
                },function(){
                        timerID=setInterval("scrollUp()",timer);
                }).mouseout();
        }        
})
})(jQuery);

$(document).ready(function(){
        $("#scrollDiv").Scroll({line:1,speed:1500,timer:3000});
});