<?php

$id = filter_input_array(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: index.php?sucesso=0');
    throw new InvalidArgumentException('O identificador não é válido.');
}
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: index.php?sucesso=0');
    throw new InvalidArgumentException('A url não é válida.');
}
$title = filter_input(INPUT_POST, 'titulo');
$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':url', $url);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':id', $id);
if ($stmt->execute() === false) {
    header('Location: index.php?sucesso=0');
    throw new RuntimeException('Ocorreu um erro ao tentar salvar.');
}
header('Location: index.php?sucesso=1');
