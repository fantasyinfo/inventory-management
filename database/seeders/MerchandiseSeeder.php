<?php

namespace Database\Seeders;

use App\Enums\PlantsLocations;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MerchandiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $itemNames = [
            'Joining Kit',
            'Water Bottle SS',
            'Flask',
            'Coffee Mug',
            'Diary',
            'Pen - Standard',
            'Pen - Premium',
            'Uniform Shirt',
            'Uniform Trouser',
            'Uniform Suit Salwar',
            'Uniform Dupatta',
            'Winter Jacket - Male S',
            'Winter Jacket - Male M',
            'Winter Jacket - Male L',
            'Winter Jacket - Male XL',
            'Winter Jacket - Male XXL',
            'Winter Jacket - Male XXXL',
            'Winter Jacket - Female XS',
            'Winter Jacket - Female S',
            'Winter Jacket - Female M',
            'Winter Jacket - Female L',
            'Winter Jacket - Female XL',
            'Winter Jacket - Female XXL',
            'Polo T-shirt - Male S',
            'Polo T-shirt - Male M',
            'Polo T-shirt - Male L',
            'Polo T-shirt - Male XL',
            'Polo T-shirt - Male XXL',
            'Polo T-shirt - Male XXXL',
            'Polo T-shirt - Female XS',
            'Polo T-shirt - Female S',
            'Polo T-shirt - Female M',
            'Polo T-shirt - Female L',
            'Polo T-shirt - Female XL',
            'Polo T-shirt - Female XXL',
            'Round Neck T-shirt Unisex XS',
            'Round Neck T-shirt Unisex S',
            'Round Neck T-shirt Unisex M',
            'Round Neck T-shirt Unisex L',
            'Round Neck T-shirt Unisex XL',
            'Round Neck T-shirt Unisex XXL',
            'Round Neck T-shirt Unisex XXXL',
            'Safety Shoes - Male 5',
            'Safety Shoes - Male 6',
            'Safety Shoes - Male 7',
            'Safety Shoes - Male 8',
            'Safety Shoes - Male 9',
            'Safety Shoes - Male 10',
            'Safety Shoes - Male 11',
            'Safety Shoes - Female 3',
            'Safety Shoes - Female 4',
            'Safety Shoes - Female 5',
            'Safety Shoes - Female 6',
            'Safety Shoes - Female 7',
            'Safety Shoes - Female 8',
            'Safety Shoes - Female 9',
            'Umbrella',
            'Jute Bag',
            'ID Card',
            'Cap',
            'Toothbrush',
            'Values Book',
            'Keychain',
            'Sticky Notes',
            'Cross Dori Bag',
            'Candle Box',
            'Safety Shoes - Female',
            'Trolley Bag',
            'Blanket',
            'Induction Cooktop',
            'Corporate Gift -1',
            'Corporate Gift -2',
            'Corporate Gift -3',
            'Corporate Gift -4',
            'Expo Carry Bag',
            'Kaizen Gift - 1',
            'Kaizen Gift - 2',
            'Kaizen Gift - 3',
            'Kaizen Gift - 4',
            'Kaizen Gift - 5'
        ];

        $merchandises = [];

        for ($i = 0; $i < 100; $i++) {
            array_push($merchandises, [
                'item_name' => $faker->randomElement($itemNames), // Pick a random item name from the list
                'supplier_name' => $faker->company(),
                'brand_make' => $faker->company(),
                'qty' => $faker->numberBetween(10, 200),
                'cost_per_item' => $faker->numberBetween(50, 5000),
                'date_of_purchase' => $faker->date(),
                'plant_location' => PlantsLocations::random(),
                'store_number' => $faker->numberBetween(1, 4),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('merchandise')->insert($merchandises);
    }
}
