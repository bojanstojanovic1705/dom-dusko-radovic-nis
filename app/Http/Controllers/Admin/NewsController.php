<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('images')
            ->orderByDesc('created_at')
            ->paginate(10);
            
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        try {
            Log::info('Attempting to store news', [
                'request_data' => $request->all()
            ]);

            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'excerpt' => 'required|max:500',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            Log::info('Validation passed', $validated);

            $news = News::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'excerpt' => $request->excerpt,
                'is_featured' => $request->boolean('is_featured'),
                'is_published' => true,
                'published_at' => now(),
                'main_image' => null // Postavljamo main_image na null
            ]);

            Log::info('News created', ['news_id' => $news->id]);

            if ($request->hasFile('images')) {
                Log::info('Processing images', [
                    'image_count' => count($request->file('images'))
                ]);

                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('news', 'public');
                    Log::info('Image stored', ['path' => $path]);
                    
                    // Prva slika postaje main_image
                    if ($index === 0) {
                        $news->update(['main_image' => $path]);
                    }
                    
                    NewsImage::create([
                        'news_id' => $news->id,
                        'image_path' => $path,
                        'sort_order' => $index
                    ]);
                }
            }

            return redirect()
                ->route('admin.news.index')
                ->with('success', 'Vest je uspešno dodata.');
        } catch (\Exception $e) {
            Log::error('Error storing news', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Došlo je do greške prilikom dodavanja vesti: ' . $e->getMessage());
        }
    }

    public function edit(News $news)
    {
        $news->load('images');
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'required|max:500',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $news->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        // Brisanje označenih slika
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = NewsImage::find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Dodavanje novih slika
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('news', 'public');
                
                // Ako nema main_image, prva nova slika postaje main_image
                if (!$news->main_image && $index === 0) {
                    $news->update(['main_image' => $path]);
                }
                
                NewsImage::create([
                    'news_id' => $news->id,
                    'image_path' => $path,
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Vest je uspešno ažurirana.');
    }

    public function destroy(News $news)
    {
        // Brisanje slika
        foreach ($news->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Vest je uspešno obrisana.');
    }
}
