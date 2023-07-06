<?php
session_start();

if (empty($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

</head>
<body>
    
    <h1>Olá, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></h1>.
    <br>
    <h2>Bem vindo ao nosso site.</h2>

    <p>
        <a href="reset-password.php" class="btn btn-warning">Redefina sua senha</a>
        <a href="logout.php" class="btn btn-danger">Sair da conta</a>
    </p>
    


</body>
</html>