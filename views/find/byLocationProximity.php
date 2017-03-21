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
        ->select('id, name, coordinates, photo')
        ->Where(['status' => 'Y'])
        ->asArray()
        ->all();
    // SELECT name, coordinates FROM Restaurant WHERE status = 'Y'

    foreach($restaurantLocations as $key => $array) {

        $restaurantHours = \app\models\RestaurantHours::find()
            ->select('dayOfWeek, open, close')
            ->where(['restId' => $array['id']])
            ->orderBy('id')
            ->asArray()
            ->all();

        $restaurantLocations[$key]['hours'] = $restaurantHours;
    }
    // SELECT dayOfWeek, open, close FROM RestaurantHours WHERE the array restId = an array for 'id'

//    echo VarDumper::dumpAsString($restaurantLocations, 10, true);
?>


<div id="map" style=" margin: 0 auto; width: 75%; height: 900px;"></div>


<script type="text/javascript">

    // This drops an array of jSON objects into the JS locations variable from PHP
    var locations = <?= Json::encode($restaurantLocations) ?>;

    console.log(JSON.stringify(locations));

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

        var hoursOfOperation = "";
        for (var h = 0; h < locations[i].hours.length; h++) {

            var day = locations[i].hours[h].dayOfWeek;
            var open = locations[i].hours[h].open;
            var close = locations[i].hours[h].close;

            hoursOfOperation += day + ": " + open + " - " + close + "<br />";
        }

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lon),
            map: map,
            animation: google.maps.Animation.DROP,
            icon: 'http://maps.google.com/mapfiles/ms/icons/restaurant.png'
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(
                    "<img style='width: 200px;' src='<?= Yii::getAlias('@web') ?>/uploads/restaurant/" + locations[i].photo + "' /><br>"
                    + locations[i].name + "<br>"
                    + "Hours of operation: <br>"
                    + hoursOfOperation
                );
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
console.log(hoursOfOperation)
</script>