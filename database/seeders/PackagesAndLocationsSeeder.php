<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Instructor;

class PackagesAndLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create packages
        $packages = [
            [
                'name' => 'Private Lesson',
                'slug' => 'private-lesson',
                'description' => 'One-on-one instruction tailored to your skill level with all equipment included.',
                'price' => 175.00,
                'hours' => 2.5,
                'min_participants' => 1,
                'max_participants' => 1,
                'is_duo' => false,
                'number_of_lessons' => 1,
                'is_active' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Single Duo Lesson',
                'slug' => 'single-duo-lesson',
                'description' => 'Learn with a friend for added fun. Two participants with one instructor.',
                'price' => 135.00,
                'hours' => 3.5,
                'min_participants' => 2,
                'max_participants' => 2,
                'is_duo' => true,
                'number_of_lessons' => 1,
                'is_active' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duo 3-Lesson Package',
                'slug' => 'duo-3-lesson-package',
                'description' => 'Comprehensive training over multiple sessions. Three lessons with skill progression tracking.',
                'price' => 375.00,
                'hours' => 10.5,
                'min_participants' => 2,
                'max_participants' => 2,
                'is_duo' => true,
                'number_of_lessons' => 3,
                'is_active' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duo 5-Lesson Package',
                'slug' => 'duo-5-lesson-package',
                'description' => 'Our most comprehensive training program with certification upon completion.',
                'price' => 675.00,
                'hours' => 17.5,
                'min_participants' => 2,
                'max_participants' => 2,
                'is_duo' => true,
                'number_of_lessons' => 5,
                'is_active' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('packages')->insert($packages);
        
        // Create locations
        $locations = [
            [
                'name' => 'Zandvoort',
                'slug' => 'zandvoort',
                'description' => 'Popular beach resort with excellent wind conditions.',
                'city' => 'Zandvoort',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muiderberg',
                'slug' => 'muiderberg',
                'description' => 'Sheltered beach perfect for beginners.',
                'city' => 'Muiden',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wijk aan Zee',
                'slug' => 'wijk-aan-zee',
                'description' => 'A wide sandy beach with consistent winds.',
                'city' => 'Wijk aan Zee',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IJmuiden',
                'slug' => 'ijmuiden',
                'description' => 'Large beach with excellent conditions for all skill levels.',
                'city' => 'IJmuiden',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Scheveningen',
                'slug' => 'scheveningen',
                'description' => 'The most popular beach in the Netherlands with great facilities.',
                'city' => 'The Hague',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hoek van Holland',
                'slug' => 'hoek-van-holland',
                'description' => 'A spacious beach with challenging conditions for advanced riders.',
                'city' => 'Rotterdam',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('locations')->insert($locations);

        // Create instructors from users who have the instructor role
        $instructorUsers = User::whereHas('role', function($query) {
            $query->where('name', 'instructor');
        })->get();

        foreach ($instructorUsers as $user) {
            Instructor::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'number' => 'INS-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                    'isactive' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
