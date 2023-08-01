<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $catalogItems = [
            'Верхняя одежда' => ['Куртка', 'Джемпер', 'Пиджак', 'Кардиган', 'Пальто'],
            'Брюки и шорты' => ['Джинсы', 'Бриджи', 'Бананы', 'Леггинсы', 'Бермуды'],
            'Обувь' => ['Сапоги', 'Кроссовки', 'Ботинки зимние', 'Кеды', 'Балетки'],
        ];

        User::truncate();
        Category::truncate();
        Product::truncate();
        OrderProduct::truncate();
        Order::truncate();
        Cart::truncate();

        for($i=1; $i<=3; $i++) {
            User::factory()->create([
                'name' => 'user' . $i,
                'email' => 'test'. $i. '@mail.com',
                'password' => '123123123',
            ]);
        }
        foreach ($catalogItems as $category => $products) {
            Category::factory()->create([
                'name' => $category,
            ]);

            foreach ($products as $product) {
                Product::factory()->create([
                    'name' => $product,
                    'price' => fake()->numberBetween(100, 10000),
                    'category_id' => Category::whereName($category)->first()->id,
                ]);
            }
        }

    }
}
