<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoanStatus;

class LoanStatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['pendiente', 'aprobada', 'rechazada'] as $status) {
            LoanStatus::firstOrCreate(['name' => $status]);
        }
    }
}
