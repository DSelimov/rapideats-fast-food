<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizzas;

class PizzaSeeder extends Seeder
{
    public function run()
    {
        $descriptions = json_decode(file_get_contents(storage_path('pizza_description_storage/pizza_description_storage.json')), true);

        Pizzas::create([
            'name' => 'Margherita',
            'description' => 'Ingredients: ' . implode(', ', $descriptions['Margherita']['ingredients']) . "\n" . $descriptions['Margherita']['description'],
            'price' => 8.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Pepperoni',
            'description' => 'Ingredients: ' . implode(', ', $descriptions['Pepperoni']['ingredients']) . "\n" . $descriptions['Pepperoni']['description'],
            'price' => 9.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'BBQ Chicken',
            'description' => 'Ingredients: ' . implode(', ', $descriptions['BBQ Chicken']['ingredients']) . "\n" . $descriptions['BBQ Chicken']['description'],
            'price' => 10.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Vegetarian',
            'description' => 'Ingredients: ' . implode(', ', $descriptions['Vegetarian']['ingredients']) . "\n" . $descriptions['Vegetarian']['description'],
            'price' => 9.49,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Hawaiian',
            'description' => 'Ingredients: ' . implode(', ', $descriptions['Hawaiian']['ingredients']) . "\n" . $descriptions['Hawaiian']['description'],
            'price' => 10.49,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);

        Pizzas::create([
            'name' => 'Four Cheese',
            'description' => 'Ingredients: ' . implode(', ', $descriptions['Four Cheese']['ingredients']) . "\n" . $descriptions['Four Cheese']['description'],
            'price' => 11.99,
            'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
        ]);
    }
}
