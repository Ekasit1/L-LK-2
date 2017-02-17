<?php
class sql {
	private static $con;   // con variable existing in sql class. private can only use in the class sql.
	public function sql() { // when function same name as class it is a constructor.
		try {
			self::$con = new PDO("mysql:host=localhost;dbname=blogg;charset=utf8", "root", ""); // static use ::. måste ändra "root" och "".
			// set the PDO error mode to exception
			self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return self::$con;
		} catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}
	public static function get($sql) {
		if($sql !== "") {
			try {
				$q = self::$con->prepare($sql);
				$q->execute();
				return $q->fetchAll(PDO::FETCH_ASSOC);
			} catch(PDOException $e) {
				echo "Fel vid inhämntning från databasen: " . $e->getMessage();
			}
		} else {
			return false;
		}
	}
	public static function set($sql) {
		if($sql !== "") {
			try {
				$q = self::$con->prepare($sql);
				return $q->execute();
			} catch(PDOException $e) {
				echo "Fel vid skrivning till databasen: " . $e->getMessage();
			}
		} else {
			return false;
		}
	}
	public static function lastId() {
		return self::$con->lastInsertId();
	}
}
?>