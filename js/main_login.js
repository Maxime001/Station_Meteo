function afficheAlerte(){
    $var = "<?= $Verif ?>";
    if($var != ""){
       document.getElementById("alertBlock").style.visibility = "visible";
    }
}

$('#titreprincipal').fadeIn(1500);

if($(window).width() > 600){
    $('#barr').delay(2000).show("slow");
    $('#time').delay(3000).show("slow"); 
}

$(function() {
    $(window).resize(function() {
        var taille = $(window).width();
        if(taille<600){
            $('#time').hide(600);
            $('#barr').hide(1000);
        }
        else{
            $('#time').fadeIn();
            $('#barr').fadeIn();
        }
    });
});
