<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SepomexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = base_path('sepomex.txt');
        DB::table('sepomex_all')->truncate();

        $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE sepomex_all FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 2 LINES ", addslashes($file));
        DB::connection()->getpdo()->exec($query);

        $insert = "insert into sepomex (state_cod, state, locations_cod, location, zip_code, name) select c_estado, d_estado, c_mnpio, D_mnpio, d_codigo, d_asenta FROM sepomex_all;";
        DB::connection()->getPdo()->exec($insert);
    }
}
