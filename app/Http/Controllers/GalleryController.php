<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $movies = Movie::query()
            ->with(['category', 'user'])
            ->when($request->filled('year'), fn ($query) => $query->where('year', $request->integer('year')))
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->integer('category_id')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('gallery.index', [
            'movies' => $movies,
            'categories' => Category::query()->orderBy('name')->get(),
            'years' => Movie::query()->select('year')->distinct()->orderByDesc('year')->pluck('year'),
        ]);
    }

    public function show(Movie $movie): View
    {
        $movie->load(['category', 'user']);

        return view('gallery.show', [
            'movie' => $movie,
            'embedUrl' => $this->youtubeEmbedUrl($movie->trailer_url),
        ]);
    }

    private function youtubeEmbedUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $parts = parse_url($url);
        $host = $parts['host'] ?? '';
        $path = trim($parts['path'] ?? '', '/');

        if (str_contains($host, 'youtu.be') && $path) {
            return 'https://www.youtube.com/embed/' . $path;
        }

        if (str_contains($host, 'youtube.com')) {
            parse_str($parts['query'] ?? '', $query);

            if (! empty($query['v'])) {
                return 'https://www.youtube.com/embed/' . $query['v'];
            }

            if (str_starts_with($path, 'embed/')) {
                return $url;
            }
        }

        return null;
    }
}
