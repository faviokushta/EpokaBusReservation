<?php
require_once 'functions.php';
$routeID = $_POST['routeID'];
$departureTimes = getDepartureTimes($routeID);
foreach ($departureTimes as $day => $times) {
  echo '<optgroup label="' . $day . '">';
  foreach ($times as $time) {
    echo '<option value="' . $time . '">' . $time . '</option>';
  }
  echo '</optgroup>';
}
?>