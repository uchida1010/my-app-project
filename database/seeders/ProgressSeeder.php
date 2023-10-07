<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Progress;
use App\Http\Const\FormValue;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    for( $i = 0; $i < 3; $i++ ) { 
        Progress::create([
        'name' => FormValue::progress_array[$i]
        ]);
      }
    }
}
