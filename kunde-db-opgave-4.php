<?php
/*
Plugin Name: Kunde Database til Opgave 4
Plugin URI: https://github.com/WebJax/kunde-db-opgave-4 Beskrivelse: Oprettelse og anvendelse af en ekstern kunde database i Wordpress
Version: 1.0
Author: Jacob Thygesen
Author URI: http://jaxweb.dk
License: GPLv2
*/
?>


<?php
register_activation_hook( __FILE__, 'prowp_install' );

function prowp_install() {

  /* Bare for eksemplets skyld: Check at det minimum er en version 3.5 af wp */
  global $wp_version;
  if ( version_compare( $wp_version, '3.5', '<' ) ) {
    wp_die( 'This plugin requires WordPress version 3.5 or higher.' );
  }

  /*
   * Herfra bliver pluginnavnet forkortet til kdtof ( (K)unde (D)atabase (t)il (O)pgave (f)ire )
   * Dette for at være sikker på at alle funktioner og variabler er unikke
   */

  kdtof_opret_database()
  if ( kdtof_opret_database() ) {
    kdtof_opret_tabeller();
  }
}

function kdtof_opret_database($kdtof_oprettet) {
  $kdtof_servername = "localhost";
  $kdtof_username = "username";
  $kdtof_password = "password";
  $kdtof_oprettet = false;

  // Opret forbindelse til databasen
  $kdtof_conn = new mysqli($kdtof_servername, $kdtof_username, $kdtof_password);
  // Check at der er forbindelse
  if ($kdtof_conn->connect_error) {
      die("Connection failed: " . $kdtof_conn->connect_error);
  }

  // Opret database hvis den ikke findes i forvejen
  $kdtof_sql = "CREATE DATABASE IF NOT EXISTS kdtof";
  if ($kdtof_conn->query($kdtof_sql) === TRUE) {
      echo "Database created successfully";
      $kdtof_oprettet = true;
  } else {
      echo "Error creating database: " . $kdtof_conn->error;
  }

  // Luk forbindelsen og returner om den er oprettet 
  $conn->close();
  return $kdtof_oprettet;
}

?>
