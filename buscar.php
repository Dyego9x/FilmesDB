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
            <section class="flex titulo2 m_40_r m_40_l">
                <a href=""><img class="logo" src="images/logo.jpeg?v1" alt="Mediaflix" title="Mediaflix"></a>
                <nav class="navbar">
                    <a href="index.php">Início</a>
                    <a href="">Filmes</a>                                  
                </nav>                
            </section>
        </header>
            
        <form method="get">

            <div class="input m_100_t flex">
                <input id="nome_filme" name="nome_filme" class="form-control w_80"  placeholder="Digite o nome do filme" type="text" maxlength="200" />

                <button type="button" class="buttom_buscar" onclick="buscarFilme()"><a><i class="fa fa-search" aria-hidden="true">  Buscar</i></a></button>
                
            </div>                          

        </form>  
        
        <section class="back_white border_25" id="resultados" name="resultados">
                    
            
        </section>

        <?php
            include "footer.php";
        ?>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>                
        <script>

            function buscarFilme (){                                                  
                $html = '';
                $vazio = 0;

                $.ajax({
                    type: 'GET',
                    url: "https://api.themoviedb.org/3/search/movie?query=" + document.getElementById("nome_filme").value + "&api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR",                            
                    dataType: 'json',
                    success: function(retorno) {            
                        console.log(retorno);                          

                        

                        for(var i=0; i<retorno["results"].length; i++){                            

                            console.log(retorno["results"][i]); 
                            
                            // Estou convertendo a data que vem no padrão americano para o brasileiro
                            $data =  retorno["results"][i]["release_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');

                            $html += '<div class="flex back_white border_25 result_dados m_10_t" name = "filme'+[i]+'"><a href="detalhes.php?tipo=F&id='+retorno["results"][i]["id"]+'"><img class="img_resultado" src="https://image.tmdb.org/t/p/w200'+retorno["results"][i]["poster_path"]+'" alt="'+retorno["results"][i]["title"]+'" title="'+retorno["results"][i]["title"]+'"></a><div class="result_dados m_10_t"><p class="font_20"><strong>'+retorno["results"][i]["title"]+'</strong></p><p class="font_15 data_lancamento"><strong>Data Lançamento: </strong>'+$data+'</p><p class="font_15 data_lancamento">'+retorno["results"][i]["overview"]+'</p><p class="font_15"><strong>Nota: </strong>'+retorno["results"][i]["vote_average"]+'</p></div></div>';

                        }  
                        
                        if(retorno["results"].length < 1){
                            $vazio += 1;
                        }

                        document.querySelector('#resultados').innerHTML = $html;

                        
                    },
                    error: function() {
                        alert('Erro!');
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: "https://api.themoviedb.org/3/search/tv?query=" + document.getElementById("nome_filme").value + "&api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR",                            
                    dataType: 'json',
                    success: function(retorno) {            
                        console.log(retorno);                                                  

                        for(var i=0; i<retorno["results"].length; i++){                            

                            console.log(retorno["results"][i]); 
                            
                            // Estou convertendo a data que vem no padrão americano para o brasileiro
                            $data =  retorno["results"][i]["first_air_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');

                            $html += '<div class="flex back_white border_25 result_dados m_10_t" name = "serie'+[i]+'"><a href="detalhes.php?tipo=F&id='+retorno["results"][i]["id"]+'"><img class="img_resultado" src="https://image.tmdb.org/t/p/w200'+retorno["results"][i]["poster_path"]+'" alt="'+retorno["results"][i]["name"]+'" title="'+retorno["results"][i]["name"]+'"></a><div class="result_dados m_10_t"><p class="font_20"><strong>'+retorno["results"][i]["name"]+'</strong></p><p class="font_15 data_lancamento"><strong>Data Lançamento: </strong>'+$data+'</p><p class="font_15 data_lancamento">'+retorno["results"][i]["overview"]+'</p><p class="font_15"><strong>Nota: </strong>'+retorno["results"][i]["vote_average"]+'</p></div></div>';

                        }  
                        
                        if(retorno["results"].length < 1){
                            $vazio += 1;
                        }

                        if($vazio == 2){
                            $html += '<div class="flex back_white border_25"><p class="font_15 m_30_l">Não foram encontrados resultados que correspondam aos seus critérios de busca.</p></div>';                    
                        }

                        document.querySelector('#resultados').innerHTML = $html;
                        
                    },
                    error: function() {
                        alert('Erro!');
                    }
                });
                
            }
        </script>
    </body>
</html>