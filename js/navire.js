
setInterval(function(){
    getPartie();
    $.ajax({
        url:"dessinerGrille.php",
        success:()=>{console.log("dessin ok");}
    });
},5000);

function creerPartie() {
    $.ajax({
        url:"creerPartie.php",
        success: function(data){
            console.log("Partie créée en BDD");
            console.log(data);
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

function supprimerUser(pseudo){
    $.ajax({
        url:"supprimerUser.php",
        type:"POST",
        data:{"pseudo":pseudo},

    }).done(()=>{
        alert("Utilisateur: "+pseudo+" supprimé avec succès!");
        location.reload();
    });
}