<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservation extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
			'reservationID'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'guestID'       => [
				'type'           => 'VARCHAR',
                'constraint'    => 10
			],
			'employeeID'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'checkInDate' => [
				'type'           => 'DATE',
			],
            'checkOutDate' => [
                'type'           => 'DATE',
            ],
            'paymentID'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 10
            ]
		]);

		// Membuat primary key
		$this->forge->addKey('reservationID', TRUE);
        $this->forge->addForeignKey('guestID', 'guest', 'guestID', 'CASCADE', 'CASCADE', 'fk_reservation_guest');
        $this->forge->addForeignKey('employeeID', 'reservationPIC', 'employeeID', 'CASCADE', 'CASCADE', 'fk_reservation_pic');
        $this->forge->addForeignKey('paymentID', 'payment', 'paymentID', 'CASCADE', 'CASCADE', 'fk_reservation_payment');

		// Membuat tabel news
		$this->forge->createTable('reservation', TRUE);

    }

    public function down()
    {
        //
        $this->forge->dropTable('reservation');
    }
}
