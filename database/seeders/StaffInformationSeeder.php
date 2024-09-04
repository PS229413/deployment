<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffInformation;
use Faker\Factory as Faker;

class StaffInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 sample entries
        for ($i = 0; $i < 1000; $i++) {
            StaffInformation::create([
                'name' => $faker->name,
                'street_address' => $faker->streetAddress,
                'postcode' => $faker->postcode,
                'city' => $faker->city,
                'identification_bsn' => $faker->unique()->randomNumber(9),
                'identification_id_card' => $faker->unique()->regexify('[A-Z0-9]{8}'),
                'identification_passport' => $faker->unique()->regexify('[A-Z0-9]{8}'),
                'identification_driver_license' => $faker->unique()->regexify('[A-Z0-9]{8}'),
                'phone_number_landline' => $faker->numerify('########'), // Landline number or null
                'phone_number_mobile' => $faker->numerify('########'), // Mobile number or null
                'email' => $faker->unique()->safeEmail,
                'fax_number' => $faker->numerify('########'), // Fax number or null
                'facebook' => $faker->userName,
                'twitter' => $faker->userName,
                'linkedin' => $faker->userName,
                'whatsapp' => $faker->numerify('##########'), // WhatsApp number or null
                'bank_account_number' => $faker->numerify('##################'), // Bank account number or null
                'credit_card_number' => $faker->creditCardNumber, // Credit card number or null
                'paypal_login' => $faker->safeEmail, // PayPal login or null
                'staff_id' => $faker->numberBetween(1, 10), // Assuming staff members have IDs from 1 to 10
            ]);
    }
}
}
