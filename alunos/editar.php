<?php
require_once '../config/database.php';

$pdo  = getConnection();
$id   = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = :id');
$stmt->execute([':id' => $id]);
$aluno = $stmt->fetch();

if (!$aluno) {
    die('Aluno não encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf   = preg_replace('/\D/', '', $_POST['cpf']);
    $nome  = trim($_POST['nome']);
    $turma = trim($_POST['turma']);

    $stmt = $pdo->prepare(
        'UPDATE alunos SET cpf = :cpf, nome = :nome, turma = :turma WHERE id = :id'
    );
    $stmt->execute([':cpf' => $cpf, ':nome' => $nome, ':turma' => $turma, ':id' => $id]);
    header('Location: listar.php');
    exit;
}
?>

<form method="POST">

    <h1>Alterar Aluno: <?php echo $aluno['nome'] ?></h1>

    <input name="cpf"   value="<?= $aluno['cpf'] ?>"   required>
    <input name="nome"  value="<?= $aluno['nome'] ?>"  required>
    <input name="turma" value="<?= $aluno['turma'] ?>" required>
    <button type="submit">Atualizar</button>
</form>
