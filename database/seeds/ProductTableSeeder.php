<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'name' => 'Калифорния с креветкой',
            'image' => 'nLFu8913fSXZJOZqXdjLUpng2UdxCLQk.png',
            'composition' => '/ лосось / авокадо / огурец / икра масаго / майонез / 8 шт /',
            'description' => '/ креветка / икра масаго / авокадо / огурец / майонез / 8 шт /',
            'price' => 1400,
            'user_id' => 1,
            'category_id' => 1
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Дракон',
            'image' => 'QivJ2sweCk3FSm6crivdpnLBtHHE3fQs.png',
            'composition' => '/ угорь / икра тобико / сыр филадельфия / лук зеленый /',
            'description' => '',
            'price' => 1900,
            'user_id' => 1,
            'category_id' => 1
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Гурман',
            'image' => 'nLFu8913fSXZJOZqXdjLUpng2UdxCLQk.png',
            'composition' => '/ лосось / огурец / сыр филадельфия / икра лосося / 8 шт /',
            'description' => '...',
            'price' => 2000,
            'user_id' => 1,
            'category_id' => 1
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Калифорния',
            'image' => 'pmDF8bG3wukGQb35l0qWwZAJzDJiim8L.png',
            'composition' => '/ краб / икра тобико / авокадо / огурец / майонез / 8 шт /',
            'description' => '...',
            'price' => 2300,
            'user_id' => 1,
            'category_id' => 1
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Жар-пицца',
            'image' => 'xq1HwaBRLAhfqihaaP8Az221SU7zXvNG.jpeg',
            'composition' => '/ пицца-соус / говядина / пепперони / помидоры / огурцы',
            'description' => '...',
            'price' => 10,
            'user_id' => 1,
            'category_id' => 2
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Аппетитная',
            'image' => 'jocX9BadbA7BRvwKDzHtN2vvyKL5k9F9.jpeg',
            'composition' => '/ пицца соус / ветчина из говядины / пепперони / помидоры черри /',
            'description' => 'Super cool - at least as a child',
            'price' => 3010,
            'user_id' => 1,
            'category_id' => 2
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Шашлычная',
            'image' => 'Nr9xsT7TEgrcdrYgHW8mOaZhSyd1rbOT.jpeg',
            'composition' => '/ пицца-соус / куриная грудка / огурцы маринованные / красный',
            'description' => 'Super cool - at least as a child',
            'price' => 1000,
            'user_id' => 1,
            'category_id' => 2
        ]);
        $product->save();
        $product = new \App\Product([
            'name' => 'Пепперони с грибами',
            'image' => 'jocX9BadbA7BRvwKDzHtN2vvyKL5k9F9.jpeg',
            'composition' => '/ пицца-соус / пепперони / шампиньоны / сыр моцарелла /',
            'description' => 'Super cool - at least as a child',
            'price' => 10,
            'user_id' => 1,
            'category_id' => 1
        ]);
        $product->save();


    }
}
