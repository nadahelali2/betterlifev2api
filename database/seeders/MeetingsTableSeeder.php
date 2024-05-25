<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00'];
        
        $names = ['John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Brown', 'David Wilson', 'Sarah Martinez', 'Christopher Anderson', 'Jessica Taylor', 'Matthew Thomas', 'Laura Garcia'];
        
        for ($i = 0; $i < 10; $i++) {
            $name = $names[array_rand($names)];
            $email = strtolower(str_replace(' ', '', $name)) . '@example.com';
            $phone = $this->generateRandomPhoneNumber();
            $appointmentDate = $this->randomAppointmentDate($times);
            
            DB::table('meetings')->insert([
                [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'appointment_date' => $appointmentDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }

    private function randomAppointmentDate($times)
    {
        $randomTime = $times[array_rand($times)];
        return Carbon::now()->addDays(rand(1, 7))->format('Y-m-d') . ' ' . $randomTime . ':00';
    }
    
    private function generateRandomPhoneNumber()
    {
        $number = '0';
        for ($i = 0; $i < 9; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }
}
