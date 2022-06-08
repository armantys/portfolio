


// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.querySelectorAll(".bouton").forEach(element => {
    element.onclick = function() {
       let id = element.id.split("-")[1];
        modal = document.getElementById("myModal-" + id);
       modal.style.display = "block";
      }
      
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


 document.querySelectorAll('.gallery').forEach(element => {
 let isDown = false;
let startX;
let scrollLeft;
 
 
    element.addEventListener('mousedown', e => {
  isDown = true;
  element.classList.add('active');
  startX = e.pageX - element.offsetLeft;
  scrollLeft = element.scrollLeft;
});
element.addEventListener('mouseleave', _ => {
  isDown = false;
  element.classList.remove('active');
});
element.addEventListener('mouseup', _ => {
  isDown = false;
  element.classList.remove('active');
});
element.addEventListener('mousemove', e => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - element.offsetLeft;
  const SCROLL_SPEED = 2;
  const walk = (x - startX) * SCROLL_SPEED;
  element.scrollLeft = scrollLeft - walk;
});
   
});;


