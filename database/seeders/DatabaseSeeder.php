<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Game;
use App\Models\User;
use App\Models\Country;
use App\Models\GameTag;
use App\Models\Developer;
use App\Models\GameDonation;
use App\Models\GameGenre;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameReview;
use App\Models\TagDetail;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $genres = [
            'action',
            'adventure',
            'casual',
            'strategy',
            'rpg',
            'simulation',
            'sports',
            'racing',
            'battle royale',
            'other'
        ];

        $tags = [
            'new',
            'promotion',
            'sale',
            'hot',
            'comeback',
            'hunt',
            'race',
            'killorgetkilled',
            'survival',
            'other'
        ];

        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'country' => $faker->country,
                'name' => $faker->name,
                'role' => "user",
                'profile_url' => $faker->imageUrl,
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password'),
            ]);
        }

        User::create([
            'country' => $faker->country,
            'name' => $faker->name,
            'role' => "admin",
            'profile_url' => $faker->imageUrl,
            'username' => 'admin12345',
            'email' => "admin@gmail.com",
            'password' => bcrypt('admin'),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            GameGenre::create([
                'genre_name' => $genres[$i - 1],
            ]);

            GameTag::create([
                'tag_name' => '#' . $tags[$i - 1],
            ]);
        }

        // Array buat devs
        $dev_country = [
            'USA',
        ];

        $dev_company_name = [
            'Concerned Ape',
        ];

        $dev_company_pic_url = [
            'https://avatars.cloudflare.steamstatic.com/eaff8e24ad01c6d6a80064c8a5a46b81210492e3_full.jpg',
        ];

        $dev_company_address = [
            'Seattle, WA',
        ];

        $dev_company_website = [
            'https://www.stardewvalley.net/',
        ];

        $dev_facebook = [
            null,
        ];

        $dev_twt = [
            'https://twitter.com/ConcernedApe'
        ];

        $dev_ig = [
            null,
        ];

        $dev_company_description = [
            'ConcernedApe is the moniker of Eric Barone, a solo game developer based in Seattle, WA.'
        ];

        for ($i = 1; $i <= 10; $i++) {
            Developer::create([
                'user_id' => $i,
                'country' => $dev_country[$i - 1],
                'company_name' => $faker->company,
                'registration_date' => $faker->dateTimeThisYear,
                'approval_date' => $faker->dateTimeThisYear,
                'bank_account' => json_encode([
                    'type' => $faker->word,
                    'bank_name' => $faker->word . ' bank',
                    'bank_account_number' => $faker->bankAccountNumber,
                ]),
                'company_pic_url' => $faker->imageUrl,
                'company_address' => $faker->address,
                'company_website' => $faker->url,
                'social_media' => json_encode([
                    'facebook' => $faker->url,
                    'twitter' => $faker->url,
                    'instagram' => $faker->url,
                ]),
                'company_description' => $faker->text,
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Game::create([
                'genre_id' => $faker->numberBetween(1, 10),
                'dev_id' => $faker->numberBetween(1, 5),
                'game_name' => $faker->word,
                'game_version' => '1.0',
                'price' => $faker->numberBetween(10000, 1000000),
                'promotional' => json_encode([
                    'logo' => $faker->imageUrl,
                    'trailer' => 'https://www.youtube.com/watch?v=5jKZ9KGtee0', //video url
                    'img' => [
                        $faker->imageUrl, $faker->imageUrl, $faker->imageUrl,
                    ]
                ]),
                'game_data_path' => $faker->url,
                'date_published' => $faker->dateTimeThisYear,
                'short_desc' => $faker->text(50),
                'content_rating' => $faker->randomElement(['a', 'b', 'not_specified']),
                'about_game' => $faker->text,
                'requirement_processor' => $faker->randomElement(['Intel Core i9-12900K', 'AMD Ryzen 9 5900X', 'Intel Core i5-12600K', 'AMD Ryzen 7 5800X3D', 'AMD Ryzen 3 3100']),
                'requirement_os' => $faker->randomElement(['Windows', 'Linux', 'Mac OS']),
                'requirement_memory' => $faker->randomElement(['2', '4', '8', '16', '32']) . 'GB',
                'requirement_graphic' => $faker->randomElement(['GeForce GTX', 'GeForce RTX', 'Nvidia Titan', 'Radeon HD', 'Radeon RX']),
                'requirement_storage' => strval($faker->randomFloat(1, 1, 100)) . 'GB',
                'status' => 'published'
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            TagDetail::create([
                'tag_id' => $faker->numberBetween(1, 3), //ini diganti tadinya 1-10
                'game_id' => $i,
            ]);

            Wishlist::create([
                'game_id' => $i,
                'user_id' => $faker->numberBetween(1, 10),
            ]);

            GameLibrary::create([
                'game_id' => $i,
                'user_id' => $faker->numberBetween(1, 10),
            ]);

            GameReview::create([
                'game_id' => $i,
                'user_id' => $faker->numberBetween(1, 10),
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->text,
            ]);

            GamePayment::create([
                'game_id' => $faker->numberBetween(1, 10),
                'user_id' => $faker->numberBetween(1, 10),
                'payment_method' => $faker->randomElement(['paypal', 'credit_card', 'bank_transfer']),
                'amount' => $faker->numberBetween(10000, 1000000),
            ]);

            GameDonation::create([
                'game_id' => $faker->numberBetween(1, 10),
                'user_id' => $faker->numberBetween(1, 10),
                'payment_method' => $faker->randomElement(['paypal', 'credit_card', 'bank_transfer']),
                'amount' => $faker->numberBetween(10000, 1000000),
                'message' => $faker->text,
            ]);
        }
    }
}
