<!DOCTYPE html>

<html>

<script src="tresurehunt.js?random=<?php echo uniqid(); ?>"></script>

<script>
    console.log("welcome");

    window.onload = function () {
        getLocation(true);
    };

</script>

<head>

</head>

<body>

<p id="accuracyStatus">
    <script>
        showAccuracy();
    </script>
</p>

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Aesculus-parviflora-habit.JPG/310px-Aesculus-parviflora-habit.JPG">
<br><br>

<button onclick="getLocation(true)">Klik her når du har fundet skatten/billedet</button>

<br><br>

<p id="tresureFound"></p>
<br><br>

<div id="mapholder"></div>



</body>
</html>
