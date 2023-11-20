<?php

namespace models;

use controllers\Index;
use DB\Cortex;

class zpravy extends Cortex
{
    protected $db='DB', $table ='zpravy';

    protected $fieldConf = [
        'odesilatel' => ['type' => 'INT', 'nullable' => false],
        'prijemce' => ['type' => 'INT', 'nullable' => false],
        'id' => ['type' => 'INT', 'nullable' => false],
        'datum' => ['type' => 'DATETIME', 'nullable' => false],
        'obsah' => ['type' => 'TEXT', 'nullable' => true],
        'precteno' => ['type'=>'BOOL', 'nullable'=>false],
    ];

}