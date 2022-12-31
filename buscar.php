<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">        
        <title>Mediaflix</title>
        <meta name="description" content="Filmes DB">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">     
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/responsivo.css">
        <link rel="stylesheet" href="css/carrosel.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    </head>
    <body class="body">
        
        <header class="header">
            <section class="flex titulo2 m_10_r_p m_40_l">
                <a href=""><img class="logo" src="images/logo.jpeg?v1" alt="Mediaflix" title="Mediaflix"></a>
                <nav class="navbar">
                    <a href="index.php">Início</a>                                                  
                </nav>                
            </section>
        </header>
            
        <form method="get">

            <div class="input m_100_t flex">
                <input id="nome_filme" name="nome_filme" class="form-control w_80"  placeholder="Digite o nome do filme" type="text" maxlength="200" />

                <button type="button" class="buttom_buscar" onclick="buscarFilme()"><a><i class="fa fa-search" aria-hidden="true">  Buscar</i></a></button>
                
            </div>                          

        </form>  

        <div class="back_white border_25">

            <section id="filtros" name="filtros">                

            </section>

            <section id="resultados" name="resultados">
                                
            </section>

        </div>
                

        <?php
            include "footer.php";
        ?>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>                
        <script>

            function buscarFilme (){                                                  
                $html = '';
                $filtros = '';
                $vazio = 0;

                $.ajax({
                    type: 'GET',
                    url: "https://api.themoviedb.org/3/search/multi?query=" + document.getElementById("nome_filme").value + "&api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR",                            
                    dataType: 'json',
                    success: function(retorno) {            
                        console.log(retorno);                                                  

                        for(var i=0; i<retorno["results"].length; i++){                            

                            console.log(retorno["results"][i]); 

                            $data = ''; 
                            $nome = '';

                            // Verifico se seria uma série "TV" ou filme "movie", pois dependendo de qual for, muda a forma de pegar a data e título de cada um
                            if(retorno["results"][i]["media_type"] == "tv"){
                                if(retorno["results"][i]["first_air_date"]){
                                    $data =  retorno["results"][i]["first_air_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');// Estou convertendo a data que vem no padrão americano para o brasileiro
                                    $data = $data.replace(/-/g,'/');
                                }                                
                                $nome =  retorno["results"][i]["name"];
                            }
                            if(retorno["results"][i]["media_type"] == "movie"){
                                if(retorno["results"][i]["release_date"]){
                                    $data =  retorno["results"][i]["release_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3-$2-$1');
                                    $data = $data.replace(/-/g,'/');
                                }                                
                                $nome =  retorno["results"][i]["title"];

                            }                                                                                                                   

                            $html += '<div class="flex_const back_white border_25 result_dados m_10_t" name = "filme'+[i]+'"><a href="detalhes.php?tipo='+retorno["results"][i]["media_type"]+'&id='+retorno["results"][i]["id"]+'"><img class="img_resultado" src="https://image.tmdb.org/t/p/w200'+retorno["results"][i]["poster_path"]+'" alt="'+$nome+'" title="'+$nome+'"></a><div class="result_dados m_10_t"><p class="font_20"><strong>'+$nome+'</strong></p><p class="font_15 data_lancamento"><strong>Data Lançamento: </strong>'+$data+'</p><p class="font_15 data_lancamento">'+retorno["results"][i]["overview"]+'</p><p class="font_15"><strong>Nota: </strong>'+retorno["results"][i]["vote_average"]+'</p></div></div>';

                        }  
                        
                        // Verifico se encontrou algum resultado, para saber se apresento a mensagem de aviso ou os itens encontrados
                        if(retorno["results"].length < 1){
                            $html += '<div class="flex_const back_white border_25"><p class="font_15 m_30_l">Não foram encontrados resultados que correspondam aos seus critérios de busca.</p></div>';                    
                        }else{
                            $filtros += '<div class="flex border_buttom_azul"><a class="margin_auto genero_busca active" name="genero" id="genero" onclick="buscarFilme();"><p>Todos</p></a><a class="margin_auto genero_busca" name="genero" id="genero28" onclick="filtrar(28);"><p>Ação</p></a><a class="margin_auto genero_busca" name="genero" id="genero12" onclick="filtrar(12);"><p>Aventura</p></a><a class="margin_auto genero_busca" name="genero" id="genero16" onclick="filtrar(16);"><p>Animação</p></a><a class="margin_auto genero_busca" name="genero" id="genero35" onclick="filtrar(35);"><p>Comédia</p></a><a class="margin_auto genero_busca" name="genero" id="genero10762" onclick="filtrar(10762);"><p>kids</p></a><a class="margin_auto genero_busca" name="genero" id="genero9648" onclick="filtrar(9648);"><p>Mistério</p></a><a class="margin_auto genero_busca" name="genero" id="genero14" onclick="filtrar(14);"><p>Fantasia</p></a><a class="margin_auto genero_busca" name="genero" id="genero99" onclick="filtrar(99);"><p>Documentário</p></a></div>';
                        }

                        document.querySelector('#filtros').innerHTML = $filtros;
                        document.querySelector('#resultados').innerHTML = $html;

                        
                    },
                    error: function() {
                        alert('Erro! Tente novamente.');
                    }
                });                
                
            }

            function filtrar ($genero){                                                  
                $html = '';
                $vazio = 0;                

                $.ajax({
                    type: 'GET',
                    url: "https://api.themoviedb.org/3/search/multi?query=" + document.getElementById("nome_filme").value + "&api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR",                            
                    dataType: 'json',
                    success: function(retorno) {            
                        console.log(retorno);                                                  

                        for(var i=0; i<retorno["results"].length; i++){     
                            
                            $permissao = false; 

                            console.log(retorno["results"][i]); 

                            $data = ''; 
                            $nome = '';

                            // Verifico se seria uma série "TV" ou filme "movie", pois dependendo de qual for, muda a forma de pegar a data
                            if(retorno["results"][i]["media_type"] == "tv"){
                                if(retorno["results"][i]["first_air_date"]){
                                    $data =  retorno["results"][i]["first_air_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');// Estou convertendo a data que vem no padrão americano para o brasileiro
                                    $data = $data.replace(/-/g,'/');
                                }                                
                                $nome =  retorno["results"][i]["name"];
                            }
                            if(retorno["results"][i]["media_type"] == "movie"){
                                if(retorno["results"][i]["release_date"]){
                                    $data =  retorno["results"][i]["release_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3-$2-$1');
                                    $data = $data.replace(/-/g,'/');
                                }                                
                                $nome =  retorno["results"][i]["title"];

                            }                                  
                            
                            // percorro todos os gêneros do item
                            for(var y=0; y<retorno["results"][i]["genre_ids"].length; y++){
                                
                                if(retorno["results"][i]["genre_ids"][y] == $genero){                                    
                                    $permissao = true;
                                }

                            }
                            
                            // Caso o item tenha o gênero pesquisado vou adicionar ele no html
                            if($permissao){
                                $html += '<div class="flex_const back_white border_25 result_dados m_10_t" name = "filme'+[i]+'"><a href="detalhes.php?tipo='+retorno["results"][i]["media_type"]+'&id='+retorno["results"][i]["id"]+'"><img class="img_resultado" src="https://image.tmdb.org/t/p/w200'+retorno["results"][i]["poster_path"]+'" alt="'+$nome+'" title="'+$nome+'"></a><div class="result_dados m_10_t"><p class="font_20"><strong>'+$nome+'</strong></p><p class="font_15 data_lancamento"><strong>Data Lançamento: </strong>'+$data+'</p><p class="font_15 data_lancamento">'+retorno["results"][i]["overview"]+'</p><p class="font_15"><strong>Nota: </strong>'+retorno["results"][i]["vote_average"]+'</p></div></div>';
                            }                            

                        }  
                        
                        if(retorno["results"].length < 1){
                            $html += '<div class="flex_const back_white border_25"><p class="font_15 m_30_l">Não foram encontrados resultados que correspondam aos seus critérios de busca.</p></div>';                    
                        }

                        document.querySelector('#resultados').innerHTML = $html;

                        
                    },
                    error: function() {
                        alert('Erro! Tente novamente.');
                    }
                });                
                
            }

        </script>
    </body>
</html>