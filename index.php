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
$limit = 2;
$query = "SELECT count(*) FROM kategori";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results / $limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}



$starting_limit = ($page - 1) * $limit;
$show  = "SELECT * FROM kategori ORDER BY id DESC LIMIT ?,?";

$r = $db->prepare($show);
$r->execute([$starting_limit, $limit]);

while ($res = $r->fetch(PDO::FETCH_ASSOC)) :
?>
    <h4><?php echo $res['id']; ?></h4>
    <p><?php echo $res['nama_kat']; ?></p>
    <hr>
<?php
endwhile;


for ($page = 1; $page <= $total_pages; $page++) : ?>

    <a href='<?php echo "?page=$page"; ?>' class="links"><?php echo $page; ?>
    </a>

<?php endfor; ?>