<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class MealItemTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;


    public function testGetMealItem()
    {
        $user = new User();
        $user->id = 1;
        $this->be($user);

        $response = $this->get('/api/mealitems/1');

        $response->assertStatus(200);
    }

    public function testStoreMealItem()
    {
        $user = new User();
        $user->id = 1;
        $this->be($user);


        $response = $this->postJson(
            '/api/menuitems',
            [
                'meal_id' => 1,
                'date' => Carbon::now()->format("y-m-d"),
                'order' => 1
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
