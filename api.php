<?php

    include 'api_token.php';

    $filme = 'velozes';

    print($api_key);

    print('<pre>');
    print('<hr>');

    $url = 'https://api.themoviedb.org/3/search/movie?query='.$filme.'&api_key='.$api_key.'&language=pt-BR';
    print('https://api.themoviedb.org/3/search/movie?query='.$filme.'&api_key='.$api_key.'&language=pt-BR');

    print('<hr>');

    $json = file_get_contents($url);

    $obj = json_decode($json, true);

    print('<hr>');
    print('<pre>');
    print_r($obj);
