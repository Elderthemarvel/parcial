<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Libros extends Migration
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
            'titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'fecha_publicacion' => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'precio' => [
                'type' => 'DECIMAL',
                'constraint'=> '7,2',
                'unsigned'       => true,
            ],
            'editorial_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'isbn' => [
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
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('editorial_id', 'editoriales', 'id');
        $this->forge->createTable('libros');
        
    }

    public function down()
    {
        //
        $this->forge->dropTable('libros');
    }
}
