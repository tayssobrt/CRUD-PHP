<?php
require_once '../config/database.php';

$pdo   = getConnection();
$stmt  = $pdo->query('SELECT * FROM alunos WHERE ativo = TRUE ORDER BY nome');
$alunos = $stmt->fetchAll();


if (empty($alunos)) {
    echo '<p>Nenhum aluno encontrado.</p>';
    echo '<a href="cadastro.php">Novo aluno</a>';
    exit;
}
?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Aluno</title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>

    <table>
    <tr><th>CPF</th><th>Nome</th><th>Turma</th><th>Ações</th></tr>
<?php foreach ($alunos as $aluno): ?>
    <tr>
        <td><?= htmlspecialchars(formatarCpf($aluno['cpf'])) ?></td>
        <td><?= htmlspecialchars($aluno['nome']) ?></td>
        <td><?= htmlspecialchars($aluno['turma']) ?></td>
        <td>
            <a href="editar.php?id=<?= $aluno['id'] ?>">Editar</a>
            <a href="deletar.php?id=<?= $aluno['id'] ?>">Excluir</a>
        </td>
    </tr>
<?php endforeach; ?>
    </table>
    <a href="cadastro.php">Novo aluno</a>
</body>

<?php
function formatarCpf(string $cpf): string {
    return substr($cpf, 0, 3) . '.' .
        substr($cpf, 3, 3) . '.' .
        substr($cpf, 6, 3) . '-' .
        substr($cpf, 9, 2);
}
