<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Restaurant;
use yii\helpers\VarDumper;


$this->title = 'Find by Location proximity';

?>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyDS3U06rV-UvA_mpjRSfn59CuL77MqUf6Q"
        type="text/javascript"></script>


<h1>Find by Location Proximity</h1>

<h3>Where would you like to eat?</h3>

<div class="bgheader responsive" style="text-align: center; margin-bottom: 10px">
    <?=Html::img('@web/images/bgheader.png',['style' => 'img-fluid'])?>
</div>

<br>

<div id="map" style="width: 100%; height: 600px;"></div>

<?  $restaurantLocations= Restaurant::find()
    ->select('name, coordinates, id')
    ->asArray()
    ->all();

    foreach ($restaurantLocations as $Restaurant){
        $Locations[]= [$Restaurant['name']];
    }


    echo "<pre>";
    $restaurantLocations = json_encode($restaurantLocations);
    VarDumper::dump($restaurantLocations);
    echo "</pre>";

?>


<script type="text/javascript">
    var locations = [
        ['Bondi Beach', -33.890542, 151.274856, 4],
        ['Coogee Beach', -33.923036, 151.259052, 5],
        ['Cronulla Beach', -34.028249, 151.157507, 3],
        ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];



    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(44.986656, -93.258133),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
</script>