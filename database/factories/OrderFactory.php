<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeThisMonth();
        return [
            //
            'customer_id' => Customer::all()->random()->id,
            'order_date' => $this->faker->dateTimeThisYear(),
            'updated_at' => $date,
            'created_at' => $date
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Order $order){
            $order->orderDetails()->saveMany(OrderDetail::factory(3)->make());
        });
    }
}
