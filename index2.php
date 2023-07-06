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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        html {
            height: -webkit-fill-available;
            }
        body {
            min-height: 100vh;
            /* mobile viewport bug fix */
            font-family: sans-serif;
            letter-spacing: -.6px;
            font-weight: 500;
            background-color: #e7e7e7;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        div {
            /*border: 1px solid gray;*/
        }
        p, h1, h2, h3, h4, h5, h6, span, a, label {
            /*color: red !important;*/
        }
        .ft-bold {
            font-weight: bold;
        }
        .ft-color-1 {
            color: #5D5E5F;
        }
        .ft-spaced {
            letter-spacing: 1.4px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-radius: 6px;
        }
        .btn-action {
            background-color: #2273ec;
            opacity: 1;
            max-width: 100%;
            width: 100%;
            border: none;
        }
        a.btn-action:hover {
            opacity: 0.8;
        }
        .btn {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }
        .btn-secondary {
            color: blue;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }
        .container {
            display: flex;
            /*justify-content: center;*/
            align-items: center;
            flex-direction: column;
            flex: 1;
            /*margin-top: 50px;*/
        }
        .signup, .login {
            flex: 0 1 366px;
            border: none;
            border-radius: 8px;
            padding-top: 5px;
            background-color: #ffffff;
            box-shadow: rgba(0, 0, 0, 0.04) 0px 3px 5px;
            max-width: 366px;
            width: 100%;
            padding-bottom: 20px;
        }
        .signup, .login {
            
        }
        .signup, .login {
            position: relative;
        }
        .container span.close {
            position: absolute;
            top: 15px;
            right: 20px;
            border: 1px solid lightgray;
            padding: 4px 8px;
            border-radius: 50%;
            font-size: 14px;
            color: gray;
        }
        .container .title {
            padding: 23px;
        }
        .signup .title h2 {
            
        }
        .container .signup-google {
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }
        .container .signup-google a {
            display: flex;
            justify-content: center;
            padding: 10px;
            width: 87%;
            border: 1px solid lightgray;
            border-radius: 6px;
            text-decoration: none;
        }
        .signup-google a:hover {
            color: white;
            background-color: blue;
        }
        hr.divider {
            display: block;
            margin: 25px 24px 15px 24px;
            border: none;
            background-color: lightgray;
            height: 1px;
        }
        .form-group {
            padding: 10px 20px 8px 23px;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        div.button {
            padding: 5px 25px;
        }
        .form-group label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        .form-group input {
            font-size: 16px;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 2px;
            border: 1px solid lightgray;
        }
        .form-group input::placeholder {
            color: lightgray;
        }
        .form-group .iconpass {
            position: absolute;
        }
        .icon-rtl {
            background: url("https://static.thenounproject.com/png/101791-200.png") no-repeat 97%;
            background-size: 20px;
        }
        .terms {
            padding: 20px 25px;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;

        }
        .terms .labelinput {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .terms .labelinput input[type="checkbox"] {
            -webkit-appearance: none;
            appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: currentColor;
            width: 1.15em;
            height: 1.15em;
            border: 0.15em solid black;
            border-radius: 0.15em;
            transform: translateY(-0.075em);
            margin-right: 8px;
        }
        .terms .labelinput input[type="checkbox"]::before {
            content:"";
            width: 0.65em;
            height: 0.65em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
        }
        .terms .labelinput input[type="checkbox"]:checked::before {
            transform: scale(1);
            background-color: green;
        }
        .terms .labelinput input[type="checkbox"] {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dividerstep {
            display: flex;
            flex-direction: row;
            padding: 0px 20px 10px 20px;
        }
        .dividerstep .step {
            flex: 1;
            height: 4px;
            background-color: lightgray;
            margin: 5px;
            border-radius: 10px;
            border: none;
        }
        .gologin {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .gologin p {
            margin: 0;
            font-size: 16px;
        }
        .gologin a {
            margin: 0;
            font-size: 16px;
            margin-top: -5px;
            margin-bottom: 15px;
        }
        .mt-10 {
            margin-top: 10px !important;
        }
        div.toast {
            position: absolute;
            top: 20px;
            right: 40%;
            max-width: 300px;
            width: 100%;
            background-color: greenyellow;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            border-radius: 6px;
        }
        input.is-invalid {
            border: 2px solid red;
        }
        span.invalid-feedback {
            font-size: 13px;
        }
    </style>

</head>
<body>
    <!-- <div class="wrapper">
        <h2>Login</h2>
        <p>Por favor, preencha os campos para  fazer o login.</p>
        <?php 
            // if (!empty($login_err)) {
            //     echo '<div class="alert alert-danger">'.$login_err.'</div>';
            // }
        ?>

        <form action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            
            <div class="form-group">
                <label>Nome do Usuário</label>
                <input type="text" name="username" class="form-control <?php //echo (!empty($username_err)) ? 'is-invalid':'';?>" value="<?php echo $username; ?>" >
                <span class="invalid-feedback"></php echo $username_err; ?></span>
            </div>

            <div class="form-group">
                <label>Semha</label>
                <input type="text" name="password" class="form-control <?php //echo (!empty($password_err)) ? 'is-invalid':'';?>" value="<?php echo $username; ?>" >
                <span class="invalid-feedback"></php echo $password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
            <p>Não tem conta? <a href="register.php">Inscreva-se agora.</a></p>
            
        </form>

    </div> -->


    <div class="container">

    <div class="login">
            <div class="title">
                <h2>Entrar</h2>
            </div>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                        <label>Nome de Usuário</label>
                        <input type="text" name="username" id="username" placeholder="nome de acesso" class="<?php echo (!empty($username_err)) ? 'is-invalid':'';?>" value="<?php echo $username; ?>" />
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="password" id="password" placeholder="senha" class="icon-rtl <?php echo (!empty($password_err)) ? 'is-invalid':'';?>" value=""/>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                
                    <div class="terms">
                        <label class="labelinput">
                            <input type="checkbox" name="manterconectado" />
                            <p>Mantenha-me conectado</p>
                        </label>
                    </div>
                    <div class="button">
                        <!-- <a href="register-login.php" class="btn btn-action">Entrar</a>   -->
                        <input type="submit" class="btn btn-action" value="Entrar">  
                    </div>
                    <p id="loginerr" style="display:none"><?php echo (!empty($dados['login_err'])) ? $dados['login_err'] : ''; ?></p>
                </form>
            </div>

        </div>

    </div>



    <script>

        

function createNotification(texto='') {
    container = document.querySelector('.container');
    const notif = document.createElement('div');
    notif.classList.add('toast');
    notif.innerText = texto;
    if (texto != '') {
        container.appendChild(notif);
        setTimeout( () => {
            notif.remove();
        }, 3000);
    }
}

let username = document.querySelector('#username');
let password = document.querySelector('#password');
let login_err = document.querySelector('#loginerr').innerText;

console.log('login_err');
console.log(login_err);

if (username.classList.contains('is-invalid') || password.classList.contains('is-invalid')) {
    if (username.value == '') {
    createNotification('Preencha os dados corretamente.');
    } else if (password.value === '') {
        createNotification('Coloque a senha corretamente!');
    }
}

if (login_err != '') {
    createNotification(login_err);
}





    </script>
</body>
</html>