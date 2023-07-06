<?php
    $pagina = 'pagamentos';

    require('modulos/head.php');
    require('modulos/topo.php');
?>


 
    <article>
   
    <!--div título Pagamento-->
    <div class="titulo_pagamento">
        <h1>Pagamentos</h1><br>
    </div>
            <div class="organizaPagamentos">

                <!--div Pagamentos-->
                <div class="pagamento">
                  
                         <!--formulário de pagamento-->
                    <form action="action_page.php" method="get">
                                               
                        <div class="caixaformulario">

                            <label for="number">CPF:</label><br><br>
                            <input  class="descricao" type="text" id="number" name="cpf" autofocus placeholder="  digite seu cpf" required><br>
                       
                            <label for="placa">Placa:</label><br><br>
                            <input  class="descricao" type="text" id="placa" name="placaveiculo" placeholder="  placa do veículo" required><br>

                            <label for="valor">Valor fixo:</label><br><br>
                            <input class="descricao" value="  R$ 3.00/h" type="text" id="valor" name="valordescription"><br><br>
                            
                            <label for="hora">Horas:</label><br><br>
                            <input  class="descricao" type="number" id="hora" name="hora" placeholder="  digite quantas horas" required><br>

                            <label for="valortotal">Valor total:</label><br><br>
                            <input  class="descricao" type="text" id="valortotal" name="valortotal"><br><br>

                            <button type="button" >Calcular valor</button><br><br>

                            <label for="metodo">Selecione o método de pagamento:</label><br><br>
                            <input list="metodos" name="metodopagamento" id="metodo" required>
                            <datalist id="metodos">
                                <option value="Pix"></option>
                                <option value="Cartão"></option>
                                <option value="Dinheiro"></option>
                            </datalist><br><br>

                            <label for="descricao">Descrição do pagamento:</label><br><br>
                            <textarea id="descricao" name="descricaopagamento" rows="10" cols="50"></textarea><br><br>
                           
                           

                        <button type="button" value="Pagar" class="botao_formulario">Pagar</button>

                    </form>
                </div>
            </div>  
     
        </article>

    <footer>
        <img src="img/logo.png">
        <ul class="lista">
            <li class="itens"><a href="inicio.html">Home</a></li>
            <li class="itens"><a href="parking.html">Parking.com</a></li>
            <li class="itens"><a href="pagamentos.html">Pagamentos</a></li>
            <li class="itens"><a href="atendimento.html">Atendimento</a></li>
        </ul>
        <div class="redessociais">
            <ul class="lista2">
                <li class="icones"><a href="https://www.facebook.com/profile.php?id=100091836685763"><img src="./img/facebook.png"/></a></li>
                <li class="icones"><a href="https://www.instagram.com/parking_klm"><img src="img/instagram.png"/></a></li>
                <li class="icones"><a href="https://www.linkedin.com/in/parking-estacionamentos-15223a274"><img src="./img/linkedin.png"/></a></li>
            </ul>
        </div>
            <h4>Direitos Autorais 2023 - Parking.com</h4>
            <h4>CNPJ: 80.520.963/0001-00</h4>   
    </footer>

    <script src="js/pagamento.js"></script>
    <script src="js/atendimento.js"></script>

</body>
</html> 