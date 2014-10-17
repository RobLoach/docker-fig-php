<?php

// Set the configuration variables.
$driver = isset($_ENV['PDO_DRIVER']) ? $_ENV['PDO_DRIVER'] : 'mysql';
$host = isset($_ENV['PDO_HOST']) ? $_ENV['PDO_HOST'] : null;
$user = isset($_ENV['PDO_USER']) ? $_ENV['PDO_USER'] : 'root';
$password = isset($_ENV['PDO_PASSWORD']) ? $_ENV['PDO_PASSWORD'] : 'root';
$password = isset($_ENV['PDO_PORT']) ? $_ENV['PDO_PORT'] : '3306';
$dbname = isset($_ENV['PDO_DBNAME']) ? $_ENV['PDO_DBNAME'] : 'datastore';

// MySQL connection.
$db = new PDO("$driver:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the schema.
$db->query('CREATE TABLE IF NOT EXISTS datastore(name VARCHAR(30), value INT)');

// Retrieve the hits value.
$query = $db->query('SELECT name, value FROM datastore WHERE name = "hits"');
$data = $query->fetch();
$hits = isset($data['value']) ? $data['value'] : 1;

// Add it if it doesn't exist.
if (!$data) {
	$insert = $db->prepare('INSERT INTO datastore (name, value) values (:name, :value);');
	$insert->execute(array(
		'name' => 'hits',
		'value' => $hits + 1,
	));
}
else {
	// Update the value if it exists already.
	$update = $db->prepare('UPDATE datastore SET name = :name, value = :value;');
	$update->execute(array(
		'name' => 'hits',
		'value' => intval($hits) + 1,
	));
}

// @todo Making a dictionary with PDO is silly. We should just use a PDO
// dictionary adaptor, or something.

// Display the output.
echo "Hello world, you have visited this site $hits times.";
