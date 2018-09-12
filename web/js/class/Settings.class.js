/**
 * Created by Alexis on 16/06/2017.
 */
var Settings = function() {
    var map;
    this.document = $(document);
    this.document.ready(this.addcart.bind(this));
};

Settings.prototype.addcart = function() {

    var pathcart = $("#ttt").attr("data-path");


    $.ajax({

        url: pathcart,
        type: 'get',
        dataType: 'html',
        success: this.cart
    });

};

Settings.prototype.cart =function(result) {

    $('#cart').empty();
    $('#cart').append(result);

};


function initMap() {
       map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 48.866667, lng: 2.333333},
        zoom: 12,
    });
    
    var address = $('#location').attr('data-index');
    
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert("La localisation n'a pas fonctionne du a: " + status);
        }
    });
};


var settings = new Settings();