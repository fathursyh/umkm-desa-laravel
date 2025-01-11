<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();

                // Ensure storage directories exist
                $originalPath = storage_path('app/public/news');
                $thumbnailPath = storage_path('app/public/news/thumbnails');

                if (!File::exists($originalPath)) {
                    File::makeDirectory($originalPath, 0777, true);
                }
                if (!File::exists($thumbnailPath)) {
                    File::makeDirectory($thumbnailPath, 0777, true);
                }

                // Store original image
                $image->move($originalPath, $filename);

                // Create thumbnail
                $source = imagecreatefromstring(file_get_contents($originalPath . '/' . $filename));
                $width = imagesx($source);
                $height = imagesy($source);

                $thumb_width = 300;
                $thumb_height = 200;
                $thumbnail = imagecreatetruecolor($thumb_width, $thumb_height);

                // Resize
                imagecopyresized(
                    $thumbnail,
                    $source,
                    0,
                    0,
                    0,
                    0,
                    $thumb_width,
                    $thumb_height,
                    $width,
                    $height
                );

                // Save thumbnail
                imagejpeg($thumbnail, $thumbnailPath . '/' . $filename, 80);

                // Clean up
                imagedestroy($source);
                imagedestroy($thumbnail);

                // Create news entry
                News::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'image' => $filename,
                    'thumbnail' => $filename,
                    'user_id' => Auth::id()
                ]);

                return redirect()->route('admin.news.index')
                    ->with('success', 'Berita berhasil ditambahkan');
            }

            return back()->with('error', 'Gagal mengunggah gambar');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function show(News $news)
    {
        // Increment view counter
        // $news->increment('views');
        dd('print');
        // return view('admin.news.edit');
    }
    public function showUser(News $news)
    {
        // Increment view counter
        $news->increment('views');
        return view('presentation.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                // Delete old images
                Storage::delete([
                    'public/news/' . $news->image,
                    'public/news/thumbnails/' . $news->thumbnail
                ]);

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();

                // Create directories if they don't exist
                $originalPath = storage_path('app/public/news');
                $thumbnailPath = storage_path('app/public/news/thumbnails');

                if (!File::exists($originalPath)) {
                    File::makeDirectory($originalPath, 0777, true);
                }
                if (!File::exists($thumbnailPath)) {
                    File::makeDirectory($thumbnailPath, 0777, true);
                }

                // Store original image
                $image->move($originalPath, $filename);

                // Create thumbnail
                $source = imagecreatefromstring(file_get_contents($originalPath . '/' . $filename));
                $width = imagesx($source);
                $height = imagesy($source);

                $thumb_width = 300;
                $thumb_height = 200;
                $thumbnail = imagecreatetruecolor($thumb_width, $thumb_height);

                // Resize
                imagecopyresized(
                    $thumbnail,
                    $source,
                    0,
                    0,
                    0,
                    0,
                    $thumb_width,
                    $thumb_height,
                    $width,
                    $height
                );

                // Save thumbnail
                imagejpeg($thumbnail, $thumbnailPath . '/' . $filename, 80);

                // Clean up
                imagedestroy($source);
                imagedestroy($thumbnail);

                $news->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'image' => $filename,
                    'thumbnail' => $filename
                ]);
            } else {
                $news->update([
                    'title' => $request->title,
                    'content' => $request->content
                ]);
            }

            return redirect()->route('admin.news.index')
                ->with('success', 'Berita berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(News $news)
    {
        try {
            // Delete associated images
            Storage::delete([
                'public/news/' . $news->image,
                'public/news/thumbnails/' . $news->thumbnail
            ]);

            // Delete news record
            $news->delete();

            return redirect()->route('admin.news.index')
                ->with('success', 'Berita berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }

    public function listNews()
    {
        // $news = News::latest()->take(6)->get(); // Initial load of 6 items
        $news = News::latest()->get(); // Initial load of 6 items
        return view('presentation.news.index', compact('news'));
    }

    public function loadMore(Request $request)
    {
        $page = (int)$request->page;
        $perPage = 6; // 6 items per load (2 rows x 3 columns)
        $skip = $perPage * $page;

        $news = News::latest()
            ->skip($skip)
            ->take($perPage)
            ->get();

        $formattedNews = $news->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'content' => Str::limit(strip_tags($item->content), 100),
                'image' => $item->image,
                'slug' => $item->slug,
                'views' => $item->views,
                'created_at' => $item->created_at->format('d M Y')
            ];
        });

        return response()->json([
            'news' => $formattedNews,
            'hasMore' => $news->count() >= $perPage
        ]);
    }
}
