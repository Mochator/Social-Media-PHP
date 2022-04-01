//Information form

document.write('<div class="information" id="information"><span class="close" onclick="closeForm(\'information\')">&times;</span><p><b id="information-title"></b></p><hr><p id="information-content"></p></div>');
document.write('<div class="error" id="error"><span class="close" onclick="closeForm(\'error\')">&times;</span><p><b id="error-title"></b></p><hr><p id="error-content"></p></div>');

function closeForm(x){
	document.getElementById(x).style.display = "none";
}