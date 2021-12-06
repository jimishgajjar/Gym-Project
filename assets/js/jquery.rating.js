  /*The MIT License (MIT)
Copyright (c) 2016 by Showvhick Nath

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.*/

   $.fn.rating = function(options) {
         if(options=="refresh"){
            $(this).find('.simple-rater-holder').attr('data-selected',0).attr('data-ratestate',0);
            $(this).find('.simple-rater-overflow').css('width',0);
             
         }
         else if(options=="val"){
            var a = parseFloat($(this).find('.simple-rater-holder').attr('data-selected')).toFixed(1);
            return a;
         }
         else if(options=="disable"){
            $(this).find('.simple-rater-holder').attr('data-readonly','true');
         }
         else if(options=="enable"){
            $(this).find('.simple-rater-holder').attr('data-readonly','false');
         }
         else{
         var opts = jQuery.extend({}, jQuery.fn.rating.defaults, options);
        
         var counts = opts.count;
         var size = opts.size+'px';
         var totaloverlaywidth = parseFloat(opts.size)*parseInt(opts.count); 
        
         $(this).append('<div class="simple-rater-holder" data-scale="'+ opts.scale +'" data-ratestate=0 data-readonly="'+opts.readonly+'" style="float:left; width:auto; position:relative; "><div class="simple-rater-wrapper"></div><div class="simple-rater-overflow" style="position:absolute; left:0; top:0; width:0; overflow-x:hidden"><div class="simple-rater-overflow-variant" style="float:left; width:'+totaloverlaywidth+'"></div></div></div>');
      
         for(i=0; i<opts.count; i++){
            $(this).find('.simple-rater-wrapper').append('<div class="simple-rater-box" style="float:left; width:auto; "><div class="simple-rater-f"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="simple-rater" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="'+size+'" height="'+size+'" fill="'+opts.primaryColor+'" data-id="'+i+'" data-defaultfill="'+opts.primaryColor+'" data-hoverfill="'+opts.hoverColor+'" data-selected="false"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg></div></div>');

            $(this).find('.simple-rater-overflow-variant').append('<div class="simple-rater-overlay-holder" style="float:left; width:auto;"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="simple-rater" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="'+size+'" height="'+size+'" fill="'+ opts.hoverColor +'" data-id="'+i+'" data-defaultfill="'+opts.primaryColor+'" data-hoverfill="'+opts.hoverColor+'" data-selected="false"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg></div>');
           
            $(this).addClass('raters');
         }
          var as = $(this).find('.simple-rater-holder').width();
          var totsize = parseInt(opts.count)*parseFloat(opts.size);
         $(this).find('.simple-rater-holder').css('width',totsize);
         if(opts.rate != 0){
          if(opts.rate > opts.count){
              console.log('ALERT! Count is lesser than rate. Can not be initialized');
            }
          else{
             var a = opts.rate;
             $(this).find('.simple-rater-holder').attr('data-selected',opts.rate);
             var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
             var c = parseFloat(b)*parseFloat(a);
            var d = c+'%';
            $(this).find('.simple-rater-overflow').css('width',d);
          }
         }
      }
      }
 jQuery.fn.rating.defaults = {
         rate:0,  
         size:20,
         primaryColor:"#F4F4F4",
         hoverColor:"#fdb300",
         scale:10,
         readonly:"false",
         count:5
    };


$(document).on('mousemove','.simple-rater-holder',function(e){
if($(this).attr('data-readonly') == 'false'){  
  if($(this).attr('data-scale') == 10){
  var a = parseInt($(this).position().left);
    var overflowsize = parseInt(e.pageX)-parseInt(a);
   $('.simple-rater-overflow').css('width',overflowsize+'px');
  }
  else if($(this).attr('data-scale') == 2){
    var a = parseInt($(this).position().left);
    var overflowsize = parseInt(e.pageX)-parseInt(a);
   $('.simple-rater-overflow').css('width',overflowsize+'px');

    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b);
    var d = parseFloat(100)*parseFloat($(this).find('.simple-rater-overflow').width());
    var f = parseFloat(d)/parseFloat($(this).width());
    var g = parseFloat(f)/parseFloat(b);
    if(g.toFixed(2).toString().split('.')[1] > 50){
      var h = parseFloat(g.toFixed(2).toString().split('.')[0])+parseInt(1);
      
    
    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b)*parseFloat(h);
    var d = c+'%';
    $(this).find('.simple-rater-overflow').css('width',d);

    }
    else{
      var h = parseFloat(g.toFixed(2).toString().split('.')[0])+parseFloat(0.5);
      var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
      var c = parseFloat(b)*parseFloat(h);
      var d = c+'%';
      $(this).find('.simple-rater-overflow').css('width',d);
    }

  }
  else{

    var a = parseInt($(this).position().left);
    var overflowsize = parseInt(e.pageX)-parseInt(a);
   $('.simple-rater-overflow').css('width',overflowsize+'px');

    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b);
    var d = parseFloat(100)*parseFloat($(this).find('.simple-rater-overflow').width());
    var f = parseFloat(d)/parseFloat($(this).width());
    var g = parseFloat(f)/parseFloat(b);
   
      var h = parseFloat(g.toFixed(2).toString().split('.')[0])+parseInt(1);
      
    
    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b)*parseFloat(h);
    var d = c+'%';
    $(this).find('.simple-rater-overflow').css('width',d);
  }
}
})


