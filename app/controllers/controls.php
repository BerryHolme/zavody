<?php

namespace controllers;

use function React\Promise\all;

class controls
{
    public function getNastenka(\Base $base)
    {
        if($base->get("SESSION.user")){
            $user = new \models\User();
            $base->set('user', $user->find());
            //$base64ImageData = base64_encode($_SESSION['user']['image']);

            $zavod = (new \models\zavody)->find([]);
            $base->set('zavody', $zavod);

            echo \Template::instance()->render("nastenka.html");
        }else $base->reroute("/prihlaseni");
    }

    public function getOdhlasit(\Base $base)
    {
        $userId = $base->get("SESSION.user[id]");

        if ($userId) {
            $user = new \models\User();
            $loggedInUser = $user->findone(["id=?", $userId]);

            if ($loggedInUser) {
                $loggedInUser->stav = 0;
                $loggedInUser->save();
            }
        }

        // Odhlášení a přesměrování
        $base->clear("SESSION.user");
        $base->reroute("/");
    }

    public function getUcet(\Base $base)
    {
        /*if($base->get("SESSION.user")){
            echo \Template::instance()->render("ucet.html");
        }else {
            $base->set ('error_msg_prihlaseni', 'Pro zobrazení stránky se musíte přihlásit' );
            echo \Template::instance()->render("prihlasit.html");
        }*/

        echo \Template::instance()->render("ucet.html");

    }

    public function getAdmin(\Base $base)
    {
        /*if($base->get("SESSION.user")){
            if('SESSION.user.role'=='1'){
                echo \Template::instance()->render("admin.html");
            }else{
                $base->set ('error_msg_prihlaseni', 'Pro zobrazení této stránky nemáte oprávnění' );
                echo \Template::instance()->render("prihlasit.html");
            }

        }else {
            $base->set ('error_msg_prihlaseni', 'Pro zobrazení stránky se musíte přihlásit' );
            echo \Template::instance()->render("prihlasit.html");
        }*/
        echo \Template::instance()->render("admin.html");
    }


}