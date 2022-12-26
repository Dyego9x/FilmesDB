<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">        
        <title>Mediaflix</title>
        <meta name="description" content="Filmes DB">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/responsivo.css">
        <link rel="stylesheet" href="css/carrosel.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body class="body">

        <header class="header">
            <section class="flex titulo2 m_40_r m_40_l">
                <a href=""><img class="logo" src="images/logo.jpeg?v1" alt="Mediaflix" title="Mediaflix"></a>
                <nav class="navbar">
                    <a href="index.php">Início</a>
                    <a href="">Filmes</a>
                    <a href="">Séries</a>                
                </nav>                
            </section>
        </header>

        <div class="back_white m_40_t">        

            <div class="container">                  

                <div class="flex">
                    <div class="container_melhores w_100">
                        <h1>Melhores <b class="azul_padrao">Mediaflix</b></h1>
                        
                        <p class="font_30">Veja abaixo os melhores filmes do momento!</p>

                        <div class="flex">
                            <a href=""><img class="imagem_principal" src="images/vingadores.webp?v1" alt="vingadores" title="vingadores"></a>
                            <div class="m_40_l">
                                <p class="font_20"><strong>Vingadores (2022)</strong></p>
                                <p class="font_20"><strong>Sinopse:</strong></p>
                                <p class="font_20"><strong>Estou testando a digitação do meu teclado, aparentemente é bem gostoso de se digitar, sem reclamações o único lado ruim seria ele não conter os numpad</strong></p>
                            </div>
                        </div>
                        

                    </div>
                    <div class="op_filtros">                    
                        <form method="POST" id="filtro_filmes" name="filtro_filmes" class="filtro" enctype="multipart/form-data">
                            <input name="filtro_hash" id="filtro_hash" type="hidden" value="19955514" required>		
                            <div class="flex">                    
                                <div class="fields_form w_100">
                                    <p class="font_30">Encontre seu filme</p>

                                    <div class="w_80 input flex ">                           
                                        <div class="city flex">                                    
                                            <input id="nome" name="nome" class="form-control"  placeholder="Digite o nome do filme" type="text" maxlength="200" />
                                        </div>
                                    </div>

                                    <div class="w_80 input flex">                           
                                        <div class="city flex">                                    
                                            <select name="genero">
                                                <option value="valor1" selected disabled>Escolha o gênero</option>
                                                <option value="valor2">Ação e aventura</option>
                                                <option value="valor3">Romance</option>
                                                <option value="valor3">Drama</option>
                                                <option value="valor3">Documentário</option>
                                                <option value="valor3">Suspense</option>
                                                <option value="valor3">Terror</option>
                                                <option value="valor3">Musical</option>
                                                <option value="valor3">Ficção científica</option>
                                                <option value="valor3">Policial</option>
                                                <option value="valor3">Dança</option>
                                                <option value="valor3">Fantasia</option>
                                                <option value="valor3">Faroeste</option>
                                            </select>
                                        </div>
                                    </div>                                

                                    <div class="w_80 center">
                                        <button type="button" class="button simulate_class" onclick="filtrarFilmes()">Buscar!</button>
                                    </div>
                                </div>                    
                            </div>
                        </form>
                    </div>
                </div>   
                <div class="m_40_t center">
                    <div>
                        <p class="font_60 titulo gradient_font"> <strong>Lançamentos Populares</strong></p>
                    </div>
                    <section class="slider troca_automatica">
                        <input name='slide' type="radio" checked>
                        <input name='slide' type="radio" >
                        <input name='slide' type="radio">
                        <input name='slide' type="radio">
                    
                        <div class="slider-content m_40_t m_25_l_p sinopse">
                            <div class="slider-item flex">
                                <a href=""><img class="img_destaques" src="images/spy.jpg?v1" alt="Wandinha" title="Wandinha"></a>
                                <div class="m_40_l w_30">
                                    <p class="font_20"><strong>SPY×FAMILY (2022)</strong></p>
                                    <p class="font_15">Há décadas, as nações de Ostania e Westalis promovem uma guerra fria sem fim. Para investigar os movimentos do presidente de um importante partido político, Westalis mobiliza Twilight, seu melhor agente, a montar uma família falsa e se infiltrar nos eventos sociais promovidos pela escola do filho do político. Mas por um acaso do destino, Twilight acaba adotando Anya, uma jovem com poderes telepáticos, e se "casando" com Yor, uma assassina profissional! Sem saberem das identidades uns dos outros, este trio incomum vai embarcar em aventuras cheias de surpresas para garantir a paz mundial.</p>
                                </div>
                            </div>
                            <div class="slider-item flex">
                                <a href=""><img class="img_destaques" src="images/wan.jpg?v1" alt="Wandinha" title="Wandinha"></a>
                                <div class="m_40_l w_30">
                                    <p class="font_20"><strong>Wandinha (2022)</strong></p>
                                    <p class="font_15">Inteligente, sarcástica e apática, Wandinha Addams pode estar meio morta por dentro, mas na Escola Nunca Mais ela vai fazer amigos, inimigos e investigar assassinatos.</p>
                                </div>
                            </div>
                            <div class="slider-item flex">
                                <a href=""><img class="img_destaques" src="images/teste.jpg?v1" alt="Wandinha" title="Wandinha"></a>
                                <div class="m_40_l w_30">
                                    <p class="font_20"><strong>Wandinha (2022)</strong></p>
                                </div>
                            </div>
                            <div class="slider-item flex">
                                <a href=""><img class="img_destaques" src="images/teste.jpg?v1" alt="Wandinha" title="Wandinha"></a>
                                <div class="m_40_l w_30">
                                    <p class="font_20"><strong>Wandinha (2022)</strong></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>         
                            
            </div>

        </div>     
        <?php
            include "footer.php";
        ?>
        
        <script src="" async defer></script>
    </body>
</html>