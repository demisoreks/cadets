<?php

use Illuminate\Database\Seeder;

use App\CdtConfig;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = [
            'entrance_pass_mark' => 0.0,
            'exam_pass_mark' => 0.0
        ];
        
        CdtConfig::insert($config);
    }
}
