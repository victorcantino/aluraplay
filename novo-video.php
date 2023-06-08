<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$url = filter_input(INPUT_GET, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /index.php?sucesso=0');
    
}
$title = filter_input(INPUT_POST, 'titulo');
$sql = 'INSERT INTO videos (url, title) VALUES (:url, :title)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $title);
header('Location: /index.php');
if ($statement->execute() === false) {
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=1');
}
