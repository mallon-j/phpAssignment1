<html>
<head>

    <title>Student Search</title>
    <link rel="stylesheet" href="style.css">
    <script>
        window.onload = init;

        function init() {
            document.getElementById("minSlider").addEventListener("input", startSearch);
            document.getElementById("maxSlider").addEventListener("input", startSearch);
            startSearch()
        }

        function startSearch() {
            var min = document.getElementById("minSlider").value;
            var max = document.getElementById("maxSlider").value;

            document.getElementById("minValue").textContent = min;
            document.getElementById("maxValue").textContent = max;

            var request = "search.php?min=" + min + "&max=" + max;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", request);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("output").innerHTML = xhr.responseText;
                }
            };

            xhr.send(null);
        }
    </script>
</head>
<body>

<h2>Filter Students by Marks</h2>

<p>
    <label>Min Mark: <span id="minValue">0</span></label>
    <input type="range" id="minSlider" min="0" max="100" value="0">
</p>
<p>
    <label>Max Mark: <span id="maxValue">100</span></label>
    <input type="range" id="maxSlider" min="0" max="100" value="100">
</p>

<h1>Results</h1>
<div id="output">Select a range to display student images.</div>
<?php include 'footer.inc'; ?>
</body>
</html>
