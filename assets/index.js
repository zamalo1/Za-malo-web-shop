

    var plus=document.getElementById('plus');
    var minus=document.getElementById('minus');
    var kolicina=document.getElementById('kolicina');
    var cena=document.getElementById('cena');
    var ukupno=document.getElementById('ukupno1');
    var sveukupno=document.getElementById('sveukupno');

    ukupno.value = kolicina.value * cena.value;
    sveukupno.value=1000;


    plus.addEventListener('click',kolicinaPlus,false);
    minus.addEventListener('click',kolicinaMinus,false);

function kolicinaPlus() {
    if (kolicina.value < 10) {
        kolicina.value++;
        ukupno.value = kolicina.value * cena.value;
        sveukupno.value=parseInt(sveukupno.value) + parseInt(cena.value);
    }
}
    function kolicinaMinus() {
        if (kolicina.value > 1) {
            kolicina.value--;
            ukupno.value = kolicina.value * cena.value;
            sveukupno.value=parseInt(sveukupno.value) - parseInt(cena.value);
        }
    }
var mazalo=document.getElementById('kurcobolja').style.border='solid black 1px';
mazalo.addEventListener('click',zamalo,true)

function zamalo() {
    mazalo.setAttribute('style', 'color:red');8
}




