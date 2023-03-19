function gererClick(id,numj) {
    // console.log("la case a été cliquée"+ e.id);
    //console.log($(this));
    console.log(id);
    if(tourj == numj){
         //  $("#j"+id).html("<img src=\"img/feu.gif\" alt=\"feu\" width=\"15\" height=\"15\">");
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
    }else{
      console.log("Ce n'est pas votre tour!");
    }
}

setInterval(function(){
  $.ajax({
    url:"finPartie.php",
    success:()=>{
      console.log("tour du joueur: "+tourj);
    }
  });
  getTour();
},1000);

function tour(data){
  tourj =  data;
}
function getTour(){
  $.get("./getTour.php",tour);
}


function rejoindrePartie() {
  $.ajax({
    url:"rejoindrePartie.php",
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
        // location.reload();
       // window.location.href = "grille.php?partie="+data;
    },
    error: function(xhr ,status, error){
        console.log("création échouée: "+error);
    }
});
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


