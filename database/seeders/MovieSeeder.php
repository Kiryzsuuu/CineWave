<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $castPhotos = [
            'https://images.unsplash.com/photo-1758639842438-718755aa57e4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80',
            'https://images.unsplash.com/photo-1706824258534-c3740a1ae96b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80',
            'https://images.unsplash.com/photo-1706824250412-42b8ba877abb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80',
            'https://images.unsplash.com/photo-1676810052606-a1664d2d5dfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80',
            'https://images.unsplash.com/photo-1629507208649-70919ca33793?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80',
        ];

        $movies = [
            // Trending Movies
            [
                'title' => 'Quantum Nexus',
                'image' => 'https://images.unsplash.com/photo-1590562177087-ca6af9bb82ea?w=500&q=80',
                'backdrop' => 'https://images.unsplash.com/photo-1590562177087-ca6af9bb82ea?w=1920&q=80',
                'genre' => json_encode(['Sci-Fi', 'Thriller', 'Action']),
                'rating' => 9.2,
                'description' => 'Dalam dunia dimana realitas virtual dan kenyataan menyatu, seorang hacker genius harus mengungkap konspirasi yang mengancam keberadaan manusia. Dengan teknologi neural interface terbaru, dia menemukan kebenaran yang mengejutkan tentang dunia yang selama ini dipercayanya.',
                'year' => 2024,
                'duration' => '2h 18m',
                'director' => 'Christopher Nolan',
                'cast' => json_encode([
                    ['id' => 1, 'name' => 'Alex Chen', 'character' => 'Neo Hacker', 'photo' => $castPhotos[0]],
                    ['id' => 2, 'name' => 'Sarah Williams', 'character' => 'Dr. Maya', 'photo' => $castPhotos[1]],
                    ['id' => 3, 'name' => 'Michael Jordan', 'character' => 'Agent Black', 'photo' => $castPhotos[4]],
                    ['id' => 4, 'name' => 'Emma Stone', 'character' => 'Lisa Parker', 'photo' => $castPhotos[2]],
                    ['id' => 5, 'name' => 'David Kim', 'character' => 'Tech Specialist', 'photo' => $castPhotos[3]],
                ]),
                'category' => 'trending'
            ],
            [
                'title' => 'Shadow Protocol',
                'image' => 'https://images.unsplash.com/photo-1762356121454-877acbd554bb?w=500&q=80',
                'backdrop' => 'https://images.unsplash.com/photo-1762356121454-877acbd554bb?w=1920&q=80',
                'genre' => json_encode(['Action', 'Spy', 'Drama']),
                'rating' => 8.8,
                'description' => 'Agen rahasia elit menghentikan organisasi kriminal internasional yang mengancam dunia. Dengan keterampilan combat yang luar biasa dan teknologi mata-mata tercanggih, dia harus menghadapi musuh yang selalu selangkah lebih maju.',
                'year' => 2024,
                'duration' => '2h 5m',
                'director' => 'Denis Villeneuve',
                'cast' => json_encode([
                    ['id' => 6, 'name' => 'James Ryan', 'character' => 'Agent Shadow', 'photo' => $castPhotos[0]],
                    ['id' => 7, 'name' => 'Victoria Blake', 'character' => 'Commander', 'photo' => $castPhotos[2]],
                    ['id' => 8, 'name' => 'Marcus Lee', 'character' => 'Villain Boss', 'photo' => $castPhotos[4]],
                    ['id' => 9, 'name' => 'Sophie Turner', 'character' => 'Tech Support', 'photo' => $castPhotos[1]],
                ]),
                'category' => 'trending'
            ],
            [
                'title' => 'The Last Expedition',
                'image' => 'https://images.unsplash.com/photo-1550622485-860e9d423364?w=500&q=80',
                'backdrop' => 'https://images.unsplash.com/photo-1550622485-860e9d423364?w=1920&q=80',
                'genre' => json_encode(['Adventure', 'Mystery', 'Fantasy']),
                'rating' => 9.5,
                'description' => 'Petualangan epik menemukan peradaban kuno tersembunyi di jantung Amazon. Tim arkeolog menemukan artefak misterius yang membuka portal ke dunia yang telah lama hilang, penuh dengan keajaiban dan bahaya.',
                'year' => 2024,
                'duration' => '2h 32m',
                'director' => 'Steven Spielberg',
                'cast' => json_encode([
                    ['id' => 10, 'name' => 'Harrison Ford Jr.', 'character' => 'Dr. Jack Stone', 'photo' => $castPhotos[4]],
                    ['id' => 11, 'name' => 'Alicia Vikander', 'character' => 'Dr. Elena Cruz', 'photo' => $castPhotos[1]],
                    ['id' => 12, 'name' => 'Oscar Isaac', 'character' => 'Guide Miguel', 'photo' => $castPhotos[0]],
                    ['id' => 13, 'name' => 'Zendaya Coleman', 'character' => 'Young Explorer', 'photo' => $castPhotos[2]],
                ]),
                'category' => 'trending'
            ],
            [
                'title' => 'Crimson Dawn',
                'image' => 'https://images.unsplash.com/photo-1599480189969-ae93eea51672?w=500&q=80',
                'backdrop' => 'https://images.unsplash.com/photo-1599480189969-ae93eea51672?w=1920&q=80',
                'genre' => json_encode(['Thriller', 'Crime', 'Mystery']),
                'rating' => 8.6,
                'description' => 'Detektif brilian memburu serial killer misterius yang meninggalkan pesan tersembunyi. Setiap petunjuk membawa dia lebih dalam ke dalam permainan psikologis yang mengerikan dan mengungkap rahasia gelap masa lalunya.',
                'year' => 2023,
                'duration' => '2h 12m',
                'director' => 'David Fincher',
                'cast' => json_encode([
                    ['id' => 14, 'name' => 'Jake Gyllenhaal', 'character' => 'Detective Miller', 'photo' => $castPhotos[0]],
                    ['id' => 15, 'name' => 'Rooney Mara', 'character' => 'FBI Agent', 'photo' => $castPhotos[1]],
                    ['id' => 16, 'name' => 'Mark Ruffalo', 'character' => 'Captain Hayes', 'photo' => $castPhotos[4]],
                ]),
                'category' => 'trending'
            ],
            [
                'title' => 'Realm of Legends',
                'image' => 'https://images.unsplash.com/photo-1683858650446-be07d2573c84?w=500&q=80',
                'backdrop' => 'https://images.unsplash.com/photo-1683858650446-be07d2573c84?w=1920&q=80',
                'genre' => json_encode(['Fantasy', 'Epic', 'Adventure']),
                'rating' => 9.3,
                'description' => 'Pahlawan dari berbagai dimensi bersatu melawan kekuatan kegelapan yang mengancam semesta. Dalam pertempuran epik antara cahaya dan kegelapan, nasib seluruh realitas bergantung pada keberanian mereka.',
                'year' => 2024,
                'duration' => '2h 45m',
                'director' => 'Peter Jackson',
                'cast' => json_encode([
                    ['id' => 17, 'name' => 'Chris Hemsworth', 'character' => 'Thor Magnus', 'photo' => $castPhotos[0]],
                    ['id' => 18, 'name' => 'Gal Gadot', 'character' => 'Princess Aria', 'photo' => $castPhotos[2]],
                    ['id' => 19, 'name' => 'Idris Elba', 'character' => 'King Eldric', 'photo' => $castPhotos[4]],
                    ['id' => 20, 'name' => 'Saoirse Ronan', 'character' => 'Mage Luna', 'photo' => $castPhotos[1]],
                ]),
                'category' => 'trending'
            ],
            [
                'title' => 'Nightfall Chronicles',
                'image' => 'https://images.unsplash.com/photo-1724378435887-70b90bce60c0?w=500&q=80',
                'backdrop' => 'https://images.unsplash.com/photo-1724378435887-70b90bce60c0?w=1920&q=80',
                'genre' => json_encode(['Horror', 'Mystery', 'Thriller']),
                'rating' => 8.4,
                'description' => 'Investigasi supernatural mengerikan tentang kota yang penduduknya menghilang setiap malam. Seorang jurnalis berani mengungkap misteri gelap yang telah tersembunyi selama puluhan tahun.',
                'year' => 2023,
                'duration' => '1h 58m',
                'director' => 'James Wan',
                'cast' => json_encode([
                    ['id' => 21, 'name' => 'Vera Farmiga', 'character' => 'Sarah Mitchell', 'photo' => $castPhotos[1]],
                    ['id' => 22, 'name' => 'Patrick Wilson', 'character' => 'John Carter', 'photo' => $castPhotos[0]],
                    ['id' => 23, 'name' => 'Lupita Nyongo', 'character' => 'Dr. Grace', 'photo' => $castPhotos[2]],
                ]),
                'category' => 'trending'
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}

