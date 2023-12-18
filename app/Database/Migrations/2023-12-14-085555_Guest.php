<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guest extends Migration
{
    public function up()
    {
        //
            //
        // Membuat kolom/field untuk tabel news
		$this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
			'full_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'phone_number'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
			],
			'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('guests', TRUE);
    }

    public function down()
    {
        //
		$this->forge->dropTable('guests');
    }
}
