$("[name=header]").click(function(){
  if ($(this).next().css('display') == 'none') {
    $(this).next().slideDown();
  } else {
    $(this).next().slideUp();
  }
})
  
$('#mobileTrigger').click(function() {
  if ($(this).parent().next().css('display') == 'none') {
    $(this).parent().parent().css('border-bottom-color', '#b7bfc2')
    $(this).text('▲ Jak korzystać?')
    $(this).parent().next().slideDown();
  } else {
    $(this).parent().next().slideUp();
    $(this).text('▼ Jak korzystać?')
    $(this).parent().parent().css('border-bottom-color', '#F4F6F9')
  }
})

function responsiveSize() {
  if ($(window).width() < 769) {
    $('#columnSideMenu').hide();
    console.log('w trakcie show')
    $('#mobileNav').show();
  } else {
    $('#mobileNav').hide();
    console.log('w trakcie hide')
    $('#columnSideMenu').show();
  }
}

window.addEventListener("load", responsiveSize());

var resizeId;
$(window).resize(function() {
    clearTimeout(resizeId);
    resizeId = setTimeout(responsiveSize, 500);
});

window.addEventListener("resize", function() {
  console.log('resize')
})
