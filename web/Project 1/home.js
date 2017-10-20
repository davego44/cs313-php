var transferWindow = document.getElementById("transferWindow");

function ShowTransferWindow() {
	transferWindow.style.display = "block";
}

function CloseTransferWindow() {
	transferWindow.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == transferWindow) {
		transferWindow.style.display = "none";
	}
}



