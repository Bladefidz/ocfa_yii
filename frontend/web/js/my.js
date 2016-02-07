var url = window.location.pathname;
var lastUri = url.split("/").splice(-1, 1);

// testing
console.log(lastUri);

$(document).ready(function() {
	if (lastUri == "") { turnActive("home") }
	else { turnActive(lastUri) }
});

$

function turnActive(_id) {
	document.getElementById(_id).className = "active";
}