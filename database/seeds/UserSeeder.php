<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $time = Carbon\Carbon::now();

        $datas = [
            [1, '1122222', 'hoan', $time,'male','demo@gmail.com','123456','',$time,'12345678','',$time, $time,''],
            [2, '1122522', 'hoan', $time,'male','test@gmail.com','123456','',$time,'123456abc','',$time, $time,''],
        ];
        foreach ($datas as $item) {
            DB::table('users')->insert([
                'id' => $item[0],
                'employee_id' => $item[1],
                'fullname' => $item[2],
                'birthday' => $item[3],
                'gender' => $item[4],
                'email' => $item[5],
                'phone_number' => $item[6],
                'address' => $item[7],
                'email_verified_at' => $item[8],
                'password' => bcrypt($item[9]),
                'remember_token' => $item[10],
                'created_at' => $item[11],
                'updated_at' => $item[12],
                'image_url' => $item[13],
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
