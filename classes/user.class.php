<?php 

//require "./config/database.php";

class User {
    private $user;
    private $nome;
    private $senha;
    private $conn;

    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
        //$this->nome = $nome;
        //$this->senha = $senha;
    }

    public function entrar($nome, $senha) {
        if (empty($nome) || empty($senha)) { return 0; }
        $dados = array();
        $sql = "SELECT id, username, password FROM user WHERE username = :username";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $param_username = trim($nome);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $username = $row['username'];
                        $hashed_password = $row['password'];
                        if (password_verify($senha, $hashed_password)) {
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            header('Location: estacionamento.php');
                        } else {
                            $dados['login_err'] = 'Nome de usuário ou senha inválidos';
                        }
                    }
                } else {
                    $dados['login_err'] = 'Nome de usuário ou senha invalidos';
                }
            } else {
                $dados['login_err'] = 'Ops! Algo deu errado. Por favor, tente novamente.';
            }
            unset($stmt);
        }
        return $dados;
    }

    public function cadastrarUser($dados) {
        if (empty($dados)) {return; }
        /*
        $sql = 'SELECT * from user WHERE username = '.$dados['username'];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll();
        if (count($row) > 0) { return false; }
        */
        $sql = "INSERT INTO user (username, email, password, nomecompleto, tel, cpf) VALUES ('".$dados['username']."', '".$dados['email']."', '".password_hash($dados['password'], PASSWORD_DEFAULT)."', '".$dados['nomecompleto']."', '".$dados['tel']."', '".$dados['cpf']."')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return true;
        
    }
}