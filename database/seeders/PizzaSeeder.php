<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizzas;

class PizzaSeeder extends Seeder
{
    public function run()
    {
        Pizzas::create([
            'name' => 'Margherita',
            'description' => 'Classic cheese and tomato Pizzas',
            'price' => 8.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Pepperoni',
            'description' => 'Topped with pepperoni slices',
            'price' => 9.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'BBQ Chicken',
            'description' => 'Grilled chicken with BBQ sauce, onions, and cilantro',
            'price' => 10.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Vegetarian',
            'description' => 'Bell peppers, onions, mushrooms, and olives',
            'price' => 9.49,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Hawaiian',
            'description' => 'Ham and pineapple with mozzarella cheese',
            'price' => 10.49,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Four Cheese',
            'description' => 'A blend of mozzarella, cheddar, parmesan, and gorgonzola',
            'price' => 11.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);
    }
}
