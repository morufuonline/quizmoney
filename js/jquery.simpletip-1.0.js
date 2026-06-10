   
   // Всплывающая подсказка SimpleTip
   // JQuery Plugin 
   // (c) Pavliy Vitaliy, 2015
   
   (function($){
   
      $.fn.SimpleTip = function(options){  

         // Создаём настройки по умолчанию
         var settings = $.extend({
            'my'         : 'bottom middle',
            'at'         : 'bottom middle',
            'class'      : '',
            'timefade'   : 500,
            'timedelay'  : 0,
            'offsetx'    : 0,
            'offsety'    : 0
         }, options);

         function DecodeStr(str){
            
            switch (str){
               case 'top'   :
               case 'left'  : return 0;
               case 'center':
               case 'middle': return 1;
               case 'right' :
               case 'bottom': return 2;
            }
            
            return 0;
         }
         
         return this.each(function(){
            
            $(this).mouseover(function(){
               
               this.tip          = this.title;               
               this.title        = '';
               var offset        = $(this).offset();
               var widthAt       = $(this).outerWidth();
               var heightAt      = $(this).outerHeight();
               var widthWin      = $(window).width();
               var heightWin     = $(window).height();
               var scrollLeftWin = $(window).scrollLeft();
               var scrollTopWin  = $(window).scrollTop();
               
               $('<div id="SimpleTip">' + this.tip + '</div>').appendTo('body').css({
                  position: 'absolute',
                  display: 'none'
               }).addClass(settings.class);
               
               var callback = function(){
                  var widthMy       = $('#SimpleTip').outerWidth();
                  var heightMy      = $('#SimpleTip').outerHeight();
                     
                  var my      = settings.my.split(' ');
                  var at      = settings.at.split(' ');
               
                  my[0] = DecodeStr(my[0]); my[1] = DecodeStr(my[1]); 
                  at[0] = DecodeStr(at[0]); at[1] = DecodeStr(at[1]); 
               
                  var left;
                  var top;
                  var offsetx = settings.offsetx;
                  var offsety = settings.offsety;
                  var flag = false;
               
                  for (var i=0; i<2; i++)
                  {
                     switch (at[0]){
                        case 0: left = offset.left + offsetx; break;
                        case 1: left = offset.left + offsetx + widthAt / 2;  break;
                        case 2: left = offset.left + offsetx + widthAt; break;
                     }
                     
                     switch (at[1]){
                        case 0: top = offset.top + offsety; break;
                        case 1: top = offset.top + offsety + heightAt / 2; break;
                        case 2: top = offset.top + offsety + heightAt; break;
                     }
               
                     switch (my[0]){
                        case 0: break;
                        case 1: left -= widthMy / 2; break;
                        case 2: left -= widthMy; break;
                     }
               
                     switch (my[1]){
                        case 0: break;
                        case 1: top -= heightMy / 2; break;
                        case 2: top -= heightMy; break;
                     }
         
                     if (left + widthMy > widthWin + scrollLeftWin || left < scrollLeftWin)
                     {
                        my[0] = 2 - my[0];
                        at[0] = 2 - at[0];
                        offsetx = -offsetx;
                        flag  = true;
                     }
                  
                     if (top + heightMy > heightWin + scrollTopWin || top < scrollTopWin)
                     {
                        my[1] = 2 - my[1];
                        at[1] = 2 - at[1];
                        offsety = -offsety;
                        flag  = true;
                     }
                  
                     if (flag == false)
                        break;
                  }
               
                  if (left < scrollLeftWin)
                     left = scrollLeftWin;
                  if (top < scrollTopWin)
                     top = scrollTopWin;  
                  if (left > widthWin + scrollLeftWin - widthMy)
                     left = widthWin + scrollLeftWin - widthMy;
                  if (top > heightWin + scrollTopWin - heightMy)
                     top = heightWin + scrollTopWin - heightMy;
            
                  $('#SimpleTip').css({
                     left: Math.round(left) + 'px',
                     top:  Math.round(top)  + 'px'
                  }).delay(settings.timedelay).fadeIn(settings.timefade);
               }
                           
               var currentImg = 0;
               var totalImg = $('#SimpleTip img').size();
               
               if (totalImg == 0)
                  callback();
               else
                  $('#SimpleTip img').bind('load error', function(){
                     currentImg++;
                     if (currentImg == totalImg)
                        callback();
                  });
            });
            
            $(this).mouseout(function(){
               
               $('#SimpleTip').remove();
               this.title = this.tip;
               
            });
            
         });
      };
   })(jQuery);