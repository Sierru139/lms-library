<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\LocationRack;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password')
        // ]);

        // Category::factory(10)->create();
        // Author::factory(10)->create();
        // LocationRack::factory(10)->create();

        // Setting::factory()->create([
        //     'library_name' => 'ABCD LIBRARY',
        //     'library_address' => 'Dhaka, Bangladesh',
        //     'library_phone' => '+8801679487265',
        //     'library_email' => 'abcd@gmail.com',
        //     'fines' => '50',
        // ]);

        User::insert([
            [
                'name' => 'Yasir',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'level' => 'Admin',
            ]
        ]);

        Student::insert([
            [
                'name' => 'Yasir',
                'dept' => 'RPL',
                'year' => '3',
                'semester' => '2',
                'session' => '5',
                'student_id' => '8012',
                'password' => bcrypt('stdnt'),
            ]
        ]);

        Teacher::insert([
            [
                'name' => 'Yasir',
                'dept' => 'RPL',
                'session' => '3',
                'teacher_id' => '2044',
                'password' => bcrypt('tchr'),
            ]
        ]);

        Category::insert([
            [
                'name' => 'History',
                'slug' => 'history-1203',
            ]
        ]);

        LocationRack::insert([
            [
                'name' => 'B32',
                'status' => '1',
            ]
        ]);

        Author::insert([
            [
                'name' => 'Lemans Attila',
                'status' => '1',
            ]
        ]);

        Book::insert([
            [
                'name' => 'History Of Enigma',
                'isbn_no' => '100491831823',
                'category_id' => '1',
                'author_id' => '1',
                'location_rack_id' => '1',
                'no_of_copy' => '20',
                // 'level' => 'Admin',
                'status' => '1',
            ]
        ]);
    }
}
