<?php
    error_reporting(E_ERROR | E_PARSE);
	$databaseHost = "localhost";
	$databaseUsername = "root";
	$databasePassword = "";
	$databaseName = "currencyconversiondb";
    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    if (!$mysqli) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
    error_reporting(E_ALL);
?>