function mobileNavigation(e) {
	$(e).toggleClass('is-active');
    $('.header + .navigation').toggleClass('toggle');
}
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function soLetras(v){
    return v.replace(/\d/g,"") //Remove tudo o que não é Letra
}
function sticky(string){
    var string = $(string);
    string.before(string.clone(true).addClass("sticky"));
    $(window).scroll(function(t) {
        var a = $(window).scrollTop();
        if(a>$('header').outerHeight())
            $('.sticky').addClass("stuck")
        else 
            $('.sticky').removeClass("stuck")
    })	
}
function closeMenu() {
    $('.toggle').removeClass('toggle'),
    $('.is-active').removeClass('is-active');
}
$(window).on("resize",function(o){
    closeMenu();
});
$(document).mouseup(function (e)
{
    var container = $('.panel').children();

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.panel').removeClass('toggle')
    } 
});  
$(document).ready(function () {
    $(window).scroll(function(event){
        var st = $(this).scrollTop();

        $( '.pg-home main section' ).each(function() {
            if($(this).offset().top > (st + $('header').outerHeight() + 80)){
                $(this).removeClass('animated');
            } else {
                $(this).addClass('animated');
            }
        });
    });  
    $('.slick').slick({
        arrows: false,
        dots: true
    });
    $('.galeria').slick({
      arrows: false,
      dots: true,
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 814,
          settings: {
            slidesToShow: 1,
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    $('.telefone').mask('(00) 00000-0000');
    $( ".filtros input[type='radio']" ).on( "change", function() {
        $("#cat").val($(this).val());
    });    
    $( "#filtrar" ).click(function() {
      $("#buscar").trigger('click');
    }); 
    $( "ul.produtos" ).children().each(function() {
        $(this).children('h3').find('a').click(function() {
            $(this).closest('ul').find('.panel').not($(this).closest('li').find('.panel')).removeClass('toggle'),
            $(this).closest('li').find('.panel').addClass('toggle')
        });          
    }); 
    $( ".close" ).click(function() {
        $(this).closest('.panel').removeClass('toggle')
    });  
    $( ".navigation,#marcas_result" ).hover(
      function() { }, function() {
        $("#marcas_result").children('ul').empty()
      }
    );    
});
      
      