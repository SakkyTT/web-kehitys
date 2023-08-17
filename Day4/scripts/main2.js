const list = document.createElement('ul');
const info = document.createElement('p');
const html = document.querySelector('html');

info.textContent = 'Below is a dynamic list. Click anywhere on the page to add a new list item. Click an existing list item to change its text to something else.';

document.body.appendChild(info);
document.body.appendChild(list);

html.onclick = function() {
  const listItem = document.createElement('li');
  const listContent = prompt('What content do you want the list item to have?');
  listItem.textContent = listContent;
  list.appendChild(listItem);

  listItem.onclick = function(e) {
    e.stopPropagation();
    const listContent = prompt('Enter new content for your list item', this.textContent); // Näytetään vanha arvo
    // this-avainsana, viittaa siihen elementtiin, jota klikattiin.
    // Eli se elementti, jonka onclick funktiota suoritetaan.
    if(listContent != null){ // Estetään null tekstin lisäys.
        this.textContent = listContent;
    }
  }
}