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
                    <a href="">Séries</a>                
                </nav>                
            </section>
        </header>
            
        <form method="get">

            <div class="input m_100_t flex">
                <input id="nome_filme" name="nome_filme" class="form-control w_80"  placeholder="Digite o nome do filme" type="text" maxlength="200" />

                <button type="button" class="buttom_buscar" onclick="buscarFilme()"><a><i class="fa fa-search" aria-hidden="true">  Buscar</i></a></button>
                
            </div>                          

        </form>  
        
        <div class="back_white border_25" id="resultados" name="resultados">
                
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>                
        <script>

            function buscarFilme (){                                                    

                $.ajax({
                    type: 'GET',
                    url: "https://api.themoviedb.org/3/search/movie?query=" + document.getElementById("nome_filme").value + "&api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR",                            
                    dataType: 'json',
                    success: function(retorno) {            
                        console.log(retorno);  
                        document.querySelector('#resultados').innerHTML = '<div>Texto aqui!</div>';  

                        $html = '';

                        for(var i=0; i<retorno["results"].length; i++){                            

                            console.log(retorno["results"][i]);                                                        

                            $html += ' <div class="flex back_white border_25" name = "filme'+[i]+'"><a href=""><img class="img_resultado" src="https://image.tmdb.org/t/p/w200'+retorno["results"][i]["poster_path"]+'" alt="SpyxFamily" title="'+retorno["results"][i]["title"]+'"></a><div class="result_dados"><p class="font_20"><strong>'+retorno["results"][i]["title"]+'</strong></p><p class="font_15 data_lancamento"><strong>Data Lançamento: </strong>'+retorno["results"][i]["release_date"]+'</p><p class="font_15 data_lancamento">'+retorno["results"][i]["overview"]+'</p></div></div>';

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