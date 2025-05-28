<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Timeslot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::all();

        $timeSlots = [
            ['start_time' => '09:00:00', 'end_time' => '11:30:00'],
            ['start_time' => '12:00:00', 'end_time' => '14:30:00'],
            ['start_time' => '15:00:00', 'end_time' => '17:30:00'],
        ];

        foreach ($locations as $location) {
            foreach ($timeSlots as $slot) {
                Timeslot::firstOrCreate([
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                    'location_id' => $location->id,
                ], [
                    'is_active' => true,
                ]);
            }
        }
    }
}
