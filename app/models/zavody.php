<?php

namespace models;

use controllers\Index;
use DB\Cortex;

class zavody extends Cortex
{
    protected $db = 'DB', $table = 'zavody';
    protected $fieldConf = [
        'id' => ['type' => 'INT4', 'nullable' => false],
        'jmeno' => ['type' => 'VARCHAR256', 'nullable' => false],
        'datum' => ['type' => 'DATETIME', 'nullable' => false],
        'cas' => ['type' => 'DATETIME', 'nullable' => false],
        'start' => ['type' => 'VARCHAR256', 'nullable' => false],
        'cil' => ['type' => 'VARCHAR256', 'nullable' => false],
        'delka' => ['type' => 'VARCHAR256', 'nullable' => false],
        'image' => ['type' => 'VARCHAR256', 'nullable' => false],
        'stav' => ['type' => 'INT4', 'nullable' => false],
    ];
}
