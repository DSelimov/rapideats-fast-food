<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PizzaSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @description Run PizzaSeeder and test if all pizzas are present in the database after running the PizzaSeeder
     */
    public function testPizzaSeeder()
    {
        $this->artisan('db:seed', ['--class' => 'PizzaSeeder']);

        $expectedPizzas = [
            [
                'name' => 'Margherita',
                'price' => 8.99,
                'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
            ],
            [
                'name' => 'Pepperoni',
                'price' => 9.99,
                'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
            ],
            [
                'name' => 'BBQ Chicken',
                'price' => 10.99,
                'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
            ],
            [
                'name' => 'Vegetarian',
                'price' => 9.49,
                'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
            ],
            [
                'name' => 'Hawaiian',
                'price' => 10.49,
                'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
            ],
            [
                'name' => 'Four Cheese',
                'price' => 11.99,
                'image' => 'images/FsZq235ep5qWFffTBbtgSzUPoDEGRDVZNkWryJSc.jpg',
            ],
        ];

        /**
         * Check if all pizzas are existing after running the seeder
         */
        foreach ($expectedPizzas as $pizza) {
            $this->assertDatabaseHas('pizzas', [
                'name' => $pizza['name'],
                'price' => $pizza['price'],
                'image' => $pizza['image'],
            ]);
        }
    }
}
