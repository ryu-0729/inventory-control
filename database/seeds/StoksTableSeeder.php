<?php

use Illuminate\Database\Seeder;

class StoksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テストデータの追加
        DB::table('stoks')->insert([
            'name' => 'テスト在庫',
            'price' => 200,
            'quantity' => 3,
            'role' => '発注状態',
        ]);
    }
}
