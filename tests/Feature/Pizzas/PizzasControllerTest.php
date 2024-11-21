<?php

namespace Tests\Feature\Pizzas;

use App\Models\Pizzas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PizzasControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a single pizza record.
     * @return void
     */
    public function testCreatePizza()
    {
        $pizza = Pizzas::factory()->createOne();

        $this->assertDatabaseHas('pizzas', [
            'name' => $pizza->name,
            'description' => $pizza->description,
            'price' => $pizza->price,
        ]);
    }

    /**
     * Test creating multiple pizza records.
     * @return void
     */
    public function testCreateManyPizzas()
    {
        $pizzas = Pizzas::factory()->createMany(5);

        $this->assertCount(5, $pizzas);

        foreach ($pizzas as $pizza) {
            $this->assertDatabaseHas('pizzas', [
                'name' => $pizza->name,
                'description' => $pizza->description,
                'price' => $pizza->price,
            ]);
        }
    }

    /**
     * Test updating a pizza record.
     */
    public function testUpdatePizza()
    {
        $pizza = Pizzas::factory()->create([
            'name' => 'Original Name',
            'description' => 'Original Description',
            'price' => 10.99,
        ]);

        $pizza->update([
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 12.99,
        ]);

        $this->assertDatabaseHas('pizzas', [
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 12.99,
        ]);

        $this->assertDatabaseMissing('pizzas', [
            'name' => 'Original Name',
            'description' => 'Original Description',
            'price' => 10.99,
        ]);
    }

    /**
     * Test deleting a pizza record.
     * @return void
     */
    public function testDeletePizza()
    {
        $pizza = Pizzas::factory()->create();

        $pizza->delete();

        $this->assertDatabaseMissing('pizzas', [
            'id' => $pizza->id,
        ]);
    }
}

