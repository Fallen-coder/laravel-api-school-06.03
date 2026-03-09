<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostStatus;
class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostStatus::insert([
            ['name' => 'published', 'description' => 'Post is visible to everyone'],
            ['name' => 'draft', 'description' => 'Post is saved but not published'],
            ['name' => 'scheduled', 'description' => 'Post is scheduled for future publishing'],
            ['name' => 'review', 'description' => 'Post is under review'],
            ['name' => 'archived', 'description' => 'Post is archived and not publicly visible'],
            ['name' => 'deleted', 'description' => 'Post is deleted'],
        ]);
    }
}
