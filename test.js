var slideIndex = 0;
slides();

function slides() {
	var i;
	var img = ["Resources/big-one.jpg", "Resources/big-two.jpg", "Resources/big-three.jpg", "Resources/big-four.jpg", "Resources/big-five.jpg"];

	for (i = 0, i < (img.length-1), i++) {
		var setImg = "url('"+img[i];+"'')"
		document.getElementsByTagName("header").style.background = setImg;
	}
}