<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gọi các seeder con
        $this->call([
            CourseSeeder::class,      
            // LessonSeeder::class,   
            // StudentSeeder::class,  
        ]);
    }
}