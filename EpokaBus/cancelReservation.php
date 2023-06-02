<?php
session_start();
require_once 'functions.php';
if (isset($_GET['ReservationID'])) {
    $reservationID = $_GET['ReservationID'];
    cancelReservation($reservationID);
    header('Location: viewAllReservations.php');
    exit;
}
?>