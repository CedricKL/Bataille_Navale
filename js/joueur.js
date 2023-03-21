function gererClick(id,numj) {
    console.log(id);
    $.ajax({
      url:"finPartie.php",
      success:(data)=>{
        console.log(data);
        let victoire = data.split(',');
        if(tourj == 0){
          alert("vainqueur:Player"+victoire[0]);
          $("#victoire").html("vainqueur:Player"+victoire[0]+"!!");
        }
        console.log("tour du joueur: "+tourj);
      }
    });
    if(tourj == numj){
      $("#e"+id).css("background-image", "url(\"img/feu.gif\")");
      $("#e"+id).css("background-size", "contain");
      $("#e"+id).css("background-repeat", "no-repeat");

      $.ajax({
        url:"enregistrerGrille.php",
        type:"POST",
        data: {"id": id}
      }).done(function() {
        console.log("Reussi");
        getTirs();
      });

      $.ajax({
        url:"getScores.php",
        success:(data)=>{
          let scores = data.split(',');
          let score_joueur = scores[0];
          let score_enemi = scores[1];

          if(numj == 2) {
            $("#score_joueur_1").html(score_enemi);
            $("#score_joueur_2").html(score_joueur);
        }else if(numj== 1) {
          $("#score_joueur_1").html(score_joueur);
          $("#score_joueur_2").html(score_enemi);
        }

        }
      });
    }else{
      console.log("Ce n'est pas votre tour!");
    }
}

setInterval(function(){
  getTour();
},1000);

function tour(data){
  tourj =  data;
}
function getTour(){
  $.get("./getTour.php",tour);
}


function rejoindrePartie(id) {
  $.ajax({
    url:"rejoindrePartie.php",
    type:"POST",
    data: {"id": id},
    success: function(){
        console.log("Partie rejoins");
        console.log(data);
        for(let i=0;i<=keys.length;i++){

          if(values[i] == 1)
          $("#j"+keys[i]).css("background-color","blue");

          if(values[i] == 2)
          $("#j"+keys[i]).css("background-color","red");
  
          if(values[i] == 3) {
            $("#j"+keys[i]).css("background-color","grey");
          }
      }
          },
    error: function(xhr ,status, error){
        console.log("création échouée: "+error);
    }
});
location.reload();
}

function getTirs() {
  $.ajax({
    url:"actualiserGrille.php",
    success: function(data){
        console.log("Partie actualisée");
        console.log(data);
        let keys = Object.keys(data);
        let values = Object.values(data);
        
        for(let i=0;i<=keys.length;i++){

          if(values[i] == 2){
          $("#e"+keys[i]).css("background-color","grey");
          $("#e"+keys[i]).css("background-image", "none");
          }
          if(values[i] == 3) {
            $("#e"+keys[i]).css("background-image", "url(\"img/feu.gif\")");
            $("#e"+keys[i]).css("background-size", "contain");
            $("#e"+keys[i]).css("background-repeat", "no-repeat");
          }
      }
    },
    error: function(xhr ,status, error){
        console.log("création échouée: "+error);
    }
});
}


