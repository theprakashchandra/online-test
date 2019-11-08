$(function(){
  $(document).on('click','.model-opener',function(){
    var elm = $(this).data('target');
    $(elm).slideDown();
    $('body').css('overflow','hidden');
  });
  $(document).on('click','.model-close-btn',function(){
    $(this).parents('.model-wrapper').hide();
    $('body').css('overflow','auto');
  })
});
