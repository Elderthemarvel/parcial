<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paises extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'pais_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('pais_id', true);
        $this->forge->createTable('paises');
    }

    public function down()
    {
        //
        $this->forge->dropTable('paises');
    }
}
