<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Usuário Teste',
            'password' => Hash::make('password'),
        ]);

        $categories = collect(['Ação', 'Comédia', 'Drama', 'Ficção Científica'])->mapWithKeys(fn (string $name) => [
            $name => Category::query()->updateOrCreate(['name' => $name]),
        ]);

        $movies = [
            [
                'category' => 'Ação',
                'title' => 'Cidade em Fuga',
                'synopsis' => 'Um motorista precisa atravessar a cidade em uma noite decisiva enquanto tenta proteger a própria família.',
                'year' => 2022,
                'cover_image' => null,
                'trailer_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'category' => 'Comédia',
                'title' => 'Risos de Domingo',
                'synopsis' => 'Uma reunião familiar sai do controle quando três gerações tentam organizar a mesma festa surpresa.',
                'year' => 2020,
                'cover_image' => null,
                'trailer_url' => 'https://youtu.be/dQw4w9WgXcQ',
            ],
            [
                'category' => 'Drama',
                'title' => 'Depois da Chuva',
                'synopsis' => 'Uma professora retorna à sua cidade natal e reencontra escolhas que deixou para trás.',
                'year' => 2024,
                'cover_image' => null,
                'trailer_url' => null,
            ],
            [
                'category' => 'Ficção Científica',
                'title' => 'Órbita Final',
                'synopsis' => 'Uma equipe de pesquisa descobre uma mensagem antiga durante a última missão em uma estação espacial.',
                'year' => 2023,
                'cover_image' => null,
                'trailer_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::query()->updateOrCreate([
                'title' => $movie['title'],
            ], [
                'user_id' => $user->id,
                'category_id' => $categories[$movie['category']]->id,
                'synopsis' => $movie['synopsis'],
                'year' => $movie['year'],
                'cover_image' => $movie['cover_image'],
                'trailer_url' => $movie['trailer_url'],
            ]);
        }
    }
}
