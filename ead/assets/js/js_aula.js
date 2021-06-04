// modal 
$("a[rel=modal]").click (function(ev){
    ev.preventDefault();

    var id = $(this).attr("href");

    var alturaTela  = $(document).height();
    var larguraTela = $(window).width();

    // colocando o fundo preto
    $('#mascara').css({'width':larguraTela, 'height':alturaTela});
    //$('#mascara').fadeIn(500);
    $('#mascara').fadeIo("alow", 0.0);

    var left = ($($window).width() /2) - ($(id).width()/2);
    var top  = ($($window).width() /2) - ($(id).width()/2);

    $(id).css({'top':top, 'lefet':left});
    $(window).scrollTop(0);
});

$("#mascara").click( function(){
    $(this).hide();
    $(".window").hide();
});

$('.fechar').click( function(){
    ev.preventDefault();
    $("#mascara").hide();
    $(".window").hide();
});


