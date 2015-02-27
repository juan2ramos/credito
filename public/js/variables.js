
$('.variable').on('click',function()
{
   $(this).parent().find('.p1').addClass('hidden');
   $(this).parent().find('.variableText1').removeClass('hidden');
   $(this).parent().find('.p2').addClass('hidden');
   $(this).parent().find('.variableText2').removeClass('hidden');
});


