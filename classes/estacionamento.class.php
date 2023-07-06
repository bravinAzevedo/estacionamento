<?php 

//

class Estacionamento {
    
    private $conn;

    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
        //$this->nome = $nome;
        //$this->senha = $senha;
    }

    function getVeiculos() {
        $sql = 'SELECT * from vagas WHERE datasaida = "1900-01-01"';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll();
        return $row;
    }

    function isVaga($vaga) {
        if (empty($vaga)) { return; }
        $sql = 'SELECT * from vagas WHERE numerovaga = '.$vaga;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll();
        if (count($row) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function cadastrarVaga($dados) {
        //print_r($dados);
        if (empty($dados)) {return; }
        $sql = 'SELECT * from vagas WHERE numerovaga = '.$dados['numeroVaga'].' AND dataentrada <> "1900-01-01" AND datasaida = "1900-01-01"';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll();
        if (count($row) > 0) { return false; }
        $sql = "INSERT INTO vagas (numerovaga, placa, dataentrada, horaentrada, nome_condutor, cpf, tipoveiculo) VALUES ('".$dados['numeroVaga']."', '".$dados['placa']."', '".$dados['dataEntrada']."', '".$dados['horaEntrada']."', '".$dados['nomecondutor']."', '".$dados['cpf']."', '".$dados['tipoveiculo']."' )";
        //echo '$sql: '.$sql;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    function checkoutVeiculo($id, $data, $hora) {
        if (empty($id)) { return false; }
        $sql = 'update vagas set datasaida = "'.$data.'", horasaida = "'.$hora.'" where id = '.$id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        header("location:".$_SERVER["PHP_SELF"]);
    }


/*
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
    */
}