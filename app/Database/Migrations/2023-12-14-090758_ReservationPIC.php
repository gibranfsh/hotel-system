<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReservationPIC extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'employeeID'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
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
		]);

		// Membuat primary key
		$this->forge->addKey('employeeID', TRUE);

		// Membuat tabel news
		$this->forge->createTable('reservationPIC', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('reservationPIC');
    }
}
