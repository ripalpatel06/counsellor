<?php

use Illuminate\Database\Seeder;

class DenominationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('denomination')->insert([
            'name' => 'Catholic',
        ]);

        DB::table('denomination')->insert([
            'name' => 'Baptist',
        ]);

        DB::table('denomination')->insert([
            'name' => 'Christian - no denomination supplied',
        ]);

        DB::table('denomination')->insert([
            'name' => 'Methodist / Wesleyan',
        ]);

        DB::table('denomination')->insert([
            'name' => 'Lutheran',
        ]);

        DB::table('denomination')->insert([
            'name' => 'Presbyterian',
        ]);

        DB::table('denomination')->insert([
            'name' => 'Protestant',
        ]);
    }
}
