<?php

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($lang){
    case "nl":
        //echo "PAGE FR";
        include("lang_nl.php");//include check session FR
        break;
    default:
        include("lang_en.php");
        break;
}