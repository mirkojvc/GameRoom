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
      "survey":     ".survey_answer__radio",
      "survey_cont": ".survey_container",
    };

    var init = function () {
        
        initListeners();
    };

    var initListeners = function () {
        var pagination = "pagination";
        var pag_elements = registerElements(pagination, true);

        var survey = "survey";
        var surv_el = registerElements(survey, true);

        for(var i = 0, l = pag_elements.length; i < l; i++ ) {
            pag_elements[i].addEventListener("click", paginationClicked);
        }

        for(var i = 0, l = surv_el.length; i < l; i++ ) {
            surv_el[i].addEventListener("click", surveyClicked);
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
        window.AppMainAjax(url, render, "GET");
    };

    var surveyClicked = function(event) {
        event.preventDefault();
        var element = event.currentTarget;
        var id      = element.dataset.id;
        var token = document.getElementsByTagName('input').item(name="_token").value;
        var token = "_token="+token;


        var survey = "survey_cont";
        var surv_el = registerElements(survey, false);

        var sur_id  = surv_el.dataset.id; 
        var location = window.location.href;
        var url     = "insertSurveyResult/"+id+"/"+sur_id;

        window.AppMainAjax(url, hideSurvey, "POST", token);
    }

    var render = function(data) {
        var element = "main";
        var el = registerElements(element, false);
        el.innerHTML = data;
        initListeners();
    };

    var hideSurvey = function(data) {
        var element = "survey_cont";
        var el = registerElements(element, false);
        el.innerHTML = data;
        initListeners();

    }

    document.addEventListener("DOMContentLoaded", init);

}());
