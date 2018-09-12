var Admin = function() {

    this.$document = $(document);

    this.$document.on('click', '.fa', this.delete.bind(this));

};

Admin.prototype.delete = function(event) {

    $product = $(event.currentTarget).data('index');

    console.log($product);

    $.ajax({

        url: '../../src/MonProjet/Controller/Admin/AdminDelete/AdminDeleteController',
        type: 'post',
        dataType: 'html',
        data: {MealId: $product},
        success: this.delete
    });
    Admin.prototype.delete = function(result) {

        $('#pizzas').empty();
        $('#pizzas').append(result);
    };

};

var admin = new Admin;
