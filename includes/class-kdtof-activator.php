<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    kdtof
 * @subpackage kdtof/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    kdtof
 * @subpackage kdtof/includes
 * @author     Jacob Thygesen <info@jaxweb.dk>
 */
class kdtof_Activator {

	/**
	 * Aktiver plugin.
	 *
	 * Opret database og tabel hvis ikke det allerede er oprettet.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// Skab forbindelse til databasen
		include ( plugin_dir_path (__DIR__).'connection.php' );

		// Opret database hvis den ikke findes i forvejen
		$kdtof_sql = "CREATE DATABASE IF NOT EXISTS kundeDB";
		if ($kdtof_conn->query($kdtof_sql) === TRUE) {
			$kdtof_sql = "CREATE TABLE IF NOT EXISTS `kundeDB`.`kunde` (
										`id` INT NOT NULL AUTO_INCREMENT ,
										`navn` TEXT NOT NULL ,
										`adresse` TEXT NOT NULL ,
										`postnr` INT NOT NULL ,
										`bynavn` TEXT NOT NULL ,
										`telefon` INT NOT NULL , PRIMARY KEY (`id`)
										) ENGINE = InnoDB;";
			if ($kdtof_conn->query($kdtof_sql) !== TRUE) {
					_e ('Tabellen kunne ikke oprettes', 'kdtof');
			}
		} else {
			_e ('Databasen kunne ikke oprettes', 'kdtof');
		}

		// Luk database forbindelsen igen
		$kdtof_conn->close();
	}
}
