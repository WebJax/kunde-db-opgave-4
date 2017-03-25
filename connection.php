<?php
$kdtof_servername = "localhost";
$kdtof_username = "root";
$kdtof_password = "root";
$kdtof_oprettet = false;

// Opret forbindelse til databasen
$kdtof_conn = new mysqli($kdtof_servername, $kdtof_username, $kdtof_password);
// Check at der er forbindelse
if ($kdtof_conn->connect_error) {
    die("Forbindelsen kunne ikke oprettes: " . $kdtof_conn->connect_error);
}
