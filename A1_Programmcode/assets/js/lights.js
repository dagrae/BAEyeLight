
function neuerWertLampe1(wert) {

    console.log(this.value);

    var url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/1/state";

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            console.log(xhr.status);
            console.log(xhr.responseText);
        }
    };
    var wert_neu = wert;

    if(wert_neu > 0) {
        var data = '{"on":true, "bri":' + wert_neu + '}';
    }
    else {
        var data = '{"on":false}';
    }
    xhr.send(data);


}

function neuerWertLampe2(wert) {

    console.log(this.value);

    var url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/3/state";

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            console.log(xhr.status);
            console.log(xhr.responseText);
        }
    };
    var wert_neu = wert;

    if(wert_neu > 0) {
        var data = '{"on":true, "bri":' + wert_neu + '}';
    }
    else {
        var data = '{"on":false}';
    }
    xhr.send(data);

}

function neuerWertLampe3(wert) {


    console.log(this.value);

    var url = "http://172.16.163.120:8080/api/8A7EF596DA/lights/4/state";

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            console.log(xhr.status);
            console.log(xhr.responseText);
        }
    };
    var wert_neu = wert;

    if(wert_neu > 0) {
        var data = '{"on":true, "bri":' + wert_neu + '}';
    }
    else {
        var data = '{"on":false}';
    }
    xhr.send(data);

}