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
require "classes/estacionamento.class.php";

$estac = new Estacionamento($pdo);


if ($_POST) {
    //echo 'tem post enviado<br><br>';
    //exit;
    $dados = $_POST;
    $dataAtual = str_replace('/','-', $dados['dataEntrada']);
    $dados['dataEntrada'] = format_data_us($dataAtual);
    $dados['horaEntrada'] = $dados['horaEntrada'].':00';
    $estac->cadastrarVaga($dados);
}

if (!empty($_GET['id'])) {
    //$dataagora = date("Y-m-d");
    $dataagora = date("d-m-Y");
    $horaagora = date("H:i:s");
    $estac->checkoutVeiculo($_GET['id'], $dataagora, $horaagora);
}



$vagas = $estac->getVeiculos();

$listaVagas = "let vagas = [";
//
foreach($vagas as $index => $vaga) {
    $listaVagas .= '{id:"'.$vaga['id'].'", numeroVaga: "'.$vaga['numerovaga'].'", placa:"'.$vaga['placa'].'", dataEntrada:"'.format_data($vaga['dataentrada']).'", 
        horaEntrada:"'.$vaga['horaentrada'].'", dataSaida:"'.format_data($vaga['datasaida']).'", horaSaida:"'.$vaga['horasaida'].'", 
        titulo:"'.$vaga['titulo'].'", descricao:"'.$vaga['descricao'].'", valorTotal:"'.$vaga['valortotal'].'",
        nome_condutor:"'.$vaga['nome_condutor'].'", cpf: "'.$vaga['cpf'].'", tipo:"'.$vaga['tipoveiculo'].'"},';
}
$listaVagas .= "]";
//

echo '<script>';
echo $listaVagas;
echo '</script>';






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.css" integrity="sha512-EM9iXXndA8L72Sgf6i5hYHnfcGNchX5oDY6E/GNvb6CXyEXxyzXeSiXHK9UEpQw+cKD8C4ZU/Qn4HI0z8JPENg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/base.css?v=2">  
    <title>Estacionamento</title>
    <style>
        * { box-sizing: border-box;}
        html, body { margin: 0; padding: 0; min-height: 100vh;}

        body { height: 100%; width:100%;}

        .cinza { background-color: #f1f1f1;}
        .verde { background-color: greenyellow; color:#000;border:none;}
        .roxo {background-color: blueviolet; color: white}

        .container {display:flex;justify-content: center;align-items: center;flex-direction:row;flex-wrap: wrap;
            max-width:1100px;width:100%;margin:0 auto;padding-bottom: 30px;}
        
        #app {display:flex;justify-content: center;align-items: center;flex-direction:row;flex-wrap: wrap;}

        #app > div {
            display:flex;
            align-items:center;
            justify-content:center;
            flex: 0 1 100px;
            border: 1px solid gray;
            padding: 30px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            align-items: center;
            justify-content: center;
        }

        #app > div:hover {
            cursor:pointer;
            background-color: darkblue;
            color: #fff;
        }
        
        #header {
            padding: 30px 10px;
            display: flex;
            align-items:center;
            justify-content:center;
        }
        h1, h2, h3, h4, h5, h6, p { color: #000; margin:0;}

        #dashboard, #historico, #detalhes, #cadastro, #formulario, #relatorio, #checkout { 
            border: 1px solid black;
            border-radius: 8px;
            padding: 20px;
         }
         #historico, #detalhes, #cadastro, #formulario, #relatorio, #checkout {
            display: none;
         }

         .dashvaga { border: 1px solid gray; border-radius:4px; padding: 5px 15px; margin-top:10px; background-color: #f1f1f1;}
        .dashvaga:hover { background-color:#fff; cursor:pointer; } 

         .info-header { display:flex;justify-content: space-between; }
         .info-header p { cursor:pointer; padding: 15px 5px;}

        .border { border: 4px solid red !important; }
        #menu ul {display:flex;}
        #menu ul li {list-style-type: none; margin-right:10px;}
        #menu ul li button {border-radius:3px;}
        #menu ul li button:hover { color:white; background-color:blue; }
        
    </style>
</head>
<body class="cinza">

<?php

require 'modulos/topo_estac.php';

?>
    
<div class="container">

    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <div id="header">
                        <h1>Estacionamento</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="menu">
                        <ul>
                            <li><button id="menudashboard" class="btn btn-success">Dashboard</button></li>
                            <li><button id="menucadastro" class="btn btn-success">Cadastro</button></li>
                            <!--<li><button id="menuhistorico">Histórico</button></li>-->
                        </ul>
                    </div>
                </div>
            </div>
           
        </div>


        <div class="col-sm-12 col-md-6">
            
            <div id="app">
                <div>1</div>
                <div>2</div>
                <div>3</div>
                <div>4</div>
                <div>5</div>
                <div>6</div>
                <div>7</div>
                <div>8</div>
                <div>9</div>
                <div>10</div>
                <div>11</div>
                <div>12</div>
            </div>

        </div>
        <div class="col-sm-12 col-md-6">

            <div class="d-md-none mt-5"></div>
            
            <div id="dashboard">
                <div class="info-header">
                    <h3>Dashboard</h3>
                    <p>voltar</p>   
                </div>
                <div class="info-content">
                </div>
            </div>
            
            <div id="checkout">
                <div class="info-header">
                    <h3>Checkout</h3>
                    <p>voltar</p>   
                </div>
                <div class="info-content">
                    <div class="checkdados" data-nvaga="" data-rid="">
                        <div class="row">
                    <div class="col-sm-6 mb-2"><p><b>Vaga: </b><span id="dashvaga">4</span</p></div>
                    <div class="col-sm-6 mb-2"><p><b>Placa: </b><span id="dashplaca">32fg5yh</span></p></div>
                    <div class="col-sm-6 mb-2"><p><b>Entrada:</b></p><p><span id="dashdataentrada">29/06/2023</span> - <span id="dashhoraentrada">13:22</span></p></div>
                    <div class="col-sm-6 mb-2"><p><b>Saída:</b></p><p><span id="dashdatasaida">29/06/2023</span> - <span id="dashhorasaida">15:47</span></p></div>
                    <div class="col-sm-6 mb-2"><p><b>Tempo Passado:</b></p><p><span id="dashtempopassado"></span></p></div>
                    <div class="col-sm-6 mb-2"><p><b>Valor:</b></p><p><span id="dashvalor"></span></p></div>
                    <div class="col-sm-12 mt-3 mb-3">
                        <button class="btn btn-light" id="btnCheckVoltar">Voltar</button>
                        <button class="btn btn-primary" id="btnFinalizarCheckout">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div id="historico">
                <div class="info-header">
                    <h3>Histórico</h3>
                    <p>voltar</p>  
                </div>
                <div class="info-content">
                    <p>COntent</p>
                </div>
            </div>

            <div id="cadastro">
                <div class="info-header">
                    <h3>Cadastro</h3>
                    <p>voltar</p>  
                </div>

                <div class="info-content">
                    <form class="row g-3 formCadastro" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="formcadastro">
                        <div class="col-md-4">
                          <label for="numeroVaga" class="form-label">numerovaga</label>
                          <select id="numeroVaga" name="numeroVaga" class="form-select" required="required">
                            <option value="" selected>Escolha uma vaga</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="12">13</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="tipoveiculo" class="form-label">tipo veiculo</label>
                          <select id="tipoveiculo" name="tipoveiculo" class="form-select">
                            <option value="carro" selected>Carro</option>
                            <option value="moto">Moto</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="placa" class="form-label">placa</label>
                          <input type="placa" name="placa" class="form-control" id="placa" placeholder="placa" value="459ufier">
                        </div>
                        <div class="col-6">
                          <label for="dataentrada" class="form-label">data entrada</label>
                          <input type="text" data-enabletime="true" name="dataEntrada" class="form-control" id="dataEntrada" placeholder="dataentrada" value="06-06-2023">
                        </div>
                        <div class="col-6">
                          <label for="horaentrada" class="form-label">hora entrada</label>
                          <input type="text" data-enabletime="true" name="horaEntrada" class="form-control" id="horaEntrada" placeholder="horaentrada" value="21:48">
                        </div>
                        <!--
                        <div class="col-6">
                          <label for="datasaida" class="form-label">data saida</label>
                          <input type="text" data-enabletime="true" name="datasaida" class="form-control" id="datasaida" placeholder="datasaida">
                        </div>
                         <div class="col-6">
                          <label for="horasaida" class="form-label">hora saida</label>
                          <input type="text" data-enabletime="true" name="horasaida" class="form-control" id="horasaida" placeholder="horasaida">
                        </div>
                        -->
                        <div class="col-12">
                          <label for="nomecondutor" class="form-label">nome condutor</label>
                          <input type="text" name="nomecondutor" class="form-control" id="nomecondutor" placeholder="nomecondutor" value="jsdhfsdhfsd">
                        </div>
                        <div class="col-md-12">
                          <label for="cpf" class="form-label">cpf</label>
                          <input type="text" name="cpf" class="form-control" id="cpf" placeholder="cpf" value="09732407234">
                        </div>
                    
                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" name="btnVoltarform" class="btn btn-secondary float-end mr-2" id="btnVoltarform">Cancelar
                                </button>
                                <button type="submit" name="btnSubmitform" class="btn btn-primary float-end" id="btnSubmitform">Cadastrar
                                </button>
                              </div>
                              

                        </div>
                      </form>
                </div>
            </div>
          

            <div id="relatorio">
                <div class="info-header">
                    <h3>Relatório</h3>
                    <p>voltar</p>  
                </div>
                <div class="info-content">
                    <p>COntent</p>
                </div>
            </div>


        </div>

    </div>

    

    


</div>

<?php
    require 'modulos/footer.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/moment@2.9.0/moment.js"></script>

<script>
    const clog = (...values) => console.log(...values);

    let historicoVagas = [];

    /*
    let vaga = {id:0, numeroVaga: '10', placa:'0123456', tipoveiculo: 'carro', dataEntrada:'10/02/2023', 
    horaEntrada:'15:20h', dataSaida:'10/02/2023', horaSaida:'15:40h', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:''}


let vagas = [
    {id:0, numeroVaga: '10', placa:'0123456', dataEntrada:'05-06-2023', 
    horaEntrada:'22:20', dataSaida:'', horaSaida:'', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:'',
    nome_condutor:'', cpf: '', tipo:'carro'},
    {id:1, numeroVaga: '2', placa:'0123456', dataEntrada:'05-06-2023', 
    horaEntrada:'22:20', dataSaida:'', horaSaida:'', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:'',
    nome_condutor:'', cpf: '', tipo:'carro'},
    {id:2, numeroVaga: '3', placa:'ofjdfjd4', dataEntrada:'10-02-2023', 
    horaEntrada:'15:26', dataSaida:'10-02-2023', horaSaida:'15:40', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:'',
    nome_condutor:'', cpf: '', tipo:'carro'},
    {id:3, numeroVaga: '6', placa:'0123456', dataEntrada:'10-02-2023', 
    horaEntrada:'09:10', dataSaida:'10-02-2023', horaSaida:'18:12', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:'',
    nome_condutor:'', cpf: '', tipo:'carro'},
    {id:4, numeroVaga: '5', placa:'0123456', dataEntrada:'09-02-2023', 
    horaEntrada:'08:10', dataSaida:'10-02-2023', horaSaida:'10:15', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:'',
    nome_condutor:'', cpf: '', tipo:'carro'},
    {id:5, numeroVaga: '12', placa:'0123456', dataEntrada:'10-02-2023', 
    horaEntrada:'13:10', dataSaida:'10-02-2023', horaSaida:'14:12', 
    titulo:'', descricao:'', tempo_estimado_minutos:'', valorTotal:'', valorPago:'',
    nome_condutor:'', cpf: '', tipo:'carro'}
]
*/

/*
flatpickr('#dataentrada', {
  	//noCalendar: true,
    enableTime: false,
    //dateFormat: 'mm/dd/YYYY h:i K'
  });

flatpickr('#datasaida', {
  	//noCalendar: true,
    enableTime: false,
    //dateFormat: 'mm/dd/YYYY h:i K'
  });

  flatpickr('#horaentrada', {
  	//noCalendar: true,
    enableTime: true,
    dateFormat: 'h:i K'
  });

flatpickr('#horasaida', {
  	//noCalendar: true,
    enableTime: true,
    dateFormat: 'h:i K'
  });
  */


    //let vagasApp = Array.prototype.slice.call(document.querySelectorAll('#app li'));
    let vagasApp = document.querySelectorAll('#app div');
    let dashboard = document.querySelector('#dashboard');
    let dashboardVaga = document.querySelectorAll('#dashboard .info-content');
    let checkout = document.querySelector('#checkout');
    let cadastro = document.querySelector('#cadastro');
    let checkoutVaga = document.querySelectorAll('#checkout .info-content');
    let menuDashboard = document.querySelector('#menudashboard');
    let menuCadastro = document.querySelector('#menucadastro');
    let form = document.querySelector('#formcadastro');
    let btnSubmitForm = document.querySelector('#btnSubmitform');
    let btnVoltarform = document.querySelector('#btnVoltarform');
    let btnFinalizarCheckout = document.querySelector('#btnFinalizarCheckout');
    let vagaSel = '';

    let agora = moment();

    btnVoltarform.addEventListener('click', function() {
        mostrar('dashboard');
    });

    btnFinalizarCheckout.addEventListener('click', function() {
        alert('Checkout feito com sucesso');
        novoestacionamento = estacionamento;
        historicoVagas.push(estacionamento[ $(this).attr('data-id')]);
        estacionamento = novoestacionamento.filter( (item) => item.id != $(this).attr('data-id'));
        mostrar('dashboard');
        location.href = location.href+'?id='+$(this).attr('data-id');
    });

    
    let estacionamento = [];
    let registros = [];

    for (let $i=0;$i<vagas.length;$i++) {
        estacionamento.push(vagas[$i]);
    }

  var submitForm = function(e) {
    vagaEscolha = $('#numeroVaga').find(':selected');
    clog('vagaEscolha', vagaEscolha);
    if (vagaEscolha == 0) { e.preventDefault(); }
    //e.preventDefault();
    console.log(form);
    let itemCadastro = {};
    [].slice.call(document.forms[0]).forEach( (fel, i) => {
        if (fel.localName == 'input') {
            itemCadastro[document.forms[0][i].name] = fel.value;
        }
        if (fel.localName == 'select') {
            [].slice.call(fel).forEach( (f, fi) => {
                if (f.selected) { itemCadastro[document.forms[0][i].id] = document.forms[0][i][fi].value; }
            })
        }
    });

    itemCadastro.id = estacionamento.length;
    estacionamento.push(itemCadastro);
    estacionamento.sort((a,b) => b.vaga - a.vaga);
    RenderEstacionamento();
  };

  //btnSubmitForm.addEventListener('click', submitForm);

    menuCadastro.addEventListener("click", function() { renderCadastro(); })
    menuDashboard.addEventListener("click", function() { RenderEstacionamento(); })

    estacionamento.sort((a,b) => b.vaga - a.vaga);
    RenderEstacionamento();
    selecionaVagas();

    function setRegistro(vaga) {
        registros.push(vaga);
    };

    function setEstacionamento(vaga) {
        estacionamento.push(vaga);
    };

    function RenderEstacionamento() {
        cadastro.style.display = 'none';
        dashboard.style.display = 'block';
        checkout.style.display = 'none';
        let htmlVagas = '';
        dashboardVaga[0].innerHTML = '';
        clog('vagasApp',vagasApp);
        [].slice.call(vagasApp).map((item) => item.classList.remove('verde'));
        if (estacionamento.length > 0) {
            for (let i=0;i<estacionamento.length;i++) {
                let vagaVerde = estacionamento[i].numeroVaga-1;
                vagasApp[estacionamento[i].numeroVaga-1].classList.add('verde'); 
                htmlVagas += renderDashVagas(estacionamento[i]);
            }
            dashboardVaga[0].innerHTML = htmlVagas;
            vagaSel = Array.prototype.slice.call(document.querySelectorAll('#dashboard .dashvaga'));
            vagaSel.map( (item) => { 
                item.addEventListener('click', function() {
                    renderCheckout(this.dataset.rid);
                 });
            });
            
        }
    }

    function renderDashVagas(item) {
        let vaga = item;
        clog('vaga',vaga);
        if (vagas == undefined) { return}
        let html = '';
        html += '<div class="dashvaga" data-nvaga="'+vaga.numeroVaga+'" data-rid="'+vaga.id+'"><div class="row">';
        html += '<div class="col-sm-3"><p><b>Vaga: </b>'+vaga.numeroVaga+'</p></div>';
        html += '<div class="col-sm-3"><p><b>Placa: </b>'+vaga.placa+'</p></div>';
        html += '<div class="col-sm-6"><p><b>Entrada:</b></p><p>'+vaga.dataEntrada+' - '+vaga.horaEntrada+'</p></div>';
        html += '</div></div>';
        return html;
    }

    function renderCheckout(id) {
        clog('checkout', id);
        cadastro.style.display = 'none';
        dashboard.style.display = 'none';
        checkout.style.display = 'block';
        btnFinalizarCheckout.setAttribute('data-id', id);
        let checkback = document.querySelectorAll('#checkout .info-header p');
        checkback[0].addEventListener('click', function() { 
        dashboard.style.display = 'block'; checkout.style.display = 'none'; })
        id = parseInt(id);
        let vagaFilter = estacionamento.filter((v) => { return v.id == id });
        let vaga = vagaFilter[0];
        clog('vaga', vaga);
        let now = moment();
        let dEntrada = moment(vaga.dataEntrada);
        let dSaida = moment(new Date());
        
        clog('vaga.dataEntrada', vaga.dataentrada);
        clog('vaga.horaEntrada', vaga.horaentrada);
        dadosPagamento = getMinutos(vaga.dataEntrada, vaga.horaEntrada, now.format("DD-MM-YYYY"), now.format("HH:mm"));
        clog('dadosPagamento', dadosPagamento);
        $('#dashvaga').text(vaga.numeroVaga);
        $('#dashplaca').text(vaga.placa);
        $('#dashdataentrada').text(vaga.dataEntrada);
        $('#dashhoraentrada').text(vaga.horaEntrada);
        $('#dashdatasaida').text(now.format("DD-MM-YYYY"));
        $('#dashhorasaida').text(now.format("HH:mm"));
        $('#dashvalor').text(dadosPagamento['valor']);
        $('#dashtempopassado').text(dadosPagamento['minutos']+' minutos');
        $('#btnFinalizarCheckout').on('click', function() {
            clog('clicou em finalizar check');
        })
        //clog('minutos', getMinutos(vaga.dataEntrada, vaga.horaEntrada, now.format("DD-MM-YYYY"), now.format("HH:mm")));
    }

    function renderCadastro() {
        //alert(mostrarData())
        mostrar('cadastro');
        let now = moment();
        //$('#dashvaga').val('');
        $('#dashplaca').val('');
        $('#dataEntrada').val(mostrarData());
        $('#horaEntrada').val(mostrarData('hora'));
        $('#dashdatasaida').val('');
        $('#dashhorasaida').val('');
        $('#dashvalor').text('');
        $('#dashtempopassado').text();
        $('#btnFinalizarCheckout').on('click', function() {
            clog('clicou em finalizar check');
        })
        
    }
    
    $('#btnCheckVoltar').on('click', function() { mostrar('dashboard'); })

    function submitForm() {
        clog('submitForm');
    }

    function mostrar(tela) {
        if (tela == 'dashboard' ) {
            RenderEstacionamento();
            cadastro.style.display = 'none';
            dashboard.style.display = 'block';
            checkout.style.display = 'none';
        }
        if (tela == 'cadastro') {
            cadastro.style.display = 'block';
            dashboard.style.display = 'none';
            checkout.style.display = 'none';
        }
    }

    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    function getMinutos(dataEntrada, horaEntrada, dataSaida, horaSaida) {
        
        let pagamento = [];
        
        dataEntrada.replaceAll('-','/');
        dataSaida.replaceAll('-','/');

        //clog('dataEntrada', dataEntrada)
        //clog('horaEntrada', horaEntrada)
        //clog('dataSaida', dataSaida)
        //clog('horaSaida', horaSaida)
        
        let horaEntradaSplit = horaEntrada.split(':');
        const dataEntradaSplit = dataEntrada.split('-');
        const dayEntrada = dataEntradaSplit[0];
        const monthEntrada = dataEntradaSplit[1];
        const yearEntrada = dataEntradaSplit[2];

        let horaSaidaSplit = horaSaida.split(':');
        const dataSaidaSplit = dataSaida.split('-');
        const daySaida = dataSaidaSplit[0];
        const monthSaida = dataSaidaSplit[1];
        const yearSaida = dataSaidaSplit[2];

        clog('horaEntradaSplit', horaEntradaSplit);
        clog('horaSaidaSplit', horaSaidaSplit);

        clog(yearEntrada, monthEntrada - 1, dayEntrada, horaEntradaSplit[0], horaEntradaSplit[1]);

        data1 = new Date(yearEntrada, monthEntrada - 1, dayEntrada, horaEntradaSplit[0], horaEntradaSplit[1]);
        data2 = new Date(yearSaida, monthSaida - 1, daySaida, horaSaidaSplit[0], horaSaidaSplit[1]);

        //data1 = new Date(2023, 6 - 1, 05, 22, 30);
        //data2 = new Date(2023, 6 - 1, 05, 23, 30);

        const diff = Math.abs(data1.getTime() - data2.getTime());

        let days = Math.abs(diff / (1000 * 60 *60 * 60));
        let minutos = (days * 60) * 60
        //console.log('minutos calc:', minutos);
        
        let fracao = Math.ceil(minutos / 15);

        let valor = fracao * 0.80;

        pagamento['fracao'] = fracao;
        pagamento['minutos'] = Math.floor(minutos);
        pagamento['valor'] = formatter.format(valor)

        //clog('pagamento', pagamento);

        return pagamento;
    }

    function selecionaVagas() {
        let numeroVagasOptions = '<option value="" selected>Escolha uma vaga</option>';
        $('#app div').each(function(index, item) {
            //clog('item', item.className);
            if(item.className !== 'verde') { 
                //vagas.push(item.textContent)
                numeroVagasOptions += '<option value="'+item.textContent+'">'+item.textContent+'</option>';
            }
        })
        $('#numeroVaga').html(numeroVagasOptions);
    }

    function mostrarData(tipo=null) {
        // Obtém a data/hora atual
        var data = new Date();

        // Guarda cada pedaço em uma variável
        var dia     = data.getDate();           // 1-31
        var dia_sem = data.getDay();            // 0-6 (zero=domingo)
        var mes     = data.getMonth();          // 0-11 (zero=janeiro)
        var ano2    = data.getYear();           // 2 dígitos
        var ano4    = data.getFullYear();       // 4 dígitos
        var hora    = data.getHours();          // 0-23
        var min     = data.getMinutes();        // 0-59
        var seg     = data.getSeconds();        // 0-59
        var mseg    = data.getMilliseconds();   // 0-999
        var tz      = data.getTimezoneOffset(); // em minutos

        mes += 1;

        if (mes.toString().length == 1) {mes = '0'+mes; } 
        if (min.toString().length == 1) {min = '0'+min; } 

        // Formata a data e a hora (note o mês + 1)
        var str_data = dia + '/' + (mes) + '/' + ano4;
        var str_hora = hora + ':' + min;

        // Mostra o 
        //alert(min.length)
        //alert('Hoje é ' + str_data + ' às ' + str_hora);
        if (tipo == 'data') {return str_data; }
        if (tipo == 'hora') {return str_hora; }
        return str_data;
    }


</script>

</body>
</html>