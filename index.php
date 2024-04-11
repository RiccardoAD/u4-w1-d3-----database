<a href="http://localhost/IFOA0124/S1L3-database-mysql-1/1-pizzeria/?id=1">Pizza 1</a><br>
<a href="http://localhost/IFOA0124/S1L3-database-mysql-1/1-pizzeria/?id=3">Pizza 2</a><br>
<a href="http://localhost/IFOA0124/S1L3-database-mysql-1/1-pizzeria/?id=4">Pizza 3</a><br>

<?php
// connessione al database
// preparazione della query
// esecuzione della query
// usare i dati


$host = 'localhost';
$db   = 'ifoa_pizzeria';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// comando che connette al database
// $pdo = new PDO("mysql:host=localhost;dbname=ifoa_pizzeria", 'root', '', $options);
$pdo = new PDO($dsn, $user, $pass, $options);

// SELECT DI TUTTE LE RIGHE
$stmt = $pdo->query('SELECT * FROM users');
// echo '<ul>';
// while ($row = $stmt->fetch())
// {
//     echo '<pre>' . print_r($row, true) . '</pre>';
//     echo "<li>$row[name]</li>";
// }
// echo '</ul>';

echo '<ul>';
foreach ($stmt as $row) {
    echo "<li>$row[name]</li>";
    echo "<li>$row[surname]</li>";
    echo "<li>$row[age]</li>";
}
echo '</ul>';


// SELECT DI UNA RIGA SPECIFICA
$id = 1;
$id = $_GET['id'];
// $stmt = $pdo->query("SELECT name FROM users WHERE id = $id"); // NON FARE MAI!!!!!!
$stmt = $pdo->prepare("SELECT name FROM users WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<h2>$row[name]</h2>";


// INSERT
$stmt = $pdo->prepare("INSERT INTO users (name,username) VALUES (:belnome, :ottimoprezzo)");
$stmt->execute([
    'belnome' => 'Pizza fatta il pomeriggio',
    'ottimoprezzo' => 0.01,
]);

// DELETE
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

// Uptate
$stmt = $pdo->prepare("UPDATE users SET name = :name  WHERE id = :id");
$stmt->execute([
    'id' => 3,
    'name' => 'Pizza editata'
]);
