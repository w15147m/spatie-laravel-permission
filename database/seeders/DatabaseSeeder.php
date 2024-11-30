<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        $users = collect([
            ['name' => 'user', 'email' => 'user@leed.com'],
            ['name' => 'waseem', 'email' => 'waseem@softleed.com'],
            ['name' => 'abbas', 'email' => 'abbas@softleed.com'],
            ['name' => 'manager', 'email' => 'admin@mail.com'],
        ])->map(function ($user, $index) {
            return [
                'id' => $index + 2,
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make(123),
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        DB::table('users')->insert($users->toArray());

        // Seed Permissions
        $permissions = collect([
            'delete articles',
            'view articles',
            'edit articles',
            'create articles',
            'create roles',
            'view roles',
            'edit roles',
            'delete roles',
            'assign Role',
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ])->map(function ($name, $index) {
            return [
                'id' => $index + 9,
                'name' => $name,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        DB::table('permissions')->insert($permissions->toArray());

        // Seed Roles
        $roles = collect(['admin', 'manager', 'superadmin', 'user', 'writer'])->map(function ($name, $index) {
            return [
                'id' => $index + 11,
                'name' => $name,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        DB::table('roles')->insert($roles->toArray());

        // Seed Articles
        $titles = [
            'Understanding Laravel Basics',
            'Advanced Eloquent Tips',
            'Building APIs with Laravel',
            'Mastering Blade Templates',
            'Top PHP Practices',
            'Database Migrations Explained',
            'Laravel Middleware Guide',
            'RESTful Routes in Laravel',
            'Unit Testing in Laravel',
            'Introduction to PHP 8 Features',
        ];
        $authors = ['Taylor Otwell', 'Rasmus Lerdorf', 'Laravel Team', 'John Doe', 'Jane Smith'];

        $articles = collect($titles)->map(function ($title) use ($authors) {
            return [
                'user_id' => User::inRandomOrder()->first()->id,
                'title' => $title,
                'text' => 'This is the content for the article titled "' . $title . '".',
                'author' => $authors[array_rand($authors)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        DB::table('articles')->insert($articles->toArray());
    }
}
