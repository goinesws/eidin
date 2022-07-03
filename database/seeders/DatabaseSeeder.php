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
        $dev_ctry = [
            'USA',
            'North America',
            'USA',
            'USA',
            'USA',
            'USA',
            'Canada',
            'Sweden',
            'France',
            'Australia'
        ];

        $dev_company_name = [
            'Concerned Ape',
            'Studio MDHR',
            'Re-Logic',
            'Supergiant Games',
            'Nicalis',
            'tobyfox',
            'Matt Makes Games',
            'Landfall Games',
            'Motion Twin',
            'Team Cherry'
        ];

        $dev_company_pic_url = [
            'https://avatars.cloudflare.steamstatic.com/eaff8e24ad01c6d6a80064c8a5a46b81210492e3_full.jpg',
            'https://avatars.cloudflare.steamstatic.com/dd512d95ac2870c1e29064707d49719535179c5e_full.jpg',
            'https://avatars.cloudflare.steamstatic.com/6ca4f16b768d95e984b8b4d7e09866a88d0aa036_full.jpg',
            'https://avatars.cloudflare.steamstatic.com/7271c10f898a95afc524764d7d180db52f072d80_full.jpg',
            'https://avatars.cloudflare.steamstatic.com/ef1904218b5ef0c5da6722e6c5bab8bc57fe0a04_full.jpg',
            'https://pbs.twimg.com/profile_images/1304111803614613504/NKxFjarS_400x400.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/2/27/Matt-makes-games-logo.png',
            'https://avatars.cloudflare.steamstatic.com/edb7a6de43d2d99a28f54f5f6c2411e07056ef4a_full.jpg',
            'https://avatars.cloudflare.steamstatic.com/325a178d58906ad104b8edfa3890c9a1450e6d6c_full.jpg',
            'https://avatars.cloudflare.steamstatic.com/6dd64832e621ff348935216b4d4bd993587f783c_full.jpg'
        ];

        $dev_company_address = [
            'Seattle, WA',
            'North America',
            'Indiana, USA',
            'San Fransisco, CA',
            'Santa Ana, CA',
            'New Hampshire, USA',
            'Canada',
            'Stockholm, Sweden',
            'Paris, France',
            'Adelaide, Australia'
        ];

        $dev_company_website = [
            'https://www.stardewvalley.net/',
            'http://studiomdhr.com/',
            'https://www.re-logic.com/',
            'https://www.supergiantgames.com/',
            'https://www.nicalis.com/',
            'https://undertale.com/',
            'http://www.mattmakesgames.com/',
            'https://landfall.se/',
            'http://motion-twin.com/en/',
            'https://www.teamcherry.com.au/'
        ];

        $dev_facebook = [
            null,
            'https://www.facebook.com/studiomdhr/',
            'https://www.facebook.com/ReLogicGames/',
            'https://www.facebook.com/supergiantgames/',
            null,
            null,
            null,
            null,
            'https://www.facebook.com/motiontwin/',
            null
        ];

        $dev_twt = [
            'https://twitter.com/ConcernedApe',
            'https://twitter.com/StudioMDHR',
            'https://twitter.com/ReLogicGames',
            'https://twitter.com/SupergiantGames',
            'https://twitter.com/nicalis',
            'https://twitter.com/tobyfox',
            'https://twitter.com/MaddyThorson',
            'https://twitter.com/LandfallGames',
            'https://twitter.com/motiontwin',
            'https://twitter.com/TeamCherryGames'
        ];

        $dev_ig = [
            null,
            'https://www.instagram.com/studiomdhr/?hl=en',
            null,
            'https://www.instagram.com/supergiantgames/?hl=en',
            'https://www.instagram.com/nicalisinc/',
            null,
            null,
            null,
            null,
            null
        ];

        $dev_company_description = [
            'ConcernedApe is the moniker of Eric Barone, a solo game developer based in Seattle, WA.',
            'Studio MDHR is an independent video game company founded by brothers Chad & Jared Moldenhauer. Working remotely with a team from across North America, Studio MDHR launched Cuphead on Xbox One and PC.',
            'Best known for the Terraria franchise - the revolutionary 2D Sandbox Adventure that has entertained millions of gamers worldwide - Re-Logic seeks to showcase and evolve the limits of what Indie gaming can be!',
            'We make games that spark your imagination like the games you played as a kid.',
            'Developer of The Binding of Isaac: Rebirth and publisher of some of your favorite video games!',
            'Robert F. Fox, known professionally as Toby Fox and previously as Toby "Radiation" Fox, is an American video game developer and video game composer.',
            'Maddy Thorson is a Canadian video game developer, known as one of the lead creators for the video games TowerFall and Celeste, developed under the studio Matt Makes Games.',
            'Landfall Games is an indie studio from Sweden that makes physics games, also other games, sometimes funny.',
            'Motion Twin is an anarcho-syndical (seriously) workers cooperative that\'s been making games in France since 2001. No boss, equal pay, equal say. It\'s an experiment and an experience!',
            'Team Cherry is a small indie games team in Adelaide, South Australia. Our mission is to build crazy and exciting worlds for you to explore and conquer.'
        ];

        for ($i = 1; $i <= 10; $i++) {
            Developer::create([
                'user_id' => $i,
                'country' => $dev_ctry[$i - 1],
                'company_name' => $dev_company_name[$i - 1],
                'registration_date' => $faker->dateTimeThisYear,
                'approval_date' => $faker->dateTimeThisYear,
                'bank_account' => json_encode([
                    'type' => $faker->word,
                    'bank_name' => $faker->word . ' bank',
                    'bank_account_number' => $faker->bankAccountNumber,
                ]),
                'company_pic_url' => $dev_company_pic_url[$i - 1],
                'company_address' => $dev_company_address[$i - 1],
                'company_website' => $dev_company_website[$i - 1],
                'social_media' => json_encode([
                    'facebook' => $dev_facebook[$i - 1],
                    'twitter' => $dev_twt[$i - 1],
                    'instagram' => $dev_ig[$i - 1],
                ]),
                'company_description' => $dev_company_description[$i - 1],
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Game::create([
                'genre_id' => $faker->numberBetween(1, 10),
                'dev_id' => $i,
                'game_name' => $faker->word,
                'game_version' => '1.0',
                'price' => $faker->numberBetween(10000, 1000000),
                'promotional' => json_encode([
                    'logo' => $faker->imageUrl,
                    'trailer' => 'https://www.youtube.com/embed/5jKZ9KGtee0', //video url
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
