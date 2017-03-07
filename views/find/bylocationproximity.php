<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Restaurant;
use yii\helpers\VarDumper;
use yii\helpers\Json;


$this->title = 'Find by Location proximity';

?>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyDS3U06rV-UvA_mpjRSfn59CuL77MqUf6Q"
        type="text/javascript"></script>


<h1>Find by Location Proximity</h1>

<h3>Where would you like to eat?</h3>

<div class="bgheader responsive" style="margin: 0 auto 30px;">
    <?= Html::img('@web/images/bgheader.png', ['style' => 'img-fluid']) ?>
</div>


<?php

    $restaurantLocations = Restaurant::find()
        ->select('name, coordinates, photo')
        ->Where(['status' => 'Y'])
        ->asArray()
        ->all();

   // echo VarDumper::dumpAsString($restaurantLocations, 10, true);
?>



<div id="map" style="width: 100%; height: 600px;"></div>


<script type="text/javascript">
    // This drops an array of jSON objects into the JS locations variable from PHP
    var locations = <?= Json::encode($restaurantLocations) ?>;

//        var locations = [
//            ['Bondi Beach', -33.890542, 151.274856, 4],
//            ['Coogee Beach', -33.923036, 151.259052, 5],
//            ['Cronulla Beach', -34.028249, 151.157507, 3],
//            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
//            ['Maroubra Beach', -33.950198, 151.259302, 1]
//        ];


    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: new google.maps.LatLng(44.986656, -93.258133),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {

        var coordinates = locations[i].coordinates.split(',');
        var lat = coordinates[0];
        var lon = coordinates[1];

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lon),
            map: map,
            animation: google.maps.Animation.DROP
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent("<img style='width: 200px' src='/web/uploads/restaurant/" + locations[i].photo + "'/> </br>" + locations[i].name);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
</script>