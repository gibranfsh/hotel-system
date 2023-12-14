<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReservationPIC extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
			'phoneNumber'       => [
				'type'           => 'VARCHAR',
                'constraint'     => 15
			],
			'address'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => 45
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
		$this->forge->createTable('reservation_pic', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('reservation_pic');
    }
}
