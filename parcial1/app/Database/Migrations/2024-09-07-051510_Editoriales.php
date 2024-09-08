<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Editoriales extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'telefono' => [
                'type' => 'INT',
                'constraint'=> 8,
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('editoriales');
    }

    public function down()
    {
        //
        $this->forge->dropTable('editoriales');
    }
}
