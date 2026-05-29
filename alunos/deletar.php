<?php
require_once '../config/database.php';

$pdo  = getConnection();
$id   = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare('UPDATE alunos SET ativo = FALSE WHERE id = :id');
$stmt->execute([':id' => $id]);

header('Location: listar.php');
exit;
