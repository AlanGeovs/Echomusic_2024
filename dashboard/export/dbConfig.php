<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "am_inventariov2"; 
$dbPassword = "Y)])HDIHRo&p"; 
$dbName     = "am_inventariov2"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}