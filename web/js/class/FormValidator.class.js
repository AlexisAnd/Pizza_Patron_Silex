'use strict';

var FormValidator = function () {
    
    this.required = $("[data-required]");
    this.number = $("[data-number]");
    this.length = $("[data-length]");
    
    $('form').on('submit', this.check.bind(this));
};

FormValidator.prototype.check = function(event) {


    $('#issues').empty();
    for (var i=0; i<this.required.length; i++) {

        if(this.required[i].value == "") {

            event.preventDefault();
            $('#issues').append('<li>'+ "Le champs: " + this.required[i].getAttribute('data-name') + " est obligatoire"+'</li>');
        }
    }


    for(var i=0; i<this.number.length; i++) {

        if (isNaN(parseInt(this.number[i].value)) == true) {

            event.preventDefault();
            $('#issues').append('<li>' + "Le champs: " + this.number[i].getAttribute('data-name') + " ne peut contenir que des chiffres" + '</li>');
        }
    }

    if(this.length.length > 0) {
        if(this.length.val().length < this.length.data('length')) {

            event.preventDefault();
            $('#issues').append('<li>' + "Le mot de passe doit contenir 8 caracteres au minimum" + '<li>');
        }
    }
};
var formvalidator = new FormValidator;