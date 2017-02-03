function cookieExists(cname) {
    var ordered = getCookie(cname);
    if (ordered) {
        return true;
    } else {
        return false;
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return false;
}

function addCookieData(id, previousCookie) {
    var cvalue = '';
    
    if (previousCookie) {
        var previous = previousCookie;
        previous = previous.substr(1);
        previous = previous.slice(0, -1);

        cvalue = previous + ', ' + id;
    } else {
        cvalue = id;
    }

    cvalue = '[' + cvalue + ']';
    
    setCookie('ordered', cvalue, 1);
}


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
    return true;
}



function removeFromCookie(id) {
    var data = getCookie('ordered');
    data = JSON.parse(data);

    for (var i = 0; i < data.length; i++) {
        if (data[i] == id) {
            data.splice(i, 1);
        }
    }

    data = JSON.stringify(data);


    setCookie('ordered', data, 1);

}