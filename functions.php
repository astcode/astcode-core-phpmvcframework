<?php

function dd($data)
{
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
}

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function prePrint($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function ppd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}