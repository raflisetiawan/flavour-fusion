<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['method_name' => 'Credit Card'],
            ['method_name' => 'Debit Card'],
            ['method_name' => 'Bank Transfer'],
            // Tambahkan metode pembayaran lain sesuai kebutuhan
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
