<?php
$host = getenv('DB_HOST') ?: 'sql108.infinityfree.com';
$dbname = getenv('DB_NAME') ?: 'if0_37760387_primelendrow';
$username = getenv('DB_USER') ?: 'if0_37760387';
$password = getenv('DB_PASS') ?: 'vgtFhhnvr8C';
$secret_key = getenv('SECRET_KEY') ?: 'primelendrowgeneralsecurity123098';

$connection = mysqli_connect ($host, $username, $password, $dbname);

if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
}
?>