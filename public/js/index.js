/* eslint-disable */
(function () {

    var elements = {
      "pagination": ".pagination_button",
      "main":       "#content_main",
    };

    var init = function () {
        
        initListeners();
    };

    var initListeners = function () {
        var pagination = "pagination";
        var pag_elements = registerElements(pagination, true);

        for(var i = 0, l = pag_elements.length; i < l; i++ ) {
            pag_elements[i].addEventListener("click", paginationClicked);
        }
    };

    var registerElements = function (element, query_all) {
        var selector = elements[element];
        if(query_all) {
            return document.querySelectorAll(selector);
        } else {
            return document.querySelector(selector);
        }
    };

    var paginationClicked = function (event) {
        event.preventDefault();
        var element = event.currentTarget;
        var page = element.dataset.page;
        var url = page;
        window.AppMainAjax(url, render);
    }

    var render = function(data) {
        var element = "main";
        var el = registerElements(element, false);
        el.innerHTML = data;
        initListeners();
    }

    document.addEventListener("DOMContentLoaded", init);

}());
