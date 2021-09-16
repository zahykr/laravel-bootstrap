<?php

function getPrix($prixInDecimals){

    $prix = floatval($prixInDecimals) / 100;

    return number_format($prix , 3, ',',' ') . 'DT';
}