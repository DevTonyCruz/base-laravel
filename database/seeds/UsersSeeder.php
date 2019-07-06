<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Cruz Antonio',
                'rol_id' => 1,
                'email' => 'root@base.test',
                'password' => bcrypt('admin123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1
            ],
            [
                'name' => 'Juan',
                'rol_id' => 2,
                'email' => 'dev@base.test',
                'password' => bcrypt('admin123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1
            ],
            [
                'name' => 'Juan',
                'rol_id' => 3,
                'email' => 'admin@base.test',
                'password' => bcrypt('admin123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1
            ],
        ];

        DB::table('users')->truncate();

        foreach ($users as $user){
            DB::table('users')->insert($user);
        }

        //factory(User::class, 100)->create();
    }
}
