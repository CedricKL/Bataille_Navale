function gererClick(id) {
    // console.log("la case a été cliquée"+ e.id);
    //console.log($(this));
     console.log(id);

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
  });
}



