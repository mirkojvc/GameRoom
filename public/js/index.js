/* eslint-disable */
"use strict";
(function () {
    var elements = {
      "pagination": ".pagination_button",
      "main":       "#content_main",
      "form":       ".user_form",
      "errors":     ".user_form__error",
      "username":   ".user_username",
      "password":    ".user_password",
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

        var form = registerElements("form", false);
        if(form !== null) {
            form.addEventListener("submit",submitForm);
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

    var submitForm = function(event) {
        var form     = event.currentTarget;
        var username = registerElements("username", false);
        var password = registerElements("password", false);
        var errors   = registerElements("errors", false);
        var pass_reg = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        var error    = "";
        if(username.value === null) {
            event.preventDefault();
            error += "You must enter a username";    
        } else if(username.value.length <= 3 ) {
            event.preventDefault();
            error += "Username must be larger than 3 characters";
        }
        
        if(password.value === null) {
            event.preventDefault();
            error += "Password must be entered";
        } else if(password.value.length <= 5) {
            event.preventDefault();
            error += "Password must be longer then 5 characters";
        } else if( !password.value.match(pass_reg) ) {
            event.preventDefault();
            error += "password must contain one big letter and one digit";
        }

        errors.innerHTML= "<div style='color:red;'>"+error+"</div>";
    };


    var paginationClicked = function (event) {
        event.preventDefault();
        var element = event.currentTarget;
        var page = element.dataset.page;
        var url = page;
        window.AppMainAjax(url, render);
    };

    var render = function(data) {
        var element = "main";
        var el = registerElements(element, false);
        el.innerHTML = data;
        initListeners();
    };

    document.addEventListener("DOMContentLoaded", init);

}());
