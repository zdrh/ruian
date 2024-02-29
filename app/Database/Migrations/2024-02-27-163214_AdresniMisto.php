<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdresniMisto extends Migration
{
    public function up()
    {
        $fields = [
            'virtualni' => ['type' => 'TINYINT', 'after' => 'nazev'],
        ];
        $this->forge->addColumn('ulice', $fields);

        $fields = [
            'virtualni' => ['type' => 'TINYINT', 'after' => 'nazev'],
        ];
        $this->forge->addColumn('cast_obce', $fields);


    }

    public function down()
    {
        //
    }
}
