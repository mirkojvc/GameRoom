/* eslint-disable */
(function () {

    var makeRequestRaw = function (data, callback) {
        var response;
        var request = new XMLHttpRequest();
        request.open("GET", data);
        request.onreadystatechange = function() {
            if (request.readyState === 4 && request.status === 200) {
                    response = request.responseText;
                    callback(response);
            }
        }

        request.send();
    };

    var makeRequest = function(data, callback) {
        makeRequestRaw(data, callback);
    }

        window.AppMainAjax = makeRequest;

}());