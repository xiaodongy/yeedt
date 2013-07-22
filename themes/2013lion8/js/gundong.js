// JavaScript Document
   /*--通用滚动图盘类--*/
   (function ($) {
    $.fn.marquee = function (o) {
     //获取滚动内容内各元素相关信息
     o = $.extend({
      speed: parseInt($(this).attr('speed')) || 30, // 滚动速度
      step: parseInt($(this).attr('step')) || 1, // 滚动步长
      direction: $(this).attr('direction') || 'up', // 滚动方向
      pause: parseInt($(this).attr('pause')) || 1000 // 停顿时长
     }, o || {});
     var dIndex = jQuery.inArray(o.direction, ['right', 'down']);
     if (dIndex > -1) {
      o.direction = ['left', 'up'][dIndex];
      o.step = -o.step;
     }
     var mid;
     var div = $(this); // 容器对象
     var divWidth = div.innerWidth(); // 容器宽
     var divHeight = div.innerHeight(); // 容器高
     var ul = $("ul", div);
     var li = $("li", ul);
     var liSize = li.size(); // 初始元素个数
     var liWidth = li.width(); // 元素宽
     var liHeight = li.height(); // 元素高
     var width = liWidth * liSize;
     var height = liHeight * liSize;
     if ((o.direction == 'left' && width > divWidth) ||
   (o.direction == 'up' && height > divHeight)) {
      // 元素超出可显示范围才滚动
      if (o.direction == 'left') {
       ul.width(2 * liSize * liWidth);
       if (o.step < 0) div.scrollLeft(width);
      } else {
       ul.height(2 * liSize * liHeight);
       if (o.step < 0) div.scrollTop(height);
      }
      ul.append(li.clone()); // 复制元素
      mid = setInterval(_marquee, o.speed);
      div.hover(
    function () { clearInterval(mid); },
    function () { mid = setInterval(_marquee, o.speed); }
   );
     }
     function _marquee() {
      // 滚动
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
      // 停顿
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
   
   
   
//滚动插件
(function($){
$.fn.extend({
        Scroll:function(opt,callback){
                //参数初始化
                if(!opt) var opt={};
                var _this=this.eq(0).find("ul:first");
                var        lineH=_this.find("li:first").height(), //获取行高
                        line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
                        speed=opt.speed?parseInt(opt.speed,10):500, //卷动速度，数值越大，速度越慢（毫秒）
                        timer=opt.timer?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
                if(line==0) line=1;
                var upHeight=0-line*lineH;
                //滚动函数
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
                //鼠标事件绑定
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