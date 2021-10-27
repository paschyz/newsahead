function search(name) {
  console.log(name);
  fetchSearchData(name);
}

function fetchSearchData(name) {
  fetch('rechercher.php', {
    method: 'POST',
    body: new URLSearchParams('name=' + name)
  })
  .then(res => res.json())
  .then(res => viewSearchResult(res))
  .catch(e => console.error('Error: ' + e))
}

function viewSearchResult(data) {
  const dataViewer = document.getElementById("dataViewer");

  dataViewer.innerHTML = "";

  for(let i = 0; i< data.length; i++){
    const ol = document.createElement("div");
    let str = '<hr><a class="search" href="plus.php?id=';
    str += data[i]["id_article"];
    str += '"><div>';
    str += data[i]["article_title"];
    str +=  '</div></a>';
    ol.innerHTML = str;
    dataViewer.appendChild(ol);
  }
}
