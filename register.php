<?php
require "config.php";

//variáveis
$username = '';
$password = '';
$confirm_password = '';
$username_err = '';
$password_err = '';
$confirm_password_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty(trim($_POST['username']))) {
        $username_err = 'Por favor, coloque um nome de usuário.';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/',trim($_POST['username']))) {
        $username_err = 'O nome de usuário pode conter apenas letras e números.';
    } else {
        $sql = "SELECT id FROM users WHERE username = :username";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST['username']);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    $username_err = 'Este usuário já existe!';
                } else {
                    $username = trim($_POST['username']);
                }

            } else {
                echo 'Ops! Algo deu errado. Tente novamente.';
            }
            unset($stmt);
        }
    }

if (empty(trim($_POST['password']))) {
    $password_err = 'Por favor, insira uma senha.';
} elseif (strlen(trim($_POST['password'])) < 6) {
    $password_err = 'A senha deve ter pelo menos 6 caracteres';
} else {
    $password = trim($_POST['password']);
}

if (empty(trim($_POST['confirm-password']))) {
    $confirm_password_err = 'Por favor, confirme a senha.';
} else {
    $confirm_password = trim($_POST['confirm-password']);
    if (empty($password_err) && ($password != $confirm_password)) {
        $confirm_password_err = 'A senha não confere.';
    }
}


if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(':username',$param_username, PDO::PARAM_STR);
        $stmt->bindParam(':password',$param_password, PDO::PARAM_STR);
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        if ($stmt->execute()) {
            header('Location: login.php');
        } else {
            echo 'Ops! Algo deu errado. Tente novamente.';
        }
        unset($stmt);
    }
}

unset($pdo);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
<div class="wrapper">

    <h2>Cadastro</h2>
    <p>Por favor, preencha este cadastro para criar uma conta.</p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="form-group">
            <label>Nome do usuário</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid':''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid':''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
            <label>Confirme a Senha</label>
            <input type="text" name="confirm-password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid':''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Criar Conta">
            <input type="reset" class="btn btn-secondary" value="Apagar dados">
        </div>

        <p>Já tem conta? <a href="login.php">Clique aqui.</a></p>


    </form>

</div>

</body>
</html>