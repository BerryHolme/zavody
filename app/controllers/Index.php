<?php
namespace controllers;
class Index
{
    public function index(\Base $base){
        $base->set("title", "Vítejte na stránce");
        echo \Template::instance()->render("index.html");

    }
}

