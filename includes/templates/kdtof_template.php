<?php
/*
Template Name: KundeDatabaseTilOpgave4
*/
get_header(); ?>

<div class="row">
  <div class="eight columns">

    <h1><?php the_title(); ?></h1>
    <?php the_content();?>

    <?php
    // Begynd selve template delen
    ?>
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

  </div>
  <div class="four columns">
    <?php get_sidebar(); ?>
  </div>
</div>
<?php
get_footer();
?>
