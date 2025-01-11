<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create storage directories
        $originalPath = storage_path('app/public/news');
        $thumbnailPath = storage_path('app/public/news/thumbnails');

        if (!File::exists($originalPath)) {
            File::makeDirectory($originalPath, 0777, true);
        }
        if (!File::exists($thumbnailPath)) {
            File::makeDirectory($thumbnailPath, 0777, true);
        }

        // Generate 50 news records
        News::factory(10)->create()->each(function ($news) use ($originalPath, $thumbnailPath) {
            // Generate unique filename
            $filename = time() . $news->id . '.jpg';

            // Get dummy image from placeholder service
            $imageContent = file_get_contents("https://picsum.photos/800/600");
            $thumbnailContent = file_get_contents("https://picsum.photos/300/200");

            // Save images
            File::put($originalPath . '/' . $filename, $imageContent);
            File::put($thumbnailPath . '/' . $filename, $thumbnailContent);

            // Update news record with actual filename
            $news->update([
                'image' => $filename,
                'thumbnail' => $filename
            ]);
        });
    }
}
