<?php

namespace models;

use controllers\Index;
use DB\Cortex;

class zavody extends Cortex
{
    protected $db = 'DB', $table = 'zavody';
    protected $fieldConf = [
        'id' => ['type' => 'INT', 'nullable' => false],
        'jmeno' => ['type' => 'VARCHAR256', 'nullable' => false],
        'datum' => ['type' => 'DATE', 'nullable' => false],
        'cas' => ['type' => 'TIME', 'nullable' => false],
        'start' => ['type' => 'VARCHAR256', 'nullable' => false],
        'cil' => ['type' => 'VARCHAR256', 'nullable' => false],
        'delka' => ['type' => 'VARCHAR256', 'nullable' => false],
        'image' => ['type' => 'LONGBLOB', 'nullable' => false],
        'otevreno' => ['type' => 'BOOL', 'nullable' => false],
        'skoncil' => ['type' => 'BOOL', 'nullable' => false],
    ];
}
