'use strict';

var Menu = function () {

    this.settings = $('.fa-user-circle-o');
    this.button = $('.item');
    this.buttonpizza = $('.pizzaprice');
    this.buttonpizzaS = $('.pizzapriceS');
    this.buttonpizzaM = $('.pizzapriceM');
    this.usersettings = $('.usersettings');
    this.admindelete = $('.admindelete');
    this.document = $(document);
    
    this.usersettings.on('mouseenter', this.hidebasket.bind(this));
    this.usersettings.on('mouseleave', this.showbasket.bind(this));
    this.settings.on('mouseenter', this.hidebasket.bind(this));
    this.settings.on('mouseleave', this.showbasket.bind(this));
    this.admindelete.on('mouseenter', this.hidebasket.bind(this));
    this.admindelete.on('mouseleave', this.showbasket.bind(this));

    this.button.on("click", this.addproduct.bind(this));
    this.button.on("click", this.addcart.bind(this));
    this.buttonpizza.on("click", this.addproduct.bind(this));
    this.buttonpizza.on("click", this.addcart.bind(this));
    this.buttonpizzaS.on("click", this.addproduct.bind(this));
    this.buttonpizzaS.on("click", this.addcart.bind(this));
    this.buttonpizzaM.on("click", this.addproduct.bind(this));
    this.buttonpizzaM.on("click", this.addcart.bind(this));
    
    this.document.ready(this.addnewproduct.bind(this));
    this.document.ready(this.addcart.bind(this));
    this.document.on('click', 'i', this.delete.bind(this));
    this.document.on('click', 'i', this.addcart.bind(this));
};

     Menu.prototype.hidebasket = function() {

            $('#panier').toggleClass('hide');

        }

    Menu.prototype.showbasket = function() {
        
        $('#panier').toggleClass('hide');
        
    }

    Menu.prototype.addproduct = function(event) {

        var path = $("#abc").attr("data-path");

        var index = $(event.currentTarget).data('index');
        var name = $(event.currentTarget).data('name');
        var paninis = $(event.currentTarget).data('paninis');
        var side = $(event.currentTarget).data('sides');
        var dessert = $(event.currentTarget).data('desserts');
        var drink = $(event.currentTarget).data('drinks');
        var price = $(event.currentTarget).data('price');
        var quantity = $(event.currentTarget).data('quantity');
        


        $.ajax({

            url: path,
            type: 'post',
            dataType: 'html',
            data:{id:index, name:name, paninis:paninis, side:side, dessert:dessert, drink:drink, quantity:quantity, price:price},
            success: this.gogo
        });
};
Menu.prototype.gogo = function(result) {

    $('#panier').empty();
    $('#panier').append(result);

};

Menu.prototype.addnewproduct = function(event) {

    var path = $("#abc").attr("data-path");

    var index = $(event.currentTarget).data('index');
    var name = $(event.currentTarget).data('name');
    var paninis = $(event.currentTarget).data('paninis');
    var side = $(event.currentTarget).data('sides');
    var dessert = $(event.currentTarget).data('desserts');
    var drink = $(event.currentTarget).data('drinks');
    var price = $(event.currentTarget).data('price');
    var quantity = $(event.currentTarget).data('quantity');

    $.ajax({

        url: path,
        type: 'get',
        dataType: 'html',
        data: {id:index, name:name, paninis:paninis, side:side, dessert:dessert, drink:drink, quantity:quantity, price:price},
        success: this.go
    });
};
Menu.prototype.go= function(result) {

    $('#panier').empty();
    $('#panier').append(result);

};

Menu.prototype.addcart = function() {

    var pathcart = $("#ttt").attr("data-path");


    $.ajax({

        url: pathcart,
        type: 'get',
        dataType: 'html',
        success: this.cart
    });

};

Menu.prototype.cart =function(result) {


    $('#cart').empty();
    $('#cart').append(result);

};

Menu.prototype.delete = function(event) {

    var pathdelete = $("#delete").attr("data-path");
    var quantity = $(event.currentTarget).data('quantity');
    var index = $(event.currentTarget).data('number');

    $.ajax({

        url: pathdelete,
        type: 'post',
        dataType: 'html',
        data: {id:index, quantity:quantity},
        success: this.go
    });

};


$(window).scroll(function(){
    if ($(this).scrollTop() > 780) {
        $('.basket').addClass('fixed');
    } else {
        $('.basket').removeClass('fixed');
    }
});

 $(window).scroll(function(){
     if ($(this).scrollTop() > 0) {
         $('header').addClass('fixed2');
     } 
 });

var menu = new Menu;
