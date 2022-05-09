<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class MealTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testGetMeal()
    {
        $user = new User();
        $user->id = 1;
        $this->be($user);

        $response = $this->get('/api/meals/1');

        $response->assertStatus(200);
    }

    public function testStoreMeal()
    {
        $user = new User();
        $user->id = 1;
        $this->be($user);

        $response = $this->postJson(
            '/api/meals',
            [
                'meal_id' => 1,
                'mealtype_id' => 3,
                'name' => 'Test Meal',
                'is_vegetarian' => false,
                'is_low_carb' => false
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
