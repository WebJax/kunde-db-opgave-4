<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */


// This file should primarily consist of HTML with a little bit of PHP.



if (isset($_GET['kdtof_nonce']) && wp_verify_nonce( $_REQUEST['kdtof_nonce'], 'opret-kunde' )) {
  // Rens alle POST-data for uønskede karakterer https://developer.wordpress.org/plugins/security/securing-input/
  $navn = sanitize_text_field($_GET['navn']);
  $adresse = sanitize_text_field($_GET['adresse']);
  $postnr = intval(sanitize_text_field($_GET['postnr']));
  $bynavn = sanitize_text_field($_GET['bynavn']);
  $telefon = intval(sanitize_text_field($_GET['telefon']));

  include ( plugin_dir_path ( __DIR__ ).'/../connection.php' );

  $kdtof_sql = "INSERT INTO kundeDB.kunde (navn, adresse, postnr, bynavn, telefon)
                VALUES ('".$navn."', '".$adresse."', '".$postnr."', '".$bynavn."', '".$telefon."')";
  if ($kdtof_conn->query($kdtof_sql) !== TRUE) {
			_e ('Data kunne kunne ikke oprettes', 'kdtof');
	}
  // Luk database forbindelsen igen - Husk altid at lukke forbindelsen ligeså snart du ikke skal bruge den mere
  $kdtof_conn->close();
}
echo (plugin_dir_path( __DIR__ ) . 'templates/kdtof_template.php');
?>
<h1>Opret kunde i ekstern database</h1>
<form action="http://localhost/NyWP/wp-admin/options-general.php?page=kdtof" method="get">
  <input type="hidden" name="page" value="kdtof" />
  <input type="hidden" name="kdtof_nonce" id="kdtof_nonce" value="<?php echo wp_create_nonce( 'opret-kunde' ); ?>" />
  <table>
    <tr><td><label for="navn">Navn: </td><td><input type="text" id="navn" name="navn" placeholder="Indtast kundenavn" value="" /></label></td></tr>
    <tr><td><label for="adresse">Adresse: </td><td><input type="text" id="adresse" name="adresse" placeholder="Indtast kundeadresse" value="" /></label></td></tr>
    <tr><td><label for="postnr">Postnr: </td><td><input type="text" id="postnr" name="postnr" placeholder="Indtast postnr" value="" /></label></td></tr>
    <tr><td><label for="bynavn">Bynavn: </td><td><input type="text" id="bynavn" name="bynavn" placeholder="Indtast bynavn" value="" /></label></td></tr>
    <tr><td><label for="telefon">Telefon: </td><td><input type="text" id="telefon" name="telefon" placeholder="Indtast kundetelefon" value="" /></label></td></tr>
    <tr><td></td><td align="right"><input type="submit" value="Opret" class="button button-submit"/></td></tr>
  </table>
</form>
<h1>Liste over kunder</h1>
<table id="kunde-tabel">
  <tr><th>ID</th><th>Navn</th><th>Adresse</th><th>Postnr</th><th>Bynavn</th><th>Telefon</th></tr>
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

  $kdtof_sql = "SELECT * FROM kundeDB.kunde";

  $result = $kdtof_conn->query($kdtof_sql);

  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["navn"]. "</td><td>" . $row["adresse"] . "</td><td>" . $row["postnr"] ."</td><td>" . $row["bynavn"] ."</td><td>" . $row["telefon"] ."</td></tr>";
  }

  $kdtof_conn->close();
  ?>
</table>
