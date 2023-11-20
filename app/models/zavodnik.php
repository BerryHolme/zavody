<?php
namespace models;

use DB\Cortex;

class zavodnik extends Cortex
{
    protected $db = 'DB', $table = 'zavodnik';
    protected $fieldConf = [
        'id-zavodnika' => ['type' => 'INT', 'nullable' => false],
        'id-zavodu' => ['type' => 'INT', 'nullable' => false],
        'schvaleno' => ['type' => 'BOOL', 'nullable' => false],
        'datum-prihlaseni' => ['type' => 'DATETIME', 'nullable' => false],
        'delka-zavodu' => ['type' => 'TIME', 'nullable' => false],
        'poradi' => ['type' => 'INT', 'nullable' => false],
    ];

    // Add foreign key constraint
    protected $foreignKeys = [
        'id-zavodu' => [
            'table' => 'zavody',
            'field' => 'id',
        ],
    ];
}
