window.onload = function(){killerSession();}

// esta función solo funcionaría si el navegador se tiene abierto y en una página en específico, pero si se cierra el navegador 
function killerSession(){
    // setInterval(function(){
    //     console.log(Date())
    // }, 1000)
    
    // 10 minutosS
    setTimeout("window.open('../control/exit.php','_top');", 600000)

    //600000
}