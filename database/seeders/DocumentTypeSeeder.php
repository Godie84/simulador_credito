<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentType;
use App\Models\Customer;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('document_types')->insert([
            ['name' => 'CC'],
            ['name' => 'CE'],
            ['name' => 'TI'],
            ['name' => 'NIT'],
        ]);
    }
}
