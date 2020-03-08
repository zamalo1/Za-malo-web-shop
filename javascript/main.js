
//jQuery('#prvi').css('color', 'green');

/*----------------INDEX---------------
$('button').eq(0).click(function () {
    $('.box').removeClass('night');
    $('.box').addClass('day');
});
$('button').eq(1).on('mouseenter',function () {
    $('.box').removeClass('day').addClass('night');

});
 */
/*----------------INDEX1-----------------
var btn = $('#btn');
btn.on('click',function () {
    alert($('#textNaslova').val());
});
 */
//-----------------INDEX2-------------------
/*var naslovi = $('.naslovi');
var podnaslovi = $('.podnaslovi');

//naslovi.eq(0).parent().find('.podnaslovi').show();

naslovi.on('click',function () {
    podnaslovi.slideUp();
    $(this).parent().find('.podnaslovi').slideDown();
});
 */
/*----------------------------------------------
$(function () {
                    //isto sto i $(document).ready(function{
                                                                   PRVO SE UCITA STRANICA PA SE IZVRSAVA
                        // })
});
 */
/*------------------------------------
$(document).ready(function () {
    $('#wrapp1').append('<h1>some text</h1>');// ubacio sam koisteci 'append' novi h1 tag u ovaj moj div!!!
});
 */
/*
//-----------------INDEX3-------------------
$(document).ready(function () {
    $('div:not(#kurac)').append('<div class="close">x</div>');
    $('.close').on('click', function () {                           append-dodati nakon elementa npr x za gasenje reklame
        $(this).parent() .hide();                                   prepend-dodati pre nekog elementa(selektora)
    })
});
 */
/*-----------------INDEX4------------ANIMATE FUNCTION------
$(document).ready(function () {
    $('#ball').animate({     //----prvi argument su parametri koje zelimo da menjamo i to je uvek objekat {};
        width : 500,
        height :500,
    },2000,                      //-----drugi je speed
        'swing',                         //---treci je NACIN(npr. swing, linear...)
        function (){                     //---cetvrti je CALL BACK FUNKCIJA  (kada se zavrsi ova nasa animacija, pozivamo tu funkciju)
        alert('dane');
    });
});
 */
/*--------------INDEX5-----------ANIMATE FUNCTION--------
$(document).ready(function () {
    var holder = $('#holder');
    var current = 1;
    var loop;

    loop = setInterval(next,4000);          //pozivacemo ovu varijablu svake 4sekunde sa ovom funkcijom next;
    function next() {
        current ++;
        if(current === 4){
            current = 1;
        }
        holder.append('<img src="img/'+current+'.jpg">');
        holder.animate({
            'margin-left':'-=200'
        },1500)
    }
});
 */
//--------------------INDEX6---------------------

var boxx = $('#boxx');
console.log(boxx.offset());
/* xhttp.open('POST','http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_like',true);
            xhttp.send();*/