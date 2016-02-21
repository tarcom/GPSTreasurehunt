<!DOCTYPE html>
<html>
<body>

<!--AIzaSyD0dBWFQ6joHjgR48ROuOjpVzHMmK60qSk-->

<h3>Mobil GPS skattejagt</h3>
<p id="demo"></p>


<br><br>

<form id="saveImageForm" name="saveImageForm" action="" enctype="multipart/form-data" method="POST">
    Treasure name:
    <input type="text" id="treasureName" name="name" value=""/>
    <br>
    Treasure hint:
    <input type="text" id="treasureHint" name="hint" value="use youre imagination"/>
    <br>
    Billede:
    <input type='file' id="treasureImg" name="img"/>
    <br>
    <input type="text" id="treasureImageId" name="imageId" value="<?php echo uniqid(); ?>" hidden/>
    <br>
    <input type="submit" name="submit" id="submit" onClick="persistGpsPosition()">
</form>


<br>
<br>



<div id="demo"></div>
<div id="mapholder"></div>

<hr>

<div id="map"></div>

<div id="map"></div>
<script>

    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvLMSeefS3013biBKaY2dmYfEVYbOWOww&callback=initMap"
        async defer></script>


<script>





    var globalLat;
    var globalLon;
    var globalAccuracy;

    function persistGpsPosition() {
        console.log("saving GPS position...");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("demo").innerHTML = xhttp.responseText;
            }
        };

        var treasureName = document.getElementById("treasureName").value;
        var treasureHint = document.getElementById("treasureHint").value;
        //var treasureImg = document.getElementById("treasureImg").value;
        var treasureImageId = document.getElementById("treasureImageId").value;

        console.log("name=" + treasureName);
        console.log("hint=" + treasureHint);
        //console.log("img=" + treasureImg);
        console.log("globalLat=" + globalLat);
        console.log("globalLon=" + globalLon);
        console.log("treasureImageId=" + treasureImageId);

        if (treasureName == "") {
            alert("please type in a treasure name");
            return;
        }


        //xhttp.open("GET", "http://localhost/geo/savePosition.php" +
        //var getUrl = "http://aogj.com/geo/savePosition.php" +
        var getUrl = "http://192.168.92/geo/savePosition.php" +
            "?name=" + treasureName +
            "&hint=" + treasureHint +
            "&lat=" + globalLat +
            "&lon=" + globalLon +
            "&accuracy=" + globalAccuracy +
            "&imageUrl=" + treasureImageId;

        console.log("getUrl=" + getUrl);

        xhttp.open("GET", getUrl
            , true);
        xhttp.send();
        console.log("done persisting. about to save image.");


        //document.forms["saveImageForm"].submit();

        document.getElementById('saveImageForm').submit();
        //document.getElementById("saveImageForm").submit();

    }


    window.onload = function () {
        console.log("windows.onload called");
        getLocation();

        //console.log("initMap called");
        //initMap();
    };

    var x = document.getElementById("demo");

    function getLocation() {
        console.log("getLocation called.");

        if (navigator.geolocation) {
            console.log("about to watchPosition...");
            navigator.geolocation.watchPosition(showPosition, showGPSError);
        } else {
            console.log("failed to watchPosition!!");
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        console.log("end of getLocation");
    }

    function showPosition(position) {
        console.log("showPosition called");

        var latlon = position.coords.latitude + "," + position.coords.longitude;

        var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
            + latlon + "&zoom=14&size=400x300&sensor=false";
        document.getElementById("mapholder").innerHTML = "<img src='" + img_url + "'>";

        globalLat = position.coords.latitude;
        globalLon = position.coords.longitude;
        globalAccuracy = position.coords.accuracy;
        position.coords.longitude;

        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude +
            "<br>Accuracy: " + position.coords.accuracy +
            //"<br> treasure 1: " + isTreasureFound(57.0707476, 10.1113272, 9, 12, position) +
            //"<br> treasure 2: " + isTreasureFound(57.0915708, 10.0783921, 10, 100000, position) +
            //"<br> treasure 3: " + isTreasureFound(57.07059251149843, 10.111258691186189, 10, 12, position) +
            //"<br>globalLat=" + globalLat +
            //"<br>globalLon=" + globalLon +
            "";

    }

    function measureInMeters2(lat, lon, position) {
        return measureInMeters(position.coords.latitude, position.coords.longitude, lat, lon);
    }

    function isTreasureFound(lat, lon, margin, minAccuracy, position) {

        var metersFromTreasure = measureInMeters2(lat, lon, position);

        if (position.coords.accuracy > minAccuracy) {
            return "Accuracy too low. " + metersFromTreasure.toFixed(1);
        }

        if (metersFromTreasure > margin) {
            return "Treasure not found yet. " + metersFromTreasure.toFixed(1);
        } else {
            return "You have found the treasure!!! " + metersFromTreasure.toFixed(1);
        }

    }

    function showGPSError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }

    function measureInMeters(lat1, lon1, lat2, lon2) {  // generally used geo measurement function
        var R = 6378.137; // Radius of earth in KM
        var dLat = (lat2 - lat1) * Math.PI / 180;
        var dLon = (lon2 - lon1) * Math.PI / 180;
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d * 1000; // meters
    }


</script>

<script src="dummy.js?random=<?php echo uniqid(); ?>"></script>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //$image = $_POST['img'];
    //Stores the filename as it was on the client computer.
    //$imagename = $_POST['img']['name'];
    //Stores the filetype e.g image/jpeg
    $imagetype = $_FILES['img']['type'];
    //Stores any error codes from the upload.
    $imageerror = $_FILES['img']['error'];
    //Stores the tempname as it is given by the host when uploaded.
    $imagetemp = $_FILES['img']['tmp_name'];

    $imageId = $_POST['imageId'];

    $imageName = $_POST['name'];

    //The path you wish to upload the image to
    $imagePath = "images/";

//    echo "<br>image=$image<br>";
//    echo "<br>imagename=$imagename<br>";
    echo "imagetype=$imagetype<br>";
    echo "imagetemp=$imagetemp<br>";
    echo "imagePath=$imagePath<br>";
    echo "imageId=$imageId<br>";

    $name = $_POST['name'];
    echo "name=$name<br>";
    $hint = $_POST['hint'];
    echo "hint=$hint<br>";
    $imageId = $_POST['imageId'];
    echo "imageId=$imageId<br>";

    if (is_uploaded_file($imagetemp)) {
        if (move_uploaded_file($imagetemp, $imagePath . $imageName . "_" . $imageId . ".jpg")) {
            echo "<br>Sussecfully uploaded your image.<br>";
        } else {
            echo "Failed to move your image 1.";
        }
    } else {
        echo "Failed to upload your image 2.";
    }
}

?>


</body>
</html>


