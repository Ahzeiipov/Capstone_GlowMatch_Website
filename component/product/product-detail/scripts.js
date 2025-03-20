// ...existing code...

// Get the modal
var modal = document.getElementById("textureModal");

// Get the button that opens the modal
var btn = document.getElementById("textureButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the image and insert it inside the modal - use its "alt" text as a caption
var modalImg = document.getElementById("textureImage");
var captionText = document.getElementById("caption");

btn.onclick = function() {
  modal.style.display = "block";
  modalImg.src = "path/to/texture/image.jpg"; // Replace with the actual path to the texture image
  captionText.innerHTML = "Texture Image"; // Replace with the actual caption if needed
}

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

// ...existing code...
