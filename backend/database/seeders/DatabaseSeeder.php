<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Admin',
            'username'=> 'admin',
            'password'=> 'password',
            'role'=> 'admin',
        ]);

        User::create([
            'name'=> 'Qismat',
            'username'=> 'siswa',
            'password'=> 'password',
            'role'=> 'siswa',
            'kelas'=> 'XII RPL 4',
        ]);

        Book::create([
            'title'=> 'Book 1',
            'author'=> 'me',
            'publisher'=> 'you',
            'year'=> 2001,
            'stock'=> 11,
        ]);

        Book::create([
            'title'=> 'Book 2',
            'author'=> 'me2',
            'publisher'=> 'you2',
            'year'=> 2002,
            'stock'=> 12,
        ]);

        Book::create([
            'title'=> 'Book 3',
            'author'=> 'me3',
            'publisher'=> 'you3',
            'year'=> 2003,
            'stock'=> 13,
        ]);
    }
}
