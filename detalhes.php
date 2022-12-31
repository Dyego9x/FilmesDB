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
    <body class="body" onload="buscarDetalhes();">
        
        <header class="header">
            <section class="flex titulo2 m_10_r_p m_40_l">
                <a href=""><img class="logo" src="images/logo.jpeg?v1" alt="Mediaflix" title="Mediaflix"></a>
                <nav class="navbar">
                    <a href="index.php">Início</a>
                    <a href="buscar.php">Buscar</a>                                
                </nav>                
            </section>
        </header>

        <section id="detalhes" name="detalhes">

        </section>

        <div class="modal">            
            <div class="content">
                <section id="video" name="video">

                </section>
                <!-- <iframe class="trailer_detalhes" src="https://www.youtube.com/embed/RbENk4FP0C8" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                <button type="button" class="m_10_t" onclick="switchModal();">Fechar</button>
            </div>            
        </div>              

        <?php
            include "footer.php";
        ?>


        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>                
        <script>

            function buscarDetalhes (){     
                
                const urlParams = new URLSearchParams(window.location.search);
                $id = urlParams.get("id") // id                
                $tipo = urlParams.get("tipo") // id

                if($tipo == "movie"){
                    $url = "https://api.themoviedb.org/3/movie/"+$id+"?api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR";

                    $.ajax({
                        type: 'GET',
                        url: $url,
                        dataType: 'json',
                        success: function(retorno) {            
                            console.log(retorno);                          

                            $html = '';
                            $generos = '';
                                
                            // Estou convertendo a data que vem no padrão americano para o brasileiro
                            $data =  retorno["release_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');

                            for(var i=0; i<retorno["genres"].length; i++){
                                if(i==0){
                                    $generos += ''+retorno["genres"][i]["name"];
                                }else{
                                    $generos += ','+retorno["genres"][i]["name"];
                                }
                                
                            }
                            $generos.replace(' - ', '');

                            $html += '<div class="back_detalhes" style="background-image: url(\'https://image.tmdb.org/t/p/w1920_and_h800_multi_faces'+retorno["backdrop_path"]+'\');"><div class="efeito_opacity flex"><a href=""><img class="m_100_t m_20_b m_30_l border_25" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2'+retorno["poster_path"]+'" alt="Mediaflix" title="Mediaflix"></a><div class="m_120_t m_20_b m_30_l"><p class="font_30"><strong> '+retorno["title"]+' </strong></p><p class="font_20">Lançamento: '+$data+'</p><p class="font_20"> Gênero: '+$generos+' </p><p class="font_20"> '+retorno["tagline"]+' </p><p class="font_30"><strong> Sinopse</strong></p><p class="font_20 m_20_r"> '+retorno["overview"]+' </p><a class="modalBtn flex m_10_t" onclick="switchModal();"><img class="border_25" src="images/play.png?v1" alt="Mediaflix" title="Mediaflix"> <p class="font_20 trailer_buttom m_10_l">Ver Trailer</p></a></div></div></div>';                                                    

                            document.querySelector('#detalhes').innerHTML = $html;

                            $.ajax({
                                type: 'GET',
                                url: 'https://api.themoviedb.org/3/movie/'+retorno["id"]+'/videos?api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR',
                                dataType: 'json',
                                success: function(retorno) {            
                                    console.log(retorno);                          

                                    document.querySelector('#video').innerHTML = '<iframe class="trailer_detalhes" src="https://www.youtube.com/embed/'+retorno["results"][0]["key"]+'" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                    
                                },
                                error: function() {
                                    alert('Erro!');
                                }
                            });

                        },
                        error: function() {
                            alert('Erro!');
                        }
                    });

                }else{
                    $url = "https://api.themoviedb.org/3/tv/"+$id+"?api_key=250e1d8eccd16b39d5de9d3e3b18111a&language=pt-BR";

                    $.ajax({
                        type: 'GET',
                        url: $url,
                        dataType: 'json',
                        success: function(retorno) {            
                            console.log(retorno);                          

                            $html = '';
                            $generos = '';

                            for(var i=0; i<retorno["genres"].length; i++){
                                if(i==0){
                                    $generos += ''+retorno["genres"][i]["name"];
                                }else{
                                    $generos += ','+retorno["genres"][i]["name"];
                                }
                                
                            }
                            $generos.replace(' - ', '');
                                
                            // Estou convertendo a data que vem no padrão americano para o brasileiro
                            $data =  retorno["first_air_date"].replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1');

                            $html += '<div class="back_detalhes" style="background-image: url(\'https://image.tmdb.org/t/p/w1920_and_h800_multi_faces'+retorno["backdrop_path"]+'\');"><div class="efeito_opacity flex"><a href=""><img class="m_100_t m_20_b m_30_l border_25" src="https://image.tmdb.org/t/p/w300_and_h450_bestv2'+retorno["poster_path"]+'" alt="Mediaflix" title="Mediaflix"></a><div class="m_120_t m_20_b m_30_l"><p class="font_30"><strong> '+retorno["name"]+' </strong></p><p class="font_20">Lançamento: '+$data+' </p><p class="font_20"> Gênero: '+$generos+' </p><p class="font_20"> '+retorno["tagline"]+' </p><p class="font_30"><strong> Sinopse</strong></p><p class="font_20 m_20_r"> '+retorno["overview"]+' </p> <a class="modalBtn flex m_10_t" onclick="switchModal();"><img class="border_25" src="images/play.png?v1" alt="Mediaflix" title="Mediaflix"> <p class="font_20 trailer_buttom m_10_l">Ver Trailer</p></a> </div></div></div>';                                                    

                            document.querySelector('#detalhes').innerHTML = $html;
                        },
                        error: function() {
                            alert('Erro!');
                        }
                    });

                }
                
            }


            function switchModal () {
                const modal = document.querySelector('.modal')
                const actualStyle = modal.style.display
                if(actualStyle == 'block') {
                    modal.style.display = 'none'
                }
                else {
                    modal.style.display = 'block'
                }
            }
            
            

        </script>
    </body>
</html>