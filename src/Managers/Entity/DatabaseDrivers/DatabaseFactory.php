<?php
/**
 * Author: Demko Igor
 */

namespace Entity\DatabaseDrivers;


class DatabaseFactory {

	public static function create($ci, $type) {
		switch($type) {
			case 'PDO':
				return new PDODriver($ci);
		}
	}
}