<?php

date_default_timezone_set("Europe/Istanbul");

session_start();

define("app_base", "/");
define("view_dir", "Views/");
define("system_dir", "System/");

# Veri Tabanı Bağlantısı

try {
	static $db = new \PDO('mysql:host=localhost;dbname=macko;charset=utf8', 'root', '');
}catch(\PDOException $e) {
	die($e);
}