<?php
namespace controllers;
class Index
{
    public function index(\Base $base){
        echo \Template::instance()->render("index.html");

    }
}

