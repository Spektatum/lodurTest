// JavaScript Document

var Main = {

	init : function(){

        console.log('JavaScript file loaded 62');

		// Send AJAX file to reload the php
		// So the new data is included
		function reloadDoc() {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "reload.php", true);
			xhttp.send("reload=true");
		}

		// Make sure to reload pages to get the new data
		// Browsers can be hard to refresh
		var list = document.getElementById('list');
		list.addEventListener("click", function() {
			event.preventDefault();
			// history.go(0);
			window.location.reload(true);
			window.location.replace("reload.php");
			reloadDoc();

		});

	} // End init
};

 window.addEventListener("load",Main.init);