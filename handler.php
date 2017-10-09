<?php
/**
 * Created by PhpStorm.
 * User: fsoul
 * Date: 10.10.2017
 * Time: 0:38
 */
if(count($_POST) > 0){
    $geoData = array(
        "plotName" => $_POST['name'],
        "lat" => $_POST['lat'],
        "lon" => $_POST['lon'],
    );

    echo json_encode($geoData);
}