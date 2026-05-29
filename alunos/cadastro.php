<?php
require_once '../config/database.php';

$erro = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cpf   = preg_replace('/\D/', '', $_POST['cpf']);
    $nome = trim($_POST['nome']);
    $turma = trim($_POST['turma']);

    if (strlen($cpf) !== 11 or !$nome or !$turma) {
        $erro = 'preencha todos os campos corretamente';
} else {

        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'insert into alunos (cpf, nome, turma) values (:cpf, :nome, :turma)'
            );
        $stmt->execute([':cpf' => $cpf, ':nome' => $nome, ':turma' => $turma]);
        header('location: listar.php');
        exit;
    }
}

?>

<?php if (!empty($erro)): ?>
    <p style="color:red"><?= $erro ?></p>
<?php endif; ?>

<form method="POST">
    <input name="cpf"   placeholder="CPF" required>
    <input name="nome"  placeholder="Nome" required>
    <input name="turma" placeholder="Turma" required>
    <button type="submit">Salvar</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $('#cpf').mask('000.000.000-00');
</script>