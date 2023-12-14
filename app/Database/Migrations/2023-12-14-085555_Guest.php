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
			'guestID'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'guestName'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'phoneNumber'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'address' => [
				'type'           => 'VARCHAR',
				'constraint'           => 255,
			],
		]);

		// Membuat primary key
		$this->forge->addKey('guestID', TRUE);

		// Membuat tabel news
		$this->forge->createTable('guest', TRUE);
    }

    public function down()
    {
        //
		$this->forge->dropTable('guest');
    }
}
