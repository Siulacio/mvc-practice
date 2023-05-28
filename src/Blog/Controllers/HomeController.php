<?php

namespace Blog\Controllers;

class HomeController
{
    public function index()
    {
        echo 'Hola desde el HomeController';

    }

    public function hola(string $nombre)
    {
        echo "Hola {$nombre}";
    }
}
