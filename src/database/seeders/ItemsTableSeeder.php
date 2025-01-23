<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use DateTime;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => '腕時計',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'condition_id' => 1,
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1
            ],
            [
                'name' => 'HDD',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'condition_id' => 2,
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 2
            ],
            [
                'name' => '玉ねぎ3束',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'condition_id' => 3,
                'price' => 300,
                'description' => '新鮮な玉ねぎの３束とセット',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 3
            ],
            [
                'name' => '革靴',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'condition_id' => 3,
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1
            ],
            [
                'name' => 'ノートPC',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'condition_id' => 1,
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 2
            ],
            [
                'name' => 'マイク',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'condition_id' => 2,
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 3
            ],
            [
                'name' => 'ショルダーバッグ',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'condition_id' => 3,
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1
            ],
            [
                'name' => 'タンブラー',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'condition_id' => 4,
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 2
            ],
            [
                'name' => 'コーヒーミル',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'condition_id' => 1,
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 3
            ],
            [
                'name' => 'メイクセット',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'condition_id' => 1,
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1
            ]
        ]);
    }
}