$(document).on('click','.simple-rater-holder',function(e){
/*   $(this).attr('data-ratestate',1);
  var a = $(this).find('.simple-rater-overflow').width();
 var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
var c = parseFloat(b);
var d = parseFloat(100)*parseFloat($(this).find('.simple-rater-overflow').width());
var f = parseFloat(d)/parseFloat($(this).width());
var g = parseFloat(f)/parseFloat(b);
$(this).attr('data-selected',g);*/

if($(this).attr('data-readonly') == 'false'){  

  if($(this).attr('data-scale') == 10){
  var a = parseInt($(this).position().left);
    var overflowsize = parseInt(e.pageX)-parseInt(a);
   $('.simple-rater-overflow').css('width',overflowsize+'px');
   var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
var c = parseFloat(b);
var d = parseFloat(100)*parseFloat(overflowsize);
var f = parseFloat(d)/parseFloat($(this).width());
var g = parseFloat(f)/parseFloat(b);
$(this).attr('data-selected',g);

  }
  else if($(this).attr('data-scale') == 2){
    var a = parseInt($(this).position().left);
    var overflowsize = parseInt(e.pageX)-parseInt(a);
  // $('.simple-rater-overflow').css('width',overflowsize+'px');

    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b);
    var d = parseFloat(100)*parseFloat(overflowsize);
    var f = parseFloat(d)/parseFloat($(this).width());
    var g = parseFloat(f)/parseFloat(b);

    if(g.toFixed(2).toString().split('.')[1] > 50){
      var h = parseFloat(g.toFixed(2).toString().split('.')[0])+parseInt(1);
          $(this).attr('data-selected',h);
    
    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b)*parseFloat(h);
    var d = c+'%';
    $(this).find('.simple-rater-overflow').css('width',d);

    }
    else{
      var h = parseFloat(g.toFixed(2).toString().split('.')[0])+parseFloat(0.5);
          $(this).attr('data-selected',h);
      var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
      var c = parseFloat(b)*parseFloat(h);
      var d = c+'%';
      console.log(d);
      $(this).find('.simple-rater-overflow').css('width',d);
    }

  }
  else{

    var a = parseInt($(this).position().left);
    var overflowsize = parseInt(e.pageX)-parseInt(a);
   $('.simple-rater-overflow').css('width',overflowsize+'px');

    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b);
    var d = parseFloat(100)*parseFloat($(this).find('.simple-rater-overflow').width());
    var f = parseFloat(d)/parseFloat($(this).width());
    var g = parseFloat(f)/parseFloat(b);
   
   
      var h = parseFloat(g.toFixed(2).toString().split('.')[0])+parseInt(1);
      
     $(this).attr('data-selected',h);
    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b)*parseFloat(h);
    var d = c+'%';
    $(this).find('.simple-rater-overflow').css('width',d);
  }
}



})


$(document).on('mouseleave','.simple-rater-holder',function(){
  if($(this).attr('data-readonly')=="false"){

 if($(this).attr('data-ratestate') == 0 || $(this).attr('data-ratestate')== undefined){

  if($(this).attr('data-selected') == undefined || $(this).attr('data-selected') == 0) 
  {   
    $(this).find('.simple-rater-overflow').css('width',0);
  }
  else{
    var a = parseFloat($(this).attr('data-selected'));
    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b)*parseFloat(a);
    var d = c+'%';
    $(this).find('.simple-rater-overflow').css('width',d);
  }
 }
 else{

    var a = parseFloat($(this).attr('data-selected'));
    var b = parseInt(100)/parseInt($(this).find('.simple-rater-box').length);
    var c = parseFloat(b)*parseFloat(a);
    var d = c+'%';
    $(this).find('.simple-rater-overflow').css('width',d);
 }
}
})

