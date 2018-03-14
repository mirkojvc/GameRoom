/* eslint-disable */
"use strict";
(function () {
    var elements = {
        "form_posts": ".admin_posts__form",
        "form_categ": ".admin_category__form",
        "posts_errors": ".admin_posts__errors",
        "categ_errors": ".admin_category__errors",
    };

    var init = function () {
        
        initListeners();
    };

    var initListeners = function () {
        var form_posts = registerElements("form_posts", false);
        var form_categ = registerElements("form_categ", false);

        if(form_categ !== null){
            form_categ.addEventListener("submit", submitFormCategory);
        }
        if(form_posts !== null) {
            form_posts.addEventListener("submit", submitFormPosts);
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

    var submitFormCategory = function(event) {
        var form     = event.currentTarget;
        var elements = form.elements;
        var name    = elements.name;
        var error    = "";

        var errors   = registerElements("categ_errors", false);

        //treba prebaciti error u listu pa listati sve, mada lakse je sa </br> :)
        
        if(name.value === null) {
            event.preventDefault();
            error += "Name must be entered </br>";
        } else if(name.value.length < 1) {
            event.preventDefault();
            error += "Name must be entered </br>";
        }

        errors.innerHTML= "<div style='color:red;'>"+error+"</div>";
    };

    var submitFormPosts = function(event) {
        var form     = event.currentTarget;
        var elements = form.elements;
        var title    = elements.title;
        var image    = elements.image;
        var text     = elements.text;
        var category = elements.category
        var title_reg = /^[A-Z][a-z]+(\s[\w\d\-]+)*/;
        var error    = "";

        var errors   = registerElements("posts_errors", false);

        //treba prebaciti error u listu pa listati sve, mada lakse je sa </br> :)
        if(title.value === null) {
            event.preventDefault();
            error += "You must enter a title </br>";    
        } else if(title.value.length < 1 ) {
            event.preventDefault();
            error += "Please enter a title </br>";
        } else if( !title.value.match(title_reg) ) {
            event.preventDefault();
            error += "Title must have a first uppercase letter </br>";
        }
        
        if(text.value === null) {
            event.preventDefault();
            error += "Text must be entered </br>";
        } else if(text.value.length < 1) {
            event.preventDefault();
            error += "Text must be entered </br>";
        }


        if(parseInt(category.value, 10) === 0) {
            event.preventDefault();
            error += "Choose a category </br>";
        } 

        errors.innerHTML= "<div style='color:red;'>"+error+"</div>";
    };


    document.addEventListener("DOMContentLoaded", init);

}());
