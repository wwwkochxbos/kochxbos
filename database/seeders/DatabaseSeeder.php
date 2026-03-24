<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Exhibition;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kochxbos.com',
            'password' => bcrypt('password'),
        ]);

        // Create Artists
        $artistsData = [
            ['name' => 'Sarah Maple', 'country' => 'United Kingdom', 'bio' => 'Sarah Maple is a Turner Prize-nominated British artist known for her provocative and witty artwork that challenges social, political, and cultural norms.'],
            ['name' => 'Femke Hiemstra', 'country' => 'Netherlands', 'bio' => 'Femke Hiemstra creates intricate, dreamlike paintings populated by fantastical creatures and surreal landscapes.'],
            ['name' => 'Allison Sommers', 'country' => 'United States', 'bio' => 'Allison Sommers creates paintings that explore the grotesque and beautiful through a lens of art history and folklore.'],
            ['name' => 'Raimund Oehme', 'country' => 'Germany', 'bio' => 'Raimund Oehme is a German painter whose work navigates between figuration and abstraction.'],
            ['name' => 'Marcelo Suaznabar', 'country' => 'Bolivia', 'bio' => 'Marcelo Suaznabar creates vibrant paintings that blend Latin American folklore with contemporary imagery.'],
            ['name' => 'Sander Buijk', 'country' => 'Netherlands', 'bio' => 'Sander Buijk is a Dutch artist known for his atmospheric landscape paintings and still lifes.'],
            ['name' => 'Jessica Wee', 'country' => 'Singapore', 'bio' => 'Jessica Wee creates delicate mixed-media works exploring identity, memory, and belonging.'],
            ['name' => 'Edith Lebeau', 'country' => 'Canada', 'bio' => 'Edith Lebeau is a Canadian painter known for her colorful figurative works that reference pop culture and art history.'],
            ['name' => 'Travis Louie', 'country' => 'United States', 'bio' => 'Travis Louie creates meticulously rendered portraits of imaginary characters from a Victorian-era world that never existed.'],
            ['name' => 'Daan Noppen', 'country' => 'Netherlands', 'bio' => 'Daan Noppen is a Dutch painter who creates dark, atmospheric works exploring the human condition.'],
        ];

        $artists = collect();
        foreach ($artistsData as $i => $data) {
            $artists->push(Artist::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'country' => $data['country'],
                'bio' => $data['bio'],
                'is_active' => true,
                'sort_order' => $i,
            ]));
        }

        // Create Exhibitions
        $currentExhibition = Exhibition::create([
            'title' => 'Fascism Happens When You\'re Busy Making Other Plans',
            'slug' => 'fascism-happens-when-youre-busy-making-other-plans',
            'description' => 'In this powerful solo exhibition, Sarah Maple confronts the rise of populism and far-right ideologies through her characteristic blend of humor, provocation, and visual wit. The exhibition features new paintings, mixed media works, and installations that challenge viewers to confront uncomfortable truths about the current political landscape.',
            'start_date' => now()->subDays(7),
            'end_date' => now()->addDays(14),
            'status' => 'now',
            'is_featured' => true,
        ]);
        $currentExhibition->artists()->attach($artists[0]->id);

        $upcomingExhibition = Exhibition::create([
            'title' => 'Between Worlds',
            'slug' => 'between-worlds',
            'description' => 'A group exhibition exploring liminal spaces and the boundaries between reality and imagination.',
            'start_date' => now()->addDays(21),
            'end_date' => now()->addDays(49),
            'status' => 'soon',
        ]);
        $upcomingExhibition->artists()->attach([$artists[1]->id, $artists[2]->id]);

        $upcoming2 = Exhibition::create([
            'title' => 'Silent Landscapes',
            'slug' => 'silent-landscapes',
            'description' => 'Sander Buijk presents a new series of meditative landscape paintings.',
            'start_date' => now()->addDays(56),
            'end_date' => now()->addDays(84),
            'status' => 'soon',
        ]);
        $upcoming2->artists()->attach($artists[5]->id);

        $pastExhibition = Exhibition::create([
            'title' => 'Creatures of Habit',
            'slug' => 'creatures-of-habit',
            'description' => 'Femke Hiemstra presented her newest collection of intricate paintings.',
            'start_date' => now()->subDays(60),
            'end_date' => now()->subDays(30),
            'status' => 'past',
        ]);
        $pastExhibition->artists()->attach($artists[1]->id);

        // Create Artworks
        $artworkData = [
            ['title' => 'God Is A Woman', 'artist' => 0, 'medium' => 'Oil on canvas', 'dimensions' => '120 x 100 cm', 'year' => 2024, 'price' => 4500],
            ['title' => 'Brexit Means Breakfast', 'artist' => 0, 'medium' => 'Acrylic on canvas', 'dimensions' => '80 x 60 cm', 'year' => 2024, 'price' => 3200],
            ['title' => 'The Last Unicorn', 'artist' => 1, 'medium' => 'Acrylic and ink on panel', 'dimensions' => '50 x 40 cm', 'year' => 2024, 'price' => 2800],
            ['title' => 'Night Garden', 'artist' => 1, 'medium' => 'Acrylic on panel', 'dimensions' => '60 x 50 cm', 'year' => 2023, 'price' => 3100],
            ['title' => 'Bone Mother', 'artist' => 2, 'medium' => 'Oil on panel', 'dimensions' => '40 x 30 cm', 'year' => 2024, 'price' => 2200],
            ['title' => 'Wanderer', 'artist' => 3, 'medium' => 'Oil on canvas', 'dimensions' => '150 x 120 cm', 'year' => 2024, 'price' => 5500],
            ['title' => 'Carnival Dreams', 'artist' => 4, 'medium' => 'Oil on canvas', 'dimensions' => '100 x 80 cm', 'year' => 2024, 'price' => 3800],
            ['title' => 'Morning Mist', 'artist' => 5, 'medium' => 'Oil on linen', 'dimensions' => '90 x 70 cm', 'year' => 2024, 'price' => 2900],
            ['title' => 'Memory Box', 'artist' => 6, 'medium' => 'Mixed media on paper', 'dimensions' => '30 x 30 cm', 'year' => 2024, 'price' => 1500],
            ['title' => 'Pop Baroque', 'artist' => 7, 'medium' => 'Oil on canvas', 'dimensions' => '80 x 60 cm', 'year' => 2024, 'price' => 3400],
            ['title' => 'The Collector', 'artist' => 8, 'medium' => 'Acrylic on panel', 'dimensions' => '40 x 30 cm', 'year' => 2024, 'price' => 4200],
            ['title' => 'Shadowplay', 'artist' => 9, 'medium' => 'Oil on canvas', 'dimensions' => '100 x 80 cm', 'year' => 2024, 'price' => 3600],
        ];

        foreach ($artworkData as $data) {
            Artwork::create([
                'artist_id' => $artists[$data['artist']]->id,
                'exhibition_id' => $data['artist'] === 0 ? $currentExhibition->id : null,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'medium' => $data['medium'],
                'dimensions' => $data['dimensions'],
                'year' => $data['year'],
                'price' => $data['price'],
                'is_available' => true,
                'is_sold' => false,
            ]);
        }

        // Create News
        $newsData = [
            ['title' => 'Sarah Maple Solo Exhibition Opening', 'excerpt' => 'Join us for the opening of "Fascism Happens When You\'re Busy Making Other Plans" by Sarah Maple.', 'days_ago' => 7],
            ['title' => 'New Artists Joining the Gallery', 'excerpt' => 'We are excited to announce several new additions to our roster of represented artists.', 'days_ago' => 21],
            ['title' => 'Art Rotterdam 2024', 'excerpt' => 'KochxBos Gallery will be presenting a curated selection of works at Art Rotterdam.', 'days_ago' => 45],
            ['title' => 'Gallery Summer Hours', 'excerpt' => 'Please note our adjusted opening hours for the summer season.', 'days_ago' => 90],
        ];

        foreach ($newsData as $data) {
            News::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'body' => $data['excerpt'] . "\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                'published_at' => now()->subDays($data['days_ago']),
                'is_published' => true,
            ]);
        }

        // Create Products
        $products = [
            ['name' => 'KochxBos Gallery Catalogue 2024', 'category' => 'book', 'price' => 25.00, 'stock' => 50],
            ['name' => 'Femke Hiemstra Art Print - Limited Edition', 'category' => 'print', 'price' => 75.00, 'stock' => 20],
            ['name' => 'Gallery Tote Bag', 'category' => 'merchandise', 'price' => 15.00, 'stock' => 100],
            ['name' => 'Travis Louie Monograph', 'category' => 'book', 'price' => 35.00, 'stock' => 30],
        ];

        foreach ($products as $data) {
            Product::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'price' => $data['price'],
                'category' => $data['category'],
                'stock' => $data['stock'],
                'is_active' => true,
            ]);
        }
    }
}
