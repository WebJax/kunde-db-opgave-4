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
		if ( opret_db() ) {
			if ( ! opret_tabel() ) {
				_e ('Tabellen kunne ikke oprettes', 'kdtof_plugin');
			}
		} elseif {
			_e ('Databasen kunne ikke oprettes', 'kdtof_plugin');
		}
	}

	private opret_db() {
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

		// Opret database hvis den ikke findes i forvejen
		$kdtof_sql = "CREATE DATABASE IF NOT EXISTS kdtof";
		if ($kdtof_conn->query($kdtof_sql) === TRUE) {
				$kdtof_oprettet = true;
		}

		// Luk forbindelsen og returner om den er oprettet
		$conn->close();
		return $kdtof_oprettet;
	}

	private opret_tabel() {
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

		// Opret tabellen hvis den ikke findes i forvejen
		$kdtof_sql = "CREATE TABLE IF NOT EXISTS `kundeDB`.`kunde` (
									`id` INT NOT NULL AUTO_INCREMENT ,
									`navn` TEXT NOT NULL ,
									`adresse` TEXT NOT NULL ,
									`postnr` INT NOT NULL ,
									`bynavn` TEXT NOT NULL ,
									`telefon` INT NOT NULL , PRIMARY KEY (`id`)
									) ENGINE = InnoDB;";
		if ($kdtof_conn->query($kdtof_sql) === TRUE) {
				$kdtof_oprettet = true;
		}

		// Luk forbindelsen og returner om den er oprettet
		$conn->close();
		return $kdtof_oprettet;
	}
}
