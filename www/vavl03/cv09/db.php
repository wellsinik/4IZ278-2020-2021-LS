<?php

//pripojeni do db na serveru eso.vse.cz
// nenahravat username a password, ani dbname na git!
$db = new PDO(
    'mysql:host=localhost;dbname=vavl03;charset=utf8mb4',
    'vavl03', 
    ''
);
//vyhazuje vyjimky v pripade neplatneho SQL vyrazu
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);