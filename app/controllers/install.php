<?php

namespace controllers;

class install
{
    public function install(\Base $base)
    {
        \models\User::setdown();
        \models\User::setup();
    }
}