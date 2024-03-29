<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => true
            ],
            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => 200
            ],
            'sts' => [
                'type'              => 'VARCHAR',
                'constraint'        => 30
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('todos');
    }

    public function down()
    {
        //
    }
}
