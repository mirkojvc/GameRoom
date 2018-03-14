/* eslint-disable */
(function () {
    var location = baseUrl;
    var makeRequestRaw = function (data, callback, method, token = null) {
        var response;
        var request = new XMLHttpRequest();
        request.open(method, location+"/"+data);
        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.onreadystatechange = function() {
            if (request.readyState === 4 && request.status === 200) {
                    response = request.responseText;
                    callback(response);
            }
        }

        request.send(token);
    };

    var makeRequest = function(data, callback, method, token = null) {
        makeRequestRaw(data, callback, method, token);
    }

        window.AppMainAjax = makeRequest;

}());
