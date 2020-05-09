<?php


$os = getenv('CLEARDB_DATABASE_URL');
if ($os) {
	$url = parse_url($os);
}

echo "OS:".$os."\n";

// CONFIGURACIÓN BASE DE DATOS MYSQL
$servername = $os ? $url["host"] : 'localhost';
$username = $os ? $url["user"] : 'root';
$password = $os ? $url["pass"] : '';
	
// BASE DE DATOS
$dbname = $os ? substr($url["path"], 1) : 'bdgithub';
	
// TABLAS Y SU CLAVE
$tablas = array();
$tablas["empleados"]="id";



