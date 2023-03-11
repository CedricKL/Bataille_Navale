$(document).ready(function() {
    var temps = 2000;

     setTimeout(() => {
        location.reload();
    }, temps); 
})

function creerPartie() {
    $.ajax({
        url:"creerPartie.php",
        success: function(data){
            console.log("Partie créée en BDD");
            console.log(data);
            // location.reload();
            window.location.href = "grille.php?partie="+data;
        },
        error: function(xhr ,status, error){
            console.log("création échouée: "+error);
        }
    });
}

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
    // console.log(values)
    for(let i=0;i<=keys.length;i++){
        if(values[i] == 1)
        $("#j"+keys[i]).css("background-color","blue");

        if(values[i] == 2)
        $("#j"+keys[i]).css("background-color","red");

        if(values[i] == 3)
        $("#j"+keys[i]).css("background-color","brown");
    }
   
}
function getPartie() {
    $.get("./getGrille.php", creerNavire);
}

function tour(data){
    console.log("tour du joueur "+data);
}
function getTour(){
    $.get("./getTour.php",tour);
}
    
function traiterPartie(data) {

}