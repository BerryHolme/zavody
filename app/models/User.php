<?php

namespace models;

use controllers\Index;
use DB\Cortex;

class User extends Cortex
{
    protected $db='DB', $table ='uzivatele';
    protected $fieldConf=[
        'id' =>['type'=>'INT', 'nullable'=>false],
        'jmeno' =>['type'=>'VARCHAR256','nullable' =>false],
        'email'=>['type'=>'VARCHAR256','nullable' =>false, 'index'=>true, 'unique'=>true, 'default'=>true],
        'heslo'=>['type'=>'VARCHAR256','nullable' =>false],
        'role' =>['type'=>'INT','nullable'=>false],
        'stav' =>['type'=>'INT','nullable'=>false]
    ];


    protected function set_password($value)
    {
        return password_hash($value, algo: PASSWORD_DEFAULT);
    }
}
