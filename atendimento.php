<?php
    $pagina = 'atendimento';

    require('modulos/head.php');
    require('modulos/topo_estac.php');
?>

 
        <article>

    <!--div título atendimento-->
    <div class="titulo_atendimento">
        <h1>Atendimento</h1><br>
        
        

    </div>

            <div class="organiza">
                <!--div perguntas frequentes-->
                <div class="diva">
                    <h2 class="divperguntas">Perguntas Frequentes</h2><br><br>

                    <h3>Esqueci minha senha?</h3><br>
                    <p class="tag_p_perguntas">No canto superior direito, em login você terá a opção "Esqueci minha senha" e receberá instruções sobre como alterar sua senha.</p><br>
                    <h3>Perdi meu ticket?</h3><br>
                    <p class="tag_p_perguntas">Na opção do site "Minha vaga" você poderá acessar a opção "Baixar ticket" e assim poderá acessar as informações de localização da sua vaga novamente.</p><br>
                    <h3>Cancelar vaga?</h3><br>
                    <p class="tag_p_perguntas">Caso haja desistência da vaga, vá para a aba "Minha vaga" selecione a vaga registrada e em seguida vá em "Cancelar".</p>
                    <p class="tag_p_perguntas">O cancelamento da vaga deverá ser confirmado na portaria do estacionamento para a liberação do veículo.</p><br>
                    <h3>Contatos</h3><br>
                    <p class="tag_p_perguntas"> Instagram</p>
                    <a href="https://www.instagram.com/parking_klm" target="_blank">Acesse o perfil do Instagram</a><br>
                    <p class="tag_p_perguntas"> Linkedin</p>
                    <a href="https://www.linkedin.com/in/parking-estacionamentos-15223a274" target="_blank">Acesse o perfil do Linkedin</a><br>
                    <p class="tag_p_perguntas"> Facebook</p>
                    <a href="https://www.facebook.com/profile.php?id=100091836685763" target="_blank">Acesse o perfil do Facebook</a>
                    
                </div>

                <!--div formulário-->
                <div class="divb">
                    <h2>Deixe sua Dúvida ou Sugestão</h2><br>

                    <form>
                        <h3>Preencha o formulário:</h3><br>
                        
                        <div class="caixaformulario">
                            <label for="fname">Nome completo:</label><br><br>
                            <input type="text" id="fname" name="fname"><br>
                       
                            <label for="number">Digite seu CPF:</label><br><br>
                            <input type="text" id="number" name="cpf"><br>
                       
                            <label for="tel">Número Celular:</label><br><br>
                            <input type="tel" id="tel" name="celular"><br>
                        
                            <label for="descricao1">Descrição:</label><br><br>
                            <textarea id="descricao1" name="descricaopagamento" rows="10" cols="50"></textarea><br><br>
                       
                        
                       
                            <button type="button" value="Registrar" class="botao_formulario">Registrar</button>

                        </div>

                       
                        

                    </form>

                </div>
            </div>    
        </article>
    </div>

    <footer>
        <img src="img/logo.png">
        <ul class="lista">
            <li class="itens"><a href="/inicio.html">Home</a></li>
            <li class="itens"><a href="/parking.html">Parking.com</a></li>
            <li class="itens"><a href="/pagamentos.html">Pagamentos</a></li>
            <li class="itens"><a href="/atendimento.html">Atendimento</a></li>
        </ul>
        <div class="redessociais">
            <ul class="lista2">
                <li class="icones"><a href="https://www.facebook.com/profile.php?id=100091836685763"><img src="./img/facebook.png"/></a></li>
                <li class="icones"><a href="https://www.instagram.com/parking_klm"><img src="./img/instagram.png"/></li>
                <li class="icones"><a href="https://www.linkedin.com/in/parking-estacionamentos-15223a274"><img src="./img/linkedin.png"/></li>
            </ul>
        </div>
        <h4>Direitos Autorais 2023 - Parking.com</h4>
        <h4>CNPJ: 80.520.963/0001-00</h4>
    </footer>

    <script src="/js/atendimento.js"></script>

</body>
</html> 