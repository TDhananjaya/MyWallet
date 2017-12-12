var page=2;

function show() {
  if(page==2){
    document.getElementById("getstart").style.display = "none";
    document.getElementById("fillit").style.visibility = 'visible';
  }
  if(page==3){
    document.getElementById("fillit").style.display = "none";
    document.getElementById("getstart").style.display = "none";
  }
  page=page+1;
}

function hide(){
  document.getElementById("fillit").style.display = "none";
  document.getElementById("getstart").style.display = "none";
}
