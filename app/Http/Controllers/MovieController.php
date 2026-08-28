<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function index(): View
    {
        $movies = Movie::query()
            ->with(['category', 'user'])
            ->latest()
            ->paginate(10);

        return view('movies.index', compact('movies'));
    }

    public function create(): View
    {
        return view('movies.create', [
            'categories' => Category::query()->orderBy('name')->get(),
            'movie' => new Movie(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['user_id'] = auth()->id();
        $data['cover_image'] = $this->storeCover($request);

        Movie::query()->create($data);

        return redirect()->route('movies.index')->with('success', 'Filme cadastrado com sucesso.');
    }

    public function edit(Movie $movie): View
    {
        return view('movies.edit', [
            'categories' => Category::query()->orderBy('name')->get(),
            'movie' => $movie,
        ]);
    }

    public function update(Request $request, Movie $movie): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('cover_image')) {
            $this->deleteCover($movie);
            $data['cover_image'] = $this->storeCover($request);
        }

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Filme atualizado com sucesso.');
    }

    public function destroy(Movie $movie): RedirectResponse
    {
        $this->deleteCover($movie);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Filme excluído com sucesso.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string'],
            'year' => ['required', 'integer', 'min:1888', 'max:' . (date('Y') + 5)],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'trailer_url' => ['nullable', 'url', 'max:255'],
        ]);
    }

    private function storeCover(Request $request): ?string
    {
        if (! $request->hasFile('cover_image')) {
            return null;
        }

        return $request->file('cover_image')->store('covers', 'public');
    }

    private function deleteCover(Movie $movie): void
    {
        if ($movie->cover_image) {
            Storage::disk('public')->delete($movie->cover_image);
        }
    }
}
