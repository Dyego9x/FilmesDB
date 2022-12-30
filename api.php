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
                    <a href="buscar.php">Buscar</a>                                
                </nav>                
            </section>
        </header>
        <div class="back_detalhes" style="background-image: url('https://image.tmdb.org/t/p/w1920_and_h800_multi_faces/jzdnhRhG0dsuYorwvSqPqqnM1cV.jpg');">
            <div class="efeito_opacity flex">
                <a href=""><img class="m_100_t m_20_b m_30_l border_25" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/5L2IpMfGFfwOmxNdIJeJtdlz03.jpg" alt="Mediaflix" title="Mediaflix"></a>
                <div class="m_120_t m_20_b m_30_l">
                    <p class="font_30"><strong> Velozes & Furiosos 8 (ANO) </strong></p>
                    <p class="font_20"> 22/05/2010 (US) Ação, Thriller 1h 36m </p>
                    <p class="font_20"> Não mais uma família. </p>
                    <p class="font_30"><strong> Sinopse</strong></p>
                    <p class="font_20"> Depois que Brian e Mia se aposentaram, e o resto da equipe foi exonerado, Dom e Letty estão em lua de mel e levam uma vida pacata e completamente normal. Mas a adrenalina do passado volta com tudo quando uma mulher misteriosa faz com que Dom retorne ao mundo do crime e da velocidade. </p>
                </div>
                
            </div>
            
        </div>

        <?php
            include "footer.php";
        ?>


        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>                
        <script>

            function buscarDetalhes (){     
                
                const urlParams = new URLSearchParams(window.location.search);
                const products = urlParams.get("produtos") // livros
                const author = urlParams.get("autor") // Augusto

                $.ajax({
                    type: 'GET',
                    url: "https://api.themoviedb.org/3/movie/337339?api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR",                            
                    dataType: 'json',
                    success: function(retorno) {            
                        console.log(retorno);                          

                        $html = '';

                        for(var i=0; i<retorno["results"].length; i++){                            

                            console.log(retorno["results"][i]); 
                            
                            // Estou convertendo a data que vem no padrão americano para o brasileiro
                            $data =  retorno["results"][i]["release_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');

                            $html += '<div class="flex back_white border_25 result_dados" name = "filme'+[i]+'"><a href="https://api.themoviedb.org/3/movie/'+retorno["results"][i]["id"]+'?api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR"><img class="img_resultado" src="https://image.tmdb.org/t/p/w200'+retorno["results"][i]["poster_path"]+'" alt="'+retorno["results"][i]["title"]+'" title="'+retorno["results"][i]["title"]+'"></a><div class="result_dados"><p class="font_20"><strong>'+retorno["results"][i]["title"]+'</strong></p><p class="font_15 data_lancamento"><strong>Data Lançamento: </strong>'+$data+'</p><p class="font_15 data_lancamento">'+retorno["results"][i]["overview"]+'</p><p class="font_15"><strong>Nota: </strong>'+retorno["results"][i]["vote_average"]+'</p></div></div>';

                        }  
                        
                        if(retorno["results"].length < 1){
                            $html += '<div class="flex back_white border_25"><p class="font_15 m_30_l">Não foram encontrados resultados que correspondam aos seus critérios de busca.</p></div>';
                            console.log('Aqui');
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