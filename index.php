<?php
session_start();

$_SESSION = array();
session_destroy();

// if (!empty($_SESSION['loggedin'])) {
//     header("Location: welcome.php");
//     exit;
// }

//require "config.php";

require "./config/database.php";
require "classes/user.class.php";

$username = '';
$password = '';
$username_err = '';
$password_err = '';
$login_err = '';

//echo password_hash("admin", PASSWORD_DEFAULT);exit;
//$2y$10$4aIpYXL0uEIj1ezmapnzUOj48I.XRPYDPpj63eP4gz4YqcxP2f4Ne

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (empty(trim($_POST['username']))) {
        $username_err = 'Por favor, insira o nome de usuário';
    } else {
        $username = trim($_POST['username']);
    }
    
    if (empty(trim($_POST['password']))) {
        $password_err = 'Por favor, insira sua senha';
    } else {
        $password = trim($_POST['password']);
    }
    
    if (empty($username_err) && empty($password_err)) {
        $user = new User($pdo);
        $dados = $user->entrar(trim($_POST['username']), trim($_POST['password']));
        //echo 'login err<br>';
        //print_r($dados);exit;
    }

    unset($pdo);


}


?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="img/x-icon" href="img/x-icon.ico"> <!-- Imagem na nova guia -->
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <!--cabeçario-->
    <header class="menu-principal">
        <div class="header-1">
            <div class="logo">
                <img src="img/logo.png"/>
            </div>
        </div>
    </header>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="username" name="username" id="username" required>
                        <label for="">Username</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="password" name="password" required>
                        <label for="">Senha</label>
                    </div>
                    <div class="forget">
                        <input type="checkbox">
                        <label for="lembrar">Lembrar usuário. <a href="recuperarsenha.html"> Esqueci minha senha</a></label>
                    </div>
                    <button>Entrar</button>
                    <div class="register">
                        <p>Não tenho cadastro.<a href="cadastro.html"> Cadastrar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
    <script  nomodule  src = "https://unpkg .com/ionicons@7.1.0/dist/ionicons/ionicons.js" > </script>
    <!--rodape-->
    <footer>
        <img src="img/logo.png">
        <div class="redessociais">
            <ul class="lista2">
                <li class="icones"><a href="https://www.facebook.com/profile.php?id=100091836685763"><img src="./img/facebook.png"/></a></li>
                <li class="icones"><a href="https://www.instagram.com/parking_klm"><img src="img/instagram.png"/></a></li>
                <li class="icones"><a href="https://www.linkedin.com/in/parking-estacionamentos-15223a274"><img src="./img/linkedin.png"/></a></li>
            </ul>
        </div>
        <h4>Direitos Autorais 2023 - Parking.com </h4>
        <h4>CNPJ: 80.520.963/0001-00</h4>
    </footer>
    
</body>
</html>