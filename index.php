<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1> ciao</h1>

</head>

<body>
    <?php
    $host = "localhost";
    $db = "client";
    $user = "root";
    $pass = "";
    $dsn = "mysql:host=$host;dbname=$db";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    // comando che connette al database
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->query('SELECT * FROM client');

    echo '<ul>';
    foreach ($stmt as $row) {
        echo "<li>$row[name]</li>";
    }
    echo '</ul>';
    ?>
</body>

</html>

<?php
$halaman = 2; //batasan halaman
$page = isset($_GET['halaman']) ? (int)$_GET["halaman"] : 1;
$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
$result = $db->query("SELECT * FROM kategori");
$result->execute();
$total = $result->fetchAll();
$pages = ceil(count($total / $halaman));
$query = $db->prepare("SELECT * FROM kategori LIMIT $mulai, $halaman");
$query->execute();
$data = $query->fetchAll();
$no = $mulai + 1;
?>
<?php foreach ($data as $value) : ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $value['nama_kat']; ?></td>
    <?php
endforeach;
    ?>