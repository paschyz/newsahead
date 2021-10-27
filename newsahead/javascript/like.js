function like(clicked_class) {

  if (clicked_class.includes('btn btn-info')) {
    var clicked_id = clicked_class.slice(13, 20);
    document.getElementById(clicked_class).className = "btn btn-outline-info "+ clicked_id;
    document.getElementById(clicked_class).innerHTML = "Liké !";
    document.getElementById(clicked_class).id = "btn btn-outline-info " + clicked_id;
  }else{
    var clicked_id =  clicked_class.slice(21, 25);
    document.getElementById(clicked_class).className = "btn btn-info "+ clicked_id;
    document.getElementById(clicked_class).innerHTML = "Like";
    document.getElementById(clicked_class).id = "btn btn-info "+ clicked_id;

  }
  
  const request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (request.readyState == 4 ) {
      let p = document.getElementById(clicked_id + 'like');
      p.innerHTML = request.responseText;
    }
  };
  request.open("POST", "javascript/like.php");
  request.send();
}


function dislike(clicked_class) {

  if (clicked_class.includes('btn btn-danger')) {
    var clicked_id = clicked_class.slice(15, 20);
    document.getElementById(clicked_class).className = "btn btn-outline-danger "+ clicked_id;
    document.getElementById(clicked_class).innerHTML = "Disiké !";
    document.getElementById(clicked_class).id = "btn btn-outline-danger " + clicked_id;
  }else{
    var clicked_id =  clicked_class.slice(23, 25);
    document.getElementById(clicked_class).className = "btn btn-danger "+ clicked_id;
    document.getElementById(clicked_class).innerHTML = "Disike";
    document.getElementById(clicked_class).id = "btn btn-danger "+ clicked_id;

  }

  const request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (request.readyState == 4 ) {
      let p = document.getElementById(clicked_id + 'dislike');
      p.innerHTML = request.responseText;
    }
  };
  request.open("POST", "javascript/dislike.php");
  request.send();
}
