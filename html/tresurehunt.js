
var x = document.getElementById("demo");

var positionGlobalVar;

function getLocation(onlyAccuracy) {

    console.log("getLocation called. onluAccuracy=" + onlyAccuracy)
    if (navigator.geolocation) {
        if (onlyAccuracy) {
            navigator.geolocation.watchPosition(setPositionGlobalVar, showGPSError);
        } else {
            navigator.geolocation.watchPosition(showPosition, showGPSError);
        }

    } else {
        x.innerHTML = "Geolocation is not supported by this browser."; //possible not needed when using errorhandler
    }
}

function setPositionGlobalVar(position) {
    //debugger;
    positionGlobalVar = position;
    showAccuracy();
}

function showAccuracy() {
    //debugger;
    try {
        if (positionGlobalVar.coords.accuracy < 7) {
            changeBackground('green')
            showAccuracy2("GOOD", positionGlobalVar.coords.accuracy);
        } else if (positionGlobalVar.coords.accuracy < 12) {
            changeBackground('yellow');
            showAccuracy2("FAIR", positionGlobalVar.coords.accuracy);
        } else {
            changeBackground('red');
            showAccuracy2("BAD", positionGlobalVar.coords.accuracy);
        }
    } catch (err) {
        document.getElementById("demo").innerHTML = err.message;
    }

    function showAccuracy2(statusStr, statusInt) {
        document.getElementById("accuracyStatus").innerHTML = "GPS status is " + statusStr + " (" + statusInt + " meters accuracy)";
    }
}

function changeBackground(color) {
    document.body.style.background = color;
}



function isTreasureFoundBool() {
    console.log("isTreasureFoundBool enter");
    navigator.geolocation.getCurrentPosition(isTreasureFundBool2, showGPSError);

}

function isTreasureFundBool2(position) {
    var distance = measureInMeters2(57.07059251149843, 10.111258691186189, position);

    if (distance < 10) {
        document.getElementById("tresureFound").x.innerHTML = "FOUND IT!! " + distance;
    } else {
        document.getElementById("tresureFound").x.innerHTML = "KEEP SEARCHING!! " + distance;
    }
}



function showPosition(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;

    var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
        + latlon + "&zoom=14&size=400x300&sensor=false";
    document.getElementById("mapholder").innerHTML = "<img src='" + img_url + "'>";


    x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude +
        "<br>Accuracy: " + position.coords.accuracy +
        "<br> treasure 1: " + isTreasureFound(57.0707476, 10.1113272, 9, 12, position) +
        "<br> treasure 2: " + isTreasureFound(57.0915708, 10.0783921, 10, 100000, position) +
        "<br> treasure 3: " + isTreasureFound(57.07059251149843, 10.111258691186189, 10, 12, position) +
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

