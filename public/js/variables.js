
$('.variable').on('click',function()
{
   $(this).parent().find('.p1').addClass('hidden');
   $(this).parent().find('.variableText1').removeClass('hidden');
   $(this).parent().find('.p2').addClass('hidden');
   $(this).parent().find('.variableText2').removeClass('hidden');
});

var i=0;
$('.show-accept').on('change',function()
{
   if(i==0)
   {
      $('.accept-radio').removeClass('hidden');
      $('.accept-radio').addClass('count');
      i++;
   }else{
      $('.accept-radio').addClass('hidden');
      $('.accept-radio').removeClass('count');
      i=0;
   }
});
