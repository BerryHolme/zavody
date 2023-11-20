<?php

namespace controllers;

class prihlasit
{

    public function getPrihlasit(\Base $base)
    {
        echo \Template::instance()->render("prihlasit.html");
    }








}
