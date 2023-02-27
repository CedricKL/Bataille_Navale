function creerNavire(){
    for(let i=2;i<=6;i++){
        $("#j"+i*11).css("background-color","blue");
        $("#j"+i).css("background-color","blue");
        $("#j"+(i+48)).css("background-color","blue");
        $("#j"+(i+81)).css("background-color","blue");
    }
        

    
}