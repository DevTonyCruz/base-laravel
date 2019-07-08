<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\File;

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
                'email' => 'root@arca.test',
                'password' => bcrypt('root123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1
            ],
            [
                'name' => 'Juan',
                'rol_id' => 2,
                'email' => 'dev@arca.test',
                'password' => bcrypt('dev123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1
            ],
            [
                'name' => 'Juan',
                'rol_id' => 3,
                'email' => 'admin@arca.test',
                'password' => bcrypt('admin123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1
            ],
        ];

        //se trunca la tabla
        User::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/users.json');
        $users = json_decode($json);

        foreach ($users as $user) {
            User::create([
                'name' => $user->name,
                'rol_id' => $user->rol_id,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }

        //factory(User::class, 100)->create();
    }
}
