<?php
require_once '../config/database.php';

$pdo   = getConnection();
$stmt  = $pdo->query('SELECT * FROM alunos ORDER BY nome');
$alunos = $stmt->fetchAll();
?>

<table>
    <tr><th>CPF</th><th>Nome</th><th>Turma</th><th>Ações</th></tr>
    <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?= htmlspecialchars($aluno['cpf']) ?></td>
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