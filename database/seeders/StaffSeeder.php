<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create staff members
        $staffMembers = [
            [
                'name' => 'John Doe',
                'birth' => '1990-05-15',
                'email' => 'john@example.com',
                'password' => bcrypt('password123'),
                'api_token' => Str::random(60), // Generate a random API token
            ],
            [
                'name' => 'Jane Smith',
                'birth' => '1985-08-20',
                'email' => 'jane@example.com',
                'password' => bcrypt('password456'),
                'api_token' => Str::random(60), // Generate a random API token
            ],
            // Add more staff members if needed
        ];

        // Insert staff members into the database
        foreach ($staffMembers as $staffMember) {
            Staff::create($staffMember);
        }
    }
}
