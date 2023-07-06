
<?php

session_start();

require "./config/database.php";

//$_SESSION = array();
//session_destroy();

// if (!empty($_SESSION['loggedin'])) {
//     header("Location: welcome.php");
//     exit;
// }

function format_data($al)
{
    $exib = '';
    if(!empty($al)) {
        $exib = substr($al, 8, 2) . "-" . substr($al, 5, 2) . "-" . substr($al, 0, 4);
    }
    return $exib;
}

function format_data_us($data)
{
    $exib = '';
    if(!empty($data)) {
        $exib = substr($data, 6, 4) . "-" . substr($data, 3, 2) . "-" . substr($data, 0, 2);
    }
    return $exib;
}

//require "config.php";
require "classes/user.class.php";

$oUser = new User($pdo);


if ($_POST) {

    $dados = $_REQUEST;

    $oUser->cadastrarUser($dados);
    header('location:index.php');
}

    $pagina = 'cadastro';

    require('modulos/head.php');
    require('modulos/topo.php');
?>

    <div class="bodyform">

        <div class="container">
            <div class="form-image">
                <img src="img/img-parking/cadastro600.jpg" alt="mulher no estacionamento">
            </div>

            <div class="form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="usercadastro">
                    <div class="form-header">
                        <div>
                            <h1>Cadastra-se</h1>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-box">
                            <label for="nomecompleto">Nome todo</label>
                            <input type="text" id="nomecompleto" name="nomecompleto" placeholder="Digite seu nome todo" required>
                        </div>

                        <div class="input-box">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="Digite seu email" required>
                        </div>

                        <div class="input-box">
                            <label for="number">Celular</label>
                            <input type="numer" id="tel" name="tel" placeholder="(xx) xxxx-xxxx" required>
                        </div>

                        <div class="input-box">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" required>
                        </div>
                    <!--
                        <div class="input-box">
                            <label for="veiculo">Veiculo</label>
                            <input type="text" id="veiculo" name="veiculo" placeholder="Digite seu veículo" required>
                        </div>
                    
                        <div class="input-box">
                            <label for="placa">Placa</label>
                            <input type="text" id="placa" name="placa" placeholder="Digite a placa do seu carro" required>
                        </div>
                    -->
                        <div class="input-box">
                            <label for="password">Username</label>
                            <input type="text" id="username" name="username" placeholder="Digite seu login" required>
                        </div>

                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                        </div>
                    </div>

                    <div class="continue-button">
                        <button><a href="#">Cadastrar</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <img src="img/logo.png">       
        <div class="redessociais">
            <ul class="lista2">
                <li class="icones"><a href="https://www.facebook.com/profile.php?id=100091836685763"><img src="./img/facebook.png"/></a></li>
                <li class="icones"><a href="https://www.instagram.com/parking_klm"><img src="img/instagram.png"/></li>
                <li class="icones"><a href="https://www.linkedin.com/in/parking-estacionamentos-15223a274"><img src="./img/linkedin.png"/></li>
            </ul>
        </div>
        <h4>Direitos Autorais 2023 - Parking.com</h4>
        <h4>CNPJ: 80.520.963/0001-00</h4>
    </footer>
</body>
</html>