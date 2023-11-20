<?php

namespace controllers;

class zavody
{
    public function getnovyZavod(\Base $base)
    {
        /*if($base->get("SESSION.user")){
            if('SESSION.user.role'=='1'){
                echo \Template::instance()->render("novyZavod.html");
            }else{
                $base->set ('error_msg_prihlaseni', 'Pro zobrazení této stránky nemáte oprávnění' );
                echo \Template::instance()->render("prihlasit.html");
            }

        }else {
            $base->set ('error_msg_prihlaseni', 'Pro zobrazení stránky se musíte přihlásit' );
            echo \Template::instance()->render("prihlasit.html");
        }*/
        $base->set ('error_zavod', '' );
        echo \Template::instance()->render("novyZavod.html");

    }

    public function postNovyZavod(\Base $base)
    {
        {
            $zavod = new \models\zavody();

            $zavod->copyfrom($base->get('POST'));

            // Save user data to the database
            $zavod->save();
            $base->clear("SESSION.zavod");

            $base->reroute("admin/");
        }
    }

    public function postRegistrovatZ(\Base $base)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idZavodnika = $_POST["id-zavodnika"];
            $idZavodu = $_POST["id-zavodu"];

            // Zde můžete provést další validace a kontrolu, např. ověření, zda závodník s daným ID existuje a podobně

            // Vytvoření nového závodníka
            $zavodnik = new \models\zavodnik();
            $zavodnik->set('id-zavodnika', $idZavodnika);
            $zavodnik->set('id-zavodu', $idZavodu);
            $zavodnik->set('schvaleno', false); // Můžete přizpůsobit podle vašich požadavků
            $zavodnik->set('datum-prihlaseni', date("Y-m-d H:i:s")); // Aktuální datum a čas
            $zavodnik->set('delka-zavodu', null); // Můžete přizpůsobit podle vašich požadavků
            $zavodnik->set('poradi', null); // Můžete přizpůsobit podle vašich požadavků

            // Uložení závodníka do databáze
            $zavodnik->save();

            // Případné další kroky, např. zobrazení potvrzení
        } else {
            // Případné chybové zprávy nebo přesměrování
        }
    }

    public function getZavodnici(\Base $base)
    {

    }

    public function postZavodnici(\Base $base)
    {
        $idZavodu = $_POST["id-zavodu"];
        $zavody = new \models\zavody();
        $zavod = $zavody->findone(['id=?', $idZavodu]);
        $base->set('zavod', $zavod);
        echo \Template::instance()->render("zavodnici.html");
    }

}