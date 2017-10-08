<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Marked-Up SVG World Map Example</title>
  <meta name="author" content="Ben Hodgson">
</head>
<body>
  <embed src="map.svg" type="image/svg+xml" id="world" width="600" height="450">
  <select id="country">
	<option>ua</option>
	<option>ru</option>
	<option>au</option>
	<option>br</option>
	<option>pl</option>
	<option>ch</option>
	<option>jp</option>
  </select>
  <button id="showRoute">send</button>
  <script type="text/javascript">
    (function () {
      var sendBtn = document.getElementById("showRoute");
	  
	  var world = document.getElementById("world");
	  
	  sendBtn.addEventListener('click', function(){
		var doc = world.getSVGDocument();
		var select = document.getElementById("country");
		var currentCC = select.options[select.selectedIndex].value;
		var target = doc.querySelector("[cc=ca]");
		
		doc.querySelector("[cc=" + currentCC + "]").style.fill = "red";
	  });
      
      if (location.protocol == "file:") {
        var warningDiv = document.createElement("div");
        warningDiv.style.color = "red";
        document.body.insertBefore(warningDiv, world);
        warningDiv.textContent = "Due to restrictions imposed by the " +
            "same-origin policy, this demo probably won't work when " +
            "accessed using the file:// URI scheme. If you're having " +
            "trouble getting it to work, try accessing it over HTTP.";
      }
      
      world.addEventListener("load", function () {
        var doc = world.getSVGDocument();
        
        // Colour Canada red
        //doc.querySelector("[cc=mx]").style.fill = "red";
        
        // Alert the ISO3166 code of clicked countries
        doc.addEventListener("click", function (e) {
          var target = e.target,
              cc = target.getAttribute("cc") || target.parentElement.getAttribute("cc");
          if (cc) {
            alert("My country code is " + cc);
          }
        });
      });
    }());
  </script>
</body>
</html>