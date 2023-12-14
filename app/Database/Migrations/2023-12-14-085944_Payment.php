<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'paymentID'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'billTotal'       => [
				'type'           => 'INT'
			],
			'paymentMethod'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Card', 'Debit']
			],
			'paymentStatus' => [
				'type'           => 'ENUM',
				'constraint'     => ['Paid', 'Unpaid']
			],
		]);

		// Membuat primary key
		$this->forge->addKey('paymentID', TRUE);

		// Membuat tabel news
		$this->forge->createTable('payment', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('payment');
    }
}
