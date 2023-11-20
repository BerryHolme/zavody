<?php
namespace controllers;

class registrace
{
    public function getPodminky(\Base $base)
    {
        echo \Template::instance()->render("podminky.html");
    }
    public function getRegistrace(\Base $base)
    {
        $base->set('error_msg', '');
        echo \Template::instance()->render("registrace.html");
    }

    public function postRegistrace(\Base $base)
    {
        $user = new \models\User();

        // Check if the email already exists
        $existingUser = $user->findone(["email=?", $base->get('POST.email')]);

        if ($existingUser) {
            // Email already exists, redirect back to registration with a message
            $base->set('error_msg', 'Email už existuje');
            echo \Template::instance()->render("registrace.html");
            //$base->reroute("registraceError/");
        } else {
            // Email is not registered, proceed with registration
            $user->copyfrom($base->get('POST'));
            $user->save();
            $base->reroute("/");
        }
    }

}