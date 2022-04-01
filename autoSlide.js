var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  //var imgCaps = document.getElementByClassName("slideImg");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  slides[slideIndex-1].style.display = "block";  
  //document.getElementById("caption").innerHTML = imgCaps[slideIndex-1].alt;
  setTimeout(showSlides, 3000); // Change image every 2 seconds
};


