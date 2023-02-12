<?php

header("Content-Type: application/json");

$coffee_apps = array(
  array("name" => "Coffee Radar", "description" => "A coffee app that helps you find the best coffee shops and beans near you"),
  array("name" => "Order Up", "description" => "A coffee app that lets you order coffee from your favorite local coffee shops"),
  array("name" => "Coffee Central", "description" => "A coffee app that provides detailed information about different types of coffee and brewing methods"),
  
);


$result = array();

foreach ($coffee_apps as $index) {
  $result[] = $index;
}

echo json_encode($result);

?>
