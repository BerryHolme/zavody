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
            $idZavodnika = $_POST["id_zavodnika"];
            $idZavodu = $_POST["id_zavodu"];

            // Zde můžete provést další validace a kontrolu, např. ověření, zda závodník s daným ID existuje a podobně

            // Vytvoření nového závodníka
            $zavodnik = new \models\zavodnik();
            $zavodnik->set('id_zavodnika', $idZavodnika);
            $zavodnik->set('id_zavodu', $idZavodu);
            $zavodnik->set('schvaleno', false); // Můžete přizpůsobit podle vašich požadavků
            $zavodnik->set('datum_prihlaseni', date("Y-m-d H:i:s")); // Aktuální datum a čas
            $zavodnik->set('delka_zavodu', null); // Můžete přizpůsobit podle vašich požadavků
            $zavodnik->set('poradi', null); // Můžete přizpůsobit podle vašich požadavků

            // Uložení závodníka do databáze
            $zavodnik->save();
            $base->reroute("nastenka/");


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
        $idZavodu = $_POST["id_zavodu"];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu]);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("zavodnici.html");
    }

    public function getAdminSeznamZavodu(\Base $base)
    {
        if($base->get("SESSION.user")){
            $user = new \models\User();
            $base->set('user', $user->find());
            //$base64ImageData = base64_encode($_SESSION['user']['image']);

            $zavod = (new \models\zavody)->find([], ['order' => 'id DESC']);
            $base->set('zavody', $zavod);


            echo \Template::instance()->render("adminSeznamZavodu.html");
        }else $base->reroute("/prihlaseni");
    }

    public function getAdminSeznamZavodniku(\Base $base)
    {

    }

    public function postAdminSeznamZavodniku(\Base $base)
    {
        $idZavodu = $_POST["id_zavodu"];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("adminSeznamZavodniku.html");
    }

    public function postSchvalit(\Base $base)
    {
        $idZavodnika = $_POST['zavodnik'];
        $idZavodu = $_POST['zavod'];
        $zavodnici = (new \models\zavodnik)->find(['id_zavodnika', $idZavodnika]);
        foreach ($zavodnici as $zavodnik){
            if($zavodnik->id_zavodu==$idZavodu) {
                $zavodnik->schvaleno = 1;
                $zavodnik->save();
            }
        }
        $base->reroute('/nastenka');


     }

    public function postZamitnout(\Base $base)
    {

    }

    public function getMojeZavody(\Base $base)
    {
        if($base->get("SESSION.user")){
            $idZavodnika = $base->get('SESSION.user[id]');
            $zavodnici = (new \models\zavodnik)->find(['id_zavodnika', 'SESSION.user[id]'],['order' => 'datum_prihlaseni ASC']);
            $base->set('zavodnici', $zavodnici);
            echo \Template::instance()->render("mojeZavody.html");
        }else $base->reroute("/prihlaseni");
    }

}