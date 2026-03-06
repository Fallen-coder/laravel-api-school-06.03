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
            ['status' => 'published', 'description' => 'Post is visible to everyone'],
            ['status' => 'draft', 'description' => 'Post is saved but not published'],
            ['status' => 'scheduled', 'description' => 'Post is scheduled for future publishing'],
            ['status' => 'review', 'description' => 'Post is under review'],
            ['status' => 'archived', 'description' => 'Post is archived and not publicly visible'],
            ['status' => 'deleted', 'description' => 'Post is deleted'],
        ]);
    }
}
