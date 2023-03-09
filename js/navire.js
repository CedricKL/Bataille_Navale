$(document).ready(function() {
    var temps = 5000;

    /* setTimeout(() => {
        location.reload();
    }, temps); */
})

function creerNavire(data){
    console.log(data);
    let keys = Object.keys(data);
    let values = Object.values(data);
    /* for(let i=2;i<=6;i++){
        $("#j"+i*11).css("background-color","blue");
        $("#j"+i).css("background-color","blue");
        $("#j"+(i+48)).css("background-color","blue");
        $("#j"+(i+81)).css("background-color","blue");
    } */
    console.log(values)
    for(let i=0;i<=keys.length;i++){
        if(values[i] == 1)
        $("#j"+keys[i]).css("background-color","blue");

        if(values[i] == 2)
        $("#j"+keys[i]).css("background-color","red");
    }
   
}
function getPartie() {
    $.get("http://localhost/Projets/Web/Bataille_Navale/getGrille.php", creerNavire);
}
    
function traiterPartie(data) {

}