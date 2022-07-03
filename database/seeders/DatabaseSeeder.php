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
            'Action',
            'Adventure',
            'Casual',
            'Strategy',
            'RPG',
            'Simulation',
            'Sports',
            'Racing',
            'Battle Royale',
            'Other'
        ];

        $tags = [
            'New',
            'Promotion',
            'Sale',
            'Hot',
            'Comeback',
            'Hunt',
            'Race',
            'Killorgetkilled',
            'Survival',
            'Other'
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

        // Array game
        $game_genre_id = [
            6,
            2,
            2,
            1,
            2,
            2,
            2,
            6,
            2,
            2
        ];

        $game_name = [
            'Stardew Valley',
            'Cuphead',
            'Terraria',
            'Hades',
            'The Binding of Isaac : Rebirth',
            'Undertale',
            'Celeste',
            'Totally Accurate Battle Simulator',
            'Dead Cells',
            'Hollow Knight'
        ];

        $game_price = [
            0,
            95199,
            44999,
            71999,
            47999,
            89999,
            33999,
            37059,
            74999,
            57999
        ];

        $game_logo_url = [
            'https://images.igdb.com/igdb/image/upload/t_cover_big/xrpmydnu9rpxvxfjkiu7.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co49fq.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rbo.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co39vc.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1lbm.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co2855.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co3byy.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1veb.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgj.png',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgi.png'
        ];

        $game_trailer_url = [
            'https://www.youtube.com/embed/ot7uXNQskhs',
            'https://www.youtube.com/embed/e5iGwE0XJ1s',
            'https://www.youtube.com/embed/w7uOhFTrrq0',
            'https://www.youtube.com/embed/Bz8l935Bv0Y',
            'https://www.youtube.com/embed/Z6_C2ppkdVc',
            'https://www.youtube.com/embed/1Hojv0m3TqA',
            'https://www.youtube.com/embed/37njFGz8efs',
            'https://www.youtube.com/embed/ah6OVetEmFQ',
            'https://www.youtube.com/embed/Q1ZGq1mk1KM',
            'https://www.youtube.com/embed/0GXyV9EvB_g'
        ];

        $game_pic_url = [
            // stardew
            'https://images.igdb.com/igdb/image/upload/t_original/ar5l8.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/rhxs1x9w5hf5kde2osf5.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/iwswpvxa9ytrpk8yjcyx.jpg',
            // cup head
            'https://images.igdb.com/igdb/image/upload/t_original/ar6yk.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/sqho6e7tv9verg6j1tvv.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/r9zt66wdgqohmhuukiir.jpg',
            // terraria
            'https://images.igdb.com/igdb/image/upload/t_original/ar5kn.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/gsqomyqfsqqq31yhw0tt.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/cdg8nmyqbjogspa5wzvf.jpg',
            // hades
            'https://images.igdb.com/igdb/image/upload/t_original/ar10j0.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/sc8lik.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/sc8lim.jpg',
            // the binding of isaac
            'https://images.igdb.com/igdb/image/upload/t_original/arr0u.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/jbcoaccyn342cqg1i3ic.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/efirqoealy261qz830cv.jpg',
            // undertale
            'https://images.igdb.com/igdb/image/upload/t_original/ar4vc.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/ze8i79ycm3gyymrjvxf0.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/dp7ytj3ouesyoq7ddrrx.jpg',
            // celeste
            'https://images.igdb.com/igdb/image/upload/t_original/ar7u5.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/wjw3vnaclj29fqtziwsr.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/e9lk3alqutkrciksfque.jpg',
            // totally accurate battle simulator
            'https://images.igdb.com/igdb/image/upload/t_original/ar6i5.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/ns1yco3iwezeav9h6jee.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/zrmbxwlptiyrxw7z9p3x.jpg',
            // dead cells
            'https://images.igdb.com/igdb/image/upload/t_original/ar6il.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/bt9qwbyek1dmffukq44d.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/ikkm7a4sokicgfw7fmz5.jpg',
            // hollow knight
            'https://images.igdb.com/igdb/image/upload/t_original/tvfbpcmuonwiugjcbc45.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/p3svrq6ewzxnn7p1a3v9.jpg',
            'https://images.igdb.com/igdb/image/upload/t_original/ityinxmtkakwbokpcwws.jpg'
        ];

        $game_short_desc = [
            'Stardew Valley is an open-ended country-life RPG!',
            'Cuphead is a classic run and gun action game heavily focused on boss battles.',
            'Dig, Fight, Explore, Build: The very world is at your fingertips as you fight for survival, fortune, and glory.',
            'A rogue-lite hack and slash dungeon crawler.',
            'The Binding of Isaac: Rebirth is a top down, procedurally-generated roguelike game, remade based on the original game The Binding of Isaac.',
            'Welcome to UNDERTALE. In this RPG, you control a human who falls underground into the world of monsters.',
            'Help Madeline survive her inner demons.',
            'A physics based medieval battle simulator which lets you pit wacky waving armies against each other.',
            'Dead Cells is a rogue-lite, metroidvania inspired, action-platformer.',
            'A 2D metroidvania with an emphasis on close combat and exploration in which the player enters the once-prosperous now-bleak insect kingdom of Hallownest.'
        ];

        $game_content_rating = [
            'PEGI 12',
            'PEGI 7',
            'PEGI 12',
            'PEGI 12',
            'ESRB MATURE 17+',
            'ESRB EVERYONE 10+',
            'ESRB EVERYONE 10+',
            'PEGI 7',
            'TEEN',
            'PEGI 7'
        ];

        $game_about = [
            'Stardew Valley is an open-ended country-life RPG! You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life. Can you learn to live off the land and turn these overgrown fields into a thriving home? It won\'t be easy. Ever since Joja Corporation came to town, the old ways of life have all but disappeared. The community center, once the town\'s most vibrant hub of activity, now lies in shambles. But the valley seems full of opportunity. With a little dedication, you might just be the one to restore Stardew Valley to greatness!',
            'Cuphead is a classic run and gun action game heavily focused on boss battles. Inspired by cartoons of the 1930s, the visuals and audio are painstakingly created with the same techniques of the era, i.e. traditional cel animation (hand drawn & hand inked!), watercolor backgrounds, and original jazz recordings. Play as Cuphead or Mugman (in single player or co-op) as you traverse strange worlds, acquire new weapons, learn powerful super moves, and discover hidden secrets. Cuphead is all action, all the time.',
            'Dig, Fight, Explore, Build: The very world is at your fingertips as you fight for survival, fortune, and glory. Will you delve deep into cavernous expanses in search of treasure and raw materials with which to craft ever-evolving gear, machinery, and aesthetics? Perhaps you will choose instead to seek out ever-greater foes to test your mettle in combat? Maybe you will decide to construct your own city to house the host of mysterious allies you may encounter along your travels?',
            'A rogue-lite hack and slash dungeon crawler in which Zagreus, son of Hades the Greek god of the dead, attempts to escape his home and his oppressive father by fighting the souls of the dead through the various layers of the ever-shifting underworld, while getting to know and forging relationships with its inhabitants.',
            'The Binding of Isaac: Rebirth is a top down, procedurally-generated roguelike game, remade based on the original game The Binding of Isaac. You play as Isaac, a little boy who is chased to the basement by his mother who intends to kill Isaac for her savior. You explore different levels, collect items and try to defeat your mother.. and whatever other evil awaits you. If you die, you restart with none of your items you collected, and you must explore the basement and beyond again.',
            'A small child falls into the Underground, where monsters have long been banished by humans and are hunting every human that they find. The player controls the child as they try to make it back to the Surface through hostile environments, all the while engaging with a turn-based combat system with puzzle-solving and bullet hell elements, as well as other unconventional game mechanics.',
            'Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight, hand-crafted platformer from the creators of multiplayer classic TowerFall.',
            'A physics based medieval battle simulator which lets you pit wacky waving armies against each other. In Totally Accurate Battle Simulator you pit waving arm men against each other and watch them fight it out.',
            'Dead Cells is a rogue-lite, metroidvania inspired, action-platformer. You\'ll explore a sprawling, ever-changing castle... assuming you\'re able to fight your way past its keepers in 2D souls-lite combat. No checkpoints. Kill, die, learn, repeat.',
            'A 2D metroidvania with an emphasis on close combat and exploration in which the player enters the once-prosperous now-bleak insect kingdom of Hallownest, travels through its various districts, meets friendly inhabitants, fights hostile ones and uncovers the kingdom\'s history while improving their combat abilities and movement arsenal by fighting bosses and accessing out-of-the-way areas.'
        ];

        $game_processor = [
            '2 Ghz',
            'Intel Core2 Duo E8400, 3.0GHz or AMD Athlon 64 X2 6000+, 3.0GHz or higher',
            '2.0 Ghz',
            'Dual Core 2.4 GHz',
            '2.4 GHz Quad Core 2.0 (or higher)',
            '2 GHz',
            'Intel Core i3 M380',
            'Intel Core i5-2400 @ 3.1 GHz or AMD FX-6300 @ 3.5 GHz or equivalent',
            'Intel i5+',
            'Intel Core 2 Duo E5200'
        ];

        $game_os = [
            'Windows Vista or greater, Mac OSX 10.10 or higher, Ubuntu 12.04 LTS or higher',
            'Windows 7 or greater, Mac OS X 10.11.x or higher',
            'Windows Xp, Vista, 7, 8/8.1, 10',
            'Windows 7 SP1, MAC OSX 10.13.6+',
            'Windows 8 / 7 / Vista / XP, MAC OSX 10.9 or higher',
            'Windows XP, Vista, 7, 8, or 10, Mac OS X, Ubuntu 14+',
            'Windows 7 or newer, Lion 10.7.5, 32/64-bit, glibc 2.17+, 32/64-bit',
            'Windows 7, macOS Mojave',
            'Windows 7+, Mavericks 10.9 or later',
            'Windows 7 (64bit), Mac OS 10.13 (64bit), Ubuntu 16.04 LTS (64bit)'
        ];

        $game_memory = [
            '2 GB RAM',
            '4 GB RAM',
            '2.5 GB RAM',
            '4 GB RAM',
            '8 GB RAM',
            '2 GB RAM',
            '2 GB RAM',
            '8 GB RAM',
            '2 GB RAM',
            '4 GB RAM'
        ];

        $game_graphics = [
            '256 MB Video Memory',
            'Intel HD Graphics 4000 or higher (requires Metal)',
            '128 MB Video Memory, capable of Shader Model 2.0+',
            'Intel HD 5000 (must support Metal API)',
            'Intel HD Graphics 4000 and higher, ATI Radeon HD-Series 4650 and higher, Nvidia GeForce 2xx-Series and up',
            '128MB',
            'Intel HD 4000',
            'NVIDIA GeForce GTX 670 or AMD R9 270 (2GB VRAM with Shader Model 5.0 or better)',
            'Nvidia 450 GTS / Radeon HD 5750 or better',
            'GeForce 9800GTX+ (1GB)'
        ];

        $game_storage = [
            '500 MB',
            '4 GB',
            '200 MB',
            '15 GB',
            '449 MB',
            '200 MB',
            '1200 MB',
            '4 GB',
            '500 MB',
            '9 GB'
        ];

        for ($i = 1; $i <= 10; $i++) {
            Game::create([
                'genre_id' => $game_genre_id[$i - 1],
                'dev_id' => $i,
                'game_name' => $game_name[$i - 1],
                'game_version' => '1.0',
                'price' => $game_price[$i - 1],
                'promotional' => json_encode([
                    'logo' => $game_logo_url[$i - 1],
                    'trailer' => $game_trailer_url[$i - 1], //video url
                    'img' => [
                        $game_pic_url[3 * ($i - 1)], $game_pic_url[3 * ($i - 1) + 1], $game_pic_url[3 * ($i - 1)  + 2],
                    ]
                ]),
                'game_data_path' => $faker->url,
                'date_published' => $faker->dateTimeThisYear,
                'short_desc' => $game_short_desc[$i - 1],
                'content_rating' => $game_content_rating[$i - 1],
                'about_game' => $game_about[$i - 1],
                'requirement_processor' => $game_processor[$i - 1],
                'requirement_os' => $game_os[$i - 1],
                'requirement_memory' => $game_memory[$i - 1],
                'requirement_graphic' => $game_graphics[$i - 1],
                'requirement_storage' => $game_storage[$i - 1],
                'status' => 'published'
            ]);
        }

        // Array buat game review

        // Array buat game donos

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
