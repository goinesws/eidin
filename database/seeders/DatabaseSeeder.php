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

        User::create([
            'country' => $faker->country,
            'name' => "Renhan Tolentino",
            'role' => "user",
            'profile_url' => $faker->imageUrl,
            'username' => 'rentino',
            'email' => "dev@gmail.com",
            'password' => bcrypt('password'),
        ]);

        User::create([
            'country' => $faker->country,
            'name' => "Aza Van Dimenang",
            'role' => "user",
            'profile_url' => $faker->imageUrl,
            'username' => 'avd69',
            'email' => "avdabv@gmail.com",
            'password' => bcrypt('asdfg'),
        ]);

        for ($i = 1; $i <= 21; $i++) {
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
            'name' => "Admin",
            'role' => "admin",
            'profile_url' => $faker->imageUrl,
            'username' => 'avd80',
            'email' => "avd@gmail.com",
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'country' => $faker->country,
            'name' => "Zulya Anomysity",
            'role' => "user",
            'profile_url' => $faker->imageUrl,
            'username' => 'zulanty42',
            'email' => "user@gmail.com",
            'password' => bcrypt('password'),
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
            // concerned ape -> stardew
            'USA',
            // MDHR -> cuphead
            'North America',
            // RELOGIC -> terarria
            'USA',
            // SUPERGIANT -> hades
            'USA',
            // NICALIS -> the binding of isaac
            'USA',
            // TOBY FOX -> undertale
            'USA',
            // MAT MAKES GAMES -> celeste
            'Canada',
            // LANDFALL GAMES -> totally accurate battle simulator
            'Sweden',
            // MOTION TWIN -> dead cells
            'France',
            // TEAM CHERRY -> hollow knight
            'Australia',
            // Annapurna Interactive -> STRAY
            'America',
            // Tuxedo Labs -> Teardown
            'Sweden',
            // Team 17 -> OVERCOOKED 2
            'England',
            // Shiro Games -> Wartales
            'France',
            // Redbeet Interactive -> RAFT
            'Sweden',
            // peropero -> MUSE DASH
            'Japan',
            // Tribute Games -> TMNT
            'Quebec',
            // REBUILT GAMES -> PUMMEL PARTY
            'Australia',
            // BEAT games -> BEAT SABER
            'Czech Republic',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'Croatia',
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
            'Team Cherry',
            'Annapurna Interactive',
            'Tuxedo Labs',
            'Team 17',
            'Shiro Games',
            'Redbeet Interactive',
            'Peropero',
            'Tribute Games',
            'Rebuilt Games',
            'Beat Games',
            'Pine Studio',
        ];

        $dev_company_pic_url = [
            // concerned ape -> stardew
            'https://avatars.cloudflare.steamstatic.com/eaff8e24ad01c6d6a80064c8a5a46b81210492e3_full.jpg',
            // MDHR -> cuphead
            'https://avatars.cloudflare.steamstatic.com/dd512d95ac2870c1e29064707d49719535179c5e_full.jpg',
            // RELOGIC -> terarria
            'https://avatars.cloudflare.steamstatic.com/6ca4f16b768d95e984b8b4d7e09866a88d0aa036_full.jpg',
            // SUPERGIANT -> hades
            'https://avatars.cloudflare.steamstatic.com/7271c10f898a95afc524764d7d180db52f072d80_full.jpg',
            // NICALIS -> the binding of isaac
            'https://avatars.cloudflare.steamstatic.com/ef1904218b5ef0c5da6722e6c5bab8bc57fe0a04_full.jpg',
            // TOBY FOX -> undertale
            'https://pbs.twimg.com/profile_images/1304111803614613504/NKxFjarS_400x400.jpg',
            // MAT MAKES GAMES -> celeste
            'https://upload.wikimedia.org/wikipedia/commons/2/27/Matt-makes-games-logo.png',
            // LANDFALL GAMES -> totally accurate battle simulator
            'https://avatars.cloudflare.steamstatic.com/edb7a6de43d2d99a28f54f5f6c2411e07056ef4a_full.jpg',
            // MOTION TWIN -> dead cells
            'https://avatars.cloudflare.steamstatic.com/325a178d58906ad104b8edfa3890c9a1450e6d6c_full.jpg',
            // TEAM CHERRY -> hollow knight
            'https://avatars.cloudflare.steamstatic.com/6dd64832e621ff348935216b4d4bd993587f783c_full.jpg',
            // Annapurna Interactive -> STRAY
            'https://avatars.cloudflare.steamstatic.com/5fdf11fc6e4e0d106b92443d203b8acf91b7923b_full.jpg',
            // Tuxedo Labs -> Teardown
            'https://www.tuxedolabs.com/assets/img/animated.png',
            // Team 17 -> OVERCOOKED 2
            'https://avatars.cloudflare.steamstatic.com/ddb61e244eb6a48f0f4da0179bc8b8a7ca217c95_full.jpg',
            // Shiro Games -> Wartales
            'https://avatars.cloudflare.steamstatic.com/152839adc6d863488b742b83adb1a806083352a5_full.jpg',
            // Redbeet Interactive -> RAFT
            'https://pbs.twimg.com/profile_images/1229420922630803456/Sxjgye_1_400x400.jpg',
            // peropero -> MUSE DASH
            'http://user-assets.sxlcdn.com/images/64283/FsrIziP807GAj3PfpXQGfoHBwneP.png?imageMogr2/strip/auto-orient/thumbnail/2000x1500%3E/quality/90!/format/png',
            // Tribute Games -> TMNT
            'https://avatars.cloudflare.steamstatic.com/3332931897d1361fa7e86b727166745d475eb963_full.jpg',
            // REBUILT GAMES -> PUMMEL PARTY
            'https://pbs.twimg.com/profile_images/992433644718321664/PF-eNpGL_400x400.jpg',
            // BEAT games -> BEAT SABER
            'https://pbs.twimg.com/profile_images/1036534699244576768/9ywivPt6_400x400.jpg',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'https://media-exp2.licdn.com/dms/image/C4D0BAQHij6b45cVFLQ/company-logo_200_200/0/1651485279368?e=2147483647&v=beta&t=s4tffol_slyX-592mdU3UaTI55dDALGFJkq7h3kgtY8',
        ];

        $dev_company_address = [
            // concerned ape -> stardew
            'Seattle, WA',
            // MDHR -> cuphead
            'North America',
            // RELOGIC -> terarria
            'Indiana, USA',
            // SUPERGIANT -> hades
            'San Fransisco, CA',
            // NICALIS -> the binding of isaac
            'Santa Ana, CA',
            // TOBY FOX -> undertale
            'New Hampshire, USA',
            // MAT MAKES GAMES -> celeste
            'Canada',
            // LANDFALL GAMES -> totally accurate battle simulator
            'Stockholm, Sweden',
            // MOTION TWIN -> dead cells
            'Paris, France',
            // TEAM CHERRY -> hollow knight
            'Adelaide, Australia',
            // Annapurna Interactive -> STRAY
            'LA, America',
            // Tuxedo Labs -> Teardown
            'Malmo, Sweden',
            // Team 17 -> OVERCOOKED 2
            'Wakefield, England',
            // Shiro Games -> Wartales
            'Bordeaux, France',
            // Redbeet Interactive -> RAFT
            'Skövde, Sweden',
            // peropero -> MUSE DASH
            'Japan',
            // Tribute Games -> TMNT
            'Montreal, Quebec',
            // REBUILT GAMES -> PUMMEL PARTY
            'New South Wales, Australia',
            // BEAT games -> BEAT SABER
            'Prague, Czech Republic',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'Samabor, Croatia',
        ];

        $dev_company_website = [
            // concerned ape -> stardew
            'https://www.stardewvalley.net/',
            // MDHR -> cuphead
            'http://studiomdhr.com/',
            // RELOGIC -> terarria
            'https://www.re-logic.com/',
            // SUPERGIANT -> hades
            'https://www.supergiantgames.com/',
            // NICALIS -> the binding of isaac
            'https://www.nicalis.com/',
            // TOBY FOX -> undertale
            'https://undertale.com/',
            // MAT MAKES GAMES -> celeste
            'http://www.mattmakesgames.com/',
            // LANDFALL GAMES -> totally accurate battle simulator
            'https://landfall.se/',
            // MOTION TWIN -> dead cells
            'http://motion-twin.com/en/',
            // TEAM CHERRY -> hollow knight
            'https://www.teamcherry.com.au/',
            // Annapurna Interactive -> STRAY
            'https://annapurnainteractive.com/',
            // Tuxedo Labs -> Teardown
            'https://www.tuxedolabs.com/',
            // Team 17 -> OVERCOOKED 2
            'https://www.team17.com/',
            // Shiro Games -> Wartales
            'https://shirogames.com/',
            // Redbeet Interactive -> RAFT
            'https://www.redbeetinteractive.com/index.html',
            // peropero -> MUSE DASH
            'http://cdn.peroperogames.com/',
            // Tribute Games -> TMNT
            'https://www.tributegames.com/',
            // REBUILT GAMES -> PUMMEL PARTY
            'http://rebuiltgames.com/',
            // BEAT games -> BEAT SABER
            'https://beatsaber.com/',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'https://pinestudio.com/',
        ];

        $dev_facebook = [
            // concerned ape -> stardew
            null,
            // MDHR -> cuphead
            'https://www.facebook.com/studiomdhr/',
            // RELOGIC -> terarria
            'https://www.facebook.com/ReLogicGames/',
            // SUPERGIANT -> hades
            'https://www.facebook.com/supergiantgames/',
            // NICALIS -> the binding of isaac
            null,
            // TOBY FOX -> undertale
            null,
            // MAT MAKES GAMES -> celeste
            null,
            // LANDFALL GAMES -> totally accurate battle simulator
            null,
            // MOTION TWIN -> dead cells
            'https://www.facebook.com/motiontwin/',
            // TEAM CHERRY -> hollow knight
            null,
            // Annapurna Interactive -> STRAY
            'https://www.facebook.com/AnnapurnaInteractive/',
            // Tuxedo Labs -> Teardown
            null,
            // Team 17 -> OVERCOOKED 2
            'https://www.facebook.com/Team17/',
            // Shiro Games -> Wartales
            null,
            // Redbeet Interactive -> RAFT
            'https://www.facebook.com/RedbeetOfficial/',
            // peropero -> MUSE DASH
            null,
            // Tribute Games -> TMNT
            'https://www.facebook.com/TributeGames/',
            // REBUILT GAMES -> PUMMEL PARTY
            null,
            // BEAT games -> BEAT SABER
            'https://www.facebook.com/BeatGamesStudio/',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'https://www.facebook.com/PineStudioLLC/',
        ];

        $dev_twt = [
            // concerned ape -> stardew
            'https://twitter.com/ConcernedApe',
            // MDHR -> cuphead
            'https://twitter.com/StudioMDHR',
            // RELOGIC -> terarria
            'https://twitter.com/ReLogicGames',
            // SUPERGIANT -> hades
            'https://twitter.com/SupergiantGames',
            // NICALIS -> the binding of isaac
            'https://twitter.com/nicalis',
            // TOBY FOX -> undertale
            'https://twitter.com/tobyfox',
            // MAT MAKES GAMES -> celeste
            'https://twitter.com/MaddyThorson',
            // LANDFALL GAMES -> totally accurate battle simulator
            'https://twitter.com/LandfallGames',
            // MOTION TWIN -> dead cells
            'https://twitter.com/motiontwin',
            // TEAM CHERRY -> hollow knight
            'https://twitter.com/TeamCherryGames',
            // Annapurna Interactive -> STRAY
            'https://twitter.com/A_i?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor',
            // Tuxedo Labs -> Teardown
            'https://twitter.com/tuxedolabs?lang=en',
            // Team 17 -> OVERCOOKED 2
            'https://twitter.com/Team17?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor',
            // Shiro Games -> Wartales
            'https://twitter.com/shirogames?lang=en',
            // Redbeet Interactive -> RAFT
            'https://twitter.com/redbeetofficial?lang=en',
            // peropero -> MUSE DASH
            'https://twitter.com/musedash_en?lang=en',
            // Tribute Games -> TMNT
            'https://twitter.com/TributeGames?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor',
            // REBUILT GAMES -> PUMMEL PARTY
            'https://twitter.com/rebuiltgames?lang=en',
            // BEAT games -> BEAT SABER
            'https://twitter.com/beatgamesstudio?lang=en',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'https://twitter.com/PineStudioLLC?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor',
        ];

        $dev_ig = [
            // concerned ape -> stardew
            null,
            // MDHR -> cuphead
            'https://www.instagram.com/studiomdhr/?hl=en',
            // RELOGIC -> terarria
            null,
            // SUPERGIANT -> hades
            'https://www.instagram.com/supergiantgames/?hl=en',
            // NICALIS -> the binding of isaac
            'https://www.instagram.com/nicalisinc/',
            // TOBY FOX -> undertale
            null,
            // MAT MAKES GAMES -> celeste
            null,
            // LANDFALL GAMES -> totally accurate battle simulator
            null,
            // MOTION TWIN -> dead cells
            null,
            // TEAM CHERRY -> hollow knight
            null,
            // Annapurna Interactive -> STRAY
            'https://www.instagram.com/annapurnainteractive/?hl=en',
            // Tuxedo Labs -> Teardown
            null,
            // Team 17 -> OVERCOOKED 2
            'https://www.instagram.com/team17ltd/?hl=en',
            // Shiro Games -> Wartales
            null,
            // Redbeet Interactive -> RAFT
            'https://www.instagram.com/redbeetinteractive/?hl=en',
            // peropero -> MUSE DASH
            null,
            // Tribute Games -> TMNT
            'https://www.instagram.com/tribute_games/?hl=en',
            // REBUILT GAMES -> PUMMEL PARTY
            'https://www.instagram.com/rebuiltgames/?hl=en',
            // BEAT games -> BEAT SABER
            'https://www.instagram.com/beatgamesstudio/?hl=en',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'https://www.instagram.com/pinestudio_games/?hl=en',
        ];

        $dev_company_description = [
            // concerned ape -> stardew
            'ConcernedApe is the moniker of Eric Barone, a solo game developer based in Seattle, WA.',
            // MDHR -> cuphead
            'Studio MDHR is an independent video game company founded by brothers Chad & Jared Moldenhauer. Working remotely with a team from across North America, Studio MDHR launched Cuphead on Xbox One and PC.',
            // RELOGIC -> terarria
            'Best known for the Terraria franchise - the revolutionary 2D Sandbox Adventure that has entertained millions of gamers worldwide - Re-Logic seeks to showcase and evolve the limits of what Indie gaming can be!',
            // SUPERGIANT -> hades
            'We make games that spark your imagination like the games you played as a kid.',
            // NICALIS -> the binding of isaac
            'Developer of The Binding of Isaac: Rebirth and publisher of some of your favorite video games!',
            // TOBY FOX -> undertale
            'Robert F. Fox, known professionally as Toby Fox and previously as Toby "Radiation" Fox, is an American video game developer and video game composer.',
            // MAT MAKES GAMES -> celeste
            'Maddy Thorson is a Canadian video game developer, known as one of the lead creators for the video games TowerFall and Celeste, developed under the studio Matt Makes Games.',
            // LANDFALL GAMES -> totally accurate battle simulator
            'Landfall Games is an indie studio from Sweden that makes physics games, also other games, sometimes funny.',
            // MOTION TWIN -> dead cells
            'Motion Twin is an anarcho-syndical (seriously) workers cooperative that\'s been making games in France since 2001. No boss, equal pay, equal say. It\'s an experiment and an experience!',
            // TEAM CHERRY -> hollow knight
            'Team Cherry is a small indie games team in Adelaide, South Australia. Our mission is to build crazy and exciting worlds for you to explore and conquer.',
            // Annapurna Interactive -> STRAY
            '“Established in 2016, Annapurna Interactive works with game creators from around the world, helping them create and release personal experiences for everyone.”',
            // Tuxedo Labs -> Teardown
            'Tuxedo Labs is an tech-driven game studio in Malmö, Sweden. We are a small team of seasoned game developers creating innovative and unique games based on new technologies',
            // Team 17 -> OVERCOOKED 2
            'Team17 is a games label by independent developers for independent developers. Home to 90+ premium, indie games including the original Worms.',
            // Shiro Games -> Wartales
            'Shiro Games is an independent video game development studio based in Bordeaux, France. Our team is made of talented and passionate developers who strive for excellence and are brave enough to make bold decisions on a daily basis.',
            // Redbeet Interactive -> RAFT
            'Redbeet Interactive is a small game studio founded in 2017. We are currently developing Raft, a game where your mission is to survive an epic oceanic adventure. The game is available on Steam Early Access.',
            // peropero -> MUSE DASH
            'peropero(广州呸喽呸喽科技有限公司)成立于2017年8,目前主营泛二次元游戏设计研发及其派生文化的推广传播',
            // Tribute Games -> TMNT
            'Welcome to Tribute Games! We\'ve been steadily creating fun and challenging video games since 2011.',
            // REBUILT GAMES -> PUMMEL PARTY
            'Rebuilt Games is a two person independent game developer based in New South Wales Australia currently working on its first game \'Pummel Party.',
            // BEAT games -> BEAT SABER
            'We are Beat Games s.r.o. with registered office in the Czech Republic, delivery address Mikovcova 548/5, 120 00 Praha 2, Czech Republic. We are a game development company specializing in the development of beat-based games.',
            // PINE STUDIO -> ESCAPE SIMULATOR
            'A game development and publishing company. We are a boutique game studio obsessed with crafting extraordinary puzzle games on the cutting edge of technology.',
        ];

        for ($i = 1; $i <= 20; $i++) {
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
            // stardew
            6,
            // cuphead
            2,
            // terraria
            2,
            // hades
            1,
            // the binding of isaac
            2,
            // undertale
            2,
            // celeste
            2,
            // totally accurate battle simulator
            6,
            // deadcells
            2,
            // hollow knight
            2,
            // Stray
            6,
            // teardown
            1,
            // overcooked 2
            6,
            // wartales
            1,
            // raft
            2,
            // muse dash
            3,
            // TMNT
            1,
            // Pummel Party
            3,
            // Beat Saber
            7,
            // Escape Simulator
            4,
        ];

        $game_name = [
            // stardew
            'Stardew Valley',
            // cuphead
            'Cuphead',
            // terraria
            'Terraria',
            // hades
            'Hades',
            // the binding of isaac
            'The Binding of Isaac : Rebirth',
            // undertale
            'Undertale',
            // celeste
            'Celeste',
            // totally accurate battle simulator
            'Totally Accurate Battle Simulator',
            // dead cells
            'Dead Cells',
            // holloe knight
            'Hollow Knight',
            // Stray
            'Stray',
            // teardown
            'Teardown',
            // overcooked 2
            'Overcooked 2',
            // wartales
            'Wartales',
            // raft
            'Raft',
            // muse dash
            'Muse Dash',
            // TMNT
            'Teenage Mutants Ninja Turtle',
            // Pummel Party
            'Pummel Party',
            // Beat Saber
            'Beat Saber',
            // Escape Simulator
            'Escape Simulator',
        ];

        $game_price = [
            // stardew valley
            0,
            // cuphead
            95199,
            // terraria
            44999,
            // hades
            71999,
            // the binding of isaac
            47999,
            // undertale
            89999,
            // celeste
            33999,
            // totally accurate battle simulator
            37059,
            // dead cells
            74999,
            // hollow knight
            57999,
            // Stray
            134999,
            // teardown
            119000,
            // overcooked 2
            199999,
            // wartales
            379999,
            // raft
            135999,
            // muse dash
            37000,
            // TMNT
            119999,
            // Pummel Party
            95999,
            // Beat Saber
            139999,
            // Escape Simulator
            95999,
        ];

        $game_logo_url = [
            // stardew valley
            'https://images.igdb.com/igdb/image/upload/t_cover_big/xrpmydnu9rpxvxfjkiu7.png',
            // cuphead
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co49fq.png',
            // terarria
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rbo.png',
            // hades
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co39vc.png',
            // the binding of isaac
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1lbm.png',
            // undertale
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co2855.png',
            // celeste
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co3byy.png',
            // totally accurate battle simulator
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1veb.png',
            // dead cells
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgj.png',
            // hollow knight
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgi.png',
            // Stray
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1332010/header.jpg?t=1657307370',
            // teardown
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1167630/header.jpg?t=1656046119',
            // overcooked 2
            'https://cdn.cloudflare.steamstatic.com/steam/apps/728880/header.jpg?t=1643298085',
            // wartales
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1527950/header.jpg?t=1657115597',
            // raft
            'https://cdn.cloudflare.steamstatic.com/steam/apps/648800/header.jpg?t=1655744208',
            // muse dash
            'https://cdn.cloudflare.steamstatic.com/steam/apps/774171/header.jpg?t=1655707604',
            // TMNT
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1361510/header.jpg?t=1657541506',
            // Pummel Party
            'https://cdn.cloudflare.steamstatic.com/steam/apps/880940/header.jpg?t=1585242250',
            // Beat Saber
            'https://cdn.cloudflare.steamstatic.com/steam/apps/620980/header.jpg?t=1622461922',
            // Escape Simulator
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1435790/header.jpg?t=1654600937',
        ];

        $game_trailer_url = [
            // stardew
            'https://www.youtube.com/embed/ot7uXNQskhs',
            // cuphead
            'https://www.youtube.com/embed/e5iGwE0XJ1s',
            // terraria
            'https://www.youtube.com/embed/w7uOhFTrrq0',
            // hades
            'https://www.youtube.com/embed/Bz8l935Bv0Y',
            // the binding of isaac
            'https://www.youtube.com/embed/Z6_C2ppkdVc',
            // undertale
            'https://www.youtube.com/embed/1Hojv0m3TqA',
            // celeste
            'https://www.youtube.com/embed/37njFGz8efs',
            // totally accurate battle simulator
            'https://www.youtube.com/embed/ah6OVetEmFQ',
            // dead cells
            'https://www.youtube.com/embed/Q1ZGq1mk1KM',
            // hollow knight
            'https://www.youtube.com/embed/0GXyV9EvB_g',
            // Stray
            'https://www.youtube.com/embed/hrdf44z4VWo',
            // teardown
            'https://www.youtube.com/embed/ttwBelIlLv8',
            // overcooked 2
            'https://www.youtube.com/embed/0JG5Y7ZWvWU',
            // wartales
            'https://www.youtube.com/embed/8lLyziem3KA',
            // raft
            'https://www.youtube.com/embed/__w615A5lC4',
            // muse dash
            'https://www.youtube.com/embed/K_3LiLv8ya4',
            // TMNT
            'https://www.youtube.com/embed/gHMYwrC7oAo',
            // Pummel Party
            'https://www.youtube.com/embed/oiYG0Ov5jKE',
            // Beat Saber
            'https://www.youtube.com/embed/vL39Sg2AqWg',
            // Escape Simulator
            'https://www.youtube.com/embed/2VT7_tfRYV8',
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
            'https://images.igdb.com/igdb/image/upload/t_original/ityinxmtkakwbokpcwws.jpg',
            // Stray
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1332010/ss_3fdd04a5418293864bf82d33c75f833121e63804.1920x1080.jpg?t=1657307370',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1332010/ss_f6f6ba009971ff21867d5d8f96a3feb503f787b8.1920x1080.jpg?t=1657307370',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1332010/ss_95ead64e0d31147f47f27ce828e8d5f52939dcf6.1920x1080.jpg?t=1657307370',
            // teardown
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1167630/ss_1456883f851965d17acc0fd466a53d17bab3ef8f.1920x1080.jpg?t=1656046119',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1167630/ss_b27b34be4df67359cda370e9a9372ea229ef2932.1920x1080.jpg?t=1656046119',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1167630/ss_4e43fc5c0302825007c35f51e03964726a06e984.1920x1080.jpg?t=1656046119',
            // overcooked 2
            'https://cdn.cloudflare.steamstatic.com/steam/apps/728880/ss_88214b3459727a759728dc9c6f4e07ad8b66f383.1920x1080.jpg?t=1643298085',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/728880/ss_a78767be5e9f3fb714721f0ab16c173cf9d78f2f.1920x1080.jpg?t=1643298085',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/728880/ss_bec2afe4b53d2dbb08119be5a7fbf1b0df3d705f.1920x1080.jpg?t=1643298085',
            // wartales
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1527950/ss_3bac295fb230013171ba85f498a3dd3d70b9dc71.1920x1080.jpg?t=1657115597',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1527950/ss_252a441da37f65590544d717b24bcacf00a780b6.1920x1080.jpg?t=1657115597',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1527950/ss_3701171b25ae40d2ffacd7d06c1a0b205d78e5d9.1920x1080.jpg?t=1657115597',
            // raft
            'https://cdn.cloudflare.steamstatic.com/steam/apps/648800/ss_fdf998ea2eca1e79c0141b83ef32c5fadecd9a0e.1920x1080.jpg?t=1655744208',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/648800/ss_d1ab60ade693c7ce90bcd0ba5400f8ea39e73edb.1920x1080.jpg?t=1655744208',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/648800/ss_363d79b1d6da0ec6dbccdff1c1f07e189664965a.1920x1080.jpg?t=1655744208',
            // muse dash
            'https://cdn.cloudflare.steamstatic.com/steam/apps/774171/ss_08637a7ac0fb40479d0ad69c78e49805641644e3.1920x1080.jpg?t=1655707604',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/774171/ss_2c2433413895c9d90ce5e7e31d81e963a2238bc3.1920x1080.jpg?t=1655707604',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/774171/ss_ab029483f2e7341ac621540794e4d372acd02213.1920x1080.jpg?t=1655707604',
            // TMNT
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1361510/ss_9137378c986b3474a5e96fe2ed2defc24e98912b.1920x1080.jpg?t=1657541506',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1361510/ss_f34d50082d66f661a0751e96a4813818d910e3a7.1920x1080.jpg?t=1657541506',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1361510/ss_3aa6503f711ddcde356e81077aa1b14092281a96.1920x1080.jpg?t=1657541506',
            // Pummel Party
            'https://cdn.cloudflare.steamstatic.com/steam/apps/880940/ss_b51e213e314bdbd953d190b18b119c679ba64922.1920x1080.jpg?t=1585242250',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/880940/ss_9d352c6fd1d3dec079127a5dd2108b31d57ee072.1920x1080.jpg?t=1585242250',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/880940/ss_790b659aa31131822d0eae36e5c446b31342fd69.1920x1080.jpg?t=1585242250',
            // Beat Saber
            'https://cdn.cloudflare.steamstatic.com/steam/apps/620980/ss_910fb7ad48bfdd918b0396b14f3dd45fc7f2e847.1920x1080.jpg?t=1622461922',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/620980/ss_542d092f42c779c866167bec05c1da488bcd91f8.1920x1080.jpg?t=1622461922',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/620980/ss_114dc9a9f27666b2d56801ba49a1db8fa202b6ee.1920x1080.jpg?t=1622461922',
            // Escape Simulator
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1435790/ss_97ac8646b5229e55008c6d0d1df9b0ec8e4062b5.1920x1080.jpg?t=1654600937',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1435790/ss_451181f4ed93a55f303a0bd03053fb2690f13bfe.1920x1080.jpg?t=1654600937',
            'https://cdn.cloudflare.steamstatic.com/steam/apps/1435790/ss_0edded8a5eee1fe06254b8011666ba3e33cda285.1920x1080.jpg?t=1654600937',
        ];

        $game_short_desc = [
            // stardew valley
            'Stardew Valley is an open-ended country-life RPG!',
            // cuphead
            'Cuphead is a classic run and gun action game heavily focused on boss battles.',
            // terraria
            'Dig, Fight, Explore, Build: The very world is at your fingertips as you fight for survival, fortune, and glory.',
            // hades
            'A rogue-lite hack and slash dungeon crawler.',
            // the binding of isaac
            'The Binding of Isaac: Rebirth is a top down, procedurally-generated roguelike game.',
            // undertale
            'Welcome to UNDERTALE. In this RPG, you control a human who falls underground into the world of monsters.',
            // celeste
            'Help Madeline survive her inner demons.',
            // totally accurate battle simulator
            'A physics based medieval battle simulator which lets you pit wacky waving armies against each other.',
            // dead cells
            'Dead Cells is a rogue-lite, metroidvania inspired, action-platformer.',
            // hollow knight
            'A 2D metroidvania with an emphasis on close combat and exploration.',
            // Stray
            'Lost, alone and separated from family, a stray cat must untangle an ancient mystery to escape a long-forgotten city.',
            // teardown
            'Plan the perfect heist using creative problem solving, brute force, and everything around you.',
            // overcooked 2
            'Overcooked returns with a brand-new helping of chaotic cooking action!',
            // wartales
            'It has been a hundred years since the world saw the fall of the once great Edoran Empire at the hands of an unprecedented plague that swept the nation.',
            // raft
            'By yourself or with friends, your mission is to survive an epic oceanic adventure across
            a perilous sea!',
            // muse dash
            '"Hitting while listening to music."',
            // TMNT
            'Teenage Mutant Ninja Turtles: Shredder’s Revenge features groundbreaking gameplay rooted in timeless classic brawling mechanics.',
            // Pummel Party
            'Pummel Party is a 4-8 player online and local-multiplayer party game.',
            // Beat Saber
            'Beat Saber is an immersive rhythm experience you have never seen before!',
            // Escape Simulator
            'Escape Simulator is a first-person puzzler you can play solo or in an online co-op.',
        ];

        $game_content_rating = [
            // stardew
            'PEGI 12',
            // cuphead
            'PEGI 7',
            // terarria
            'PEGI 12',
            // hades
            'PEGI 12',
            // the binding of isaac
            'ESRB MATURE 17+',
            // undertale
            'ESRB EVERYONE 10+',
            // celeste
            'ESRB EVERYONE 10+',
            // totally accurate battle simulator
            'PEGI 7',
            // dead cells
            'TEEN',
            // hollow knight
            'PEGI 7',
            // Stray
            'ESRB EVERYONE 10+',
            // teardown
            'PEGI 7',
            // overcooked 2
            'ESRB EVERYONE',
            // wartales
            'ESRB MATURE 17+',
            // raft
            'ESRB EVERYONE 10+',
            // muse dash
            'ESRB TEEN',
            // TMNT
            'ESRB EVERYONE 10+',
            // Pummel Party
            'ESRB EVERYONE 10+',
            // Beat Saber
            'ESRB EVERYONE',
            // Escape Simulator
            'PEGI 12',
        ];

        $game_about = [
            // stardew
            'Stardew Valley is an open-ended country-life RPG! You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life. Can you learn to live off the land and turn these overgrown fields into a thriving home? It won\'t be easy. Ever since Joja Corporation came to town, the old ways of life have all but disappeared. The community center, once the town\'s most vibrant hub of activity, now lies in shambles. But the valley seems full of opportunity. With a little dedication, you might just be the one to restore Stardew Valley to greatness!',
            // cuphead
            'Cuphead is a classic run and gun action game heavily focused on boss battles. Inspired by cartoons of the 1930s, the visuals and audio are painstakingly created with the same techniques of the era, i.e. traditional cel animation (hand drawn & hand inked!), watercolor backgrounds, and original jazz recordings. Play as Cuphead or Mugman (in single player or co-op) as you traverse strange worlds, acquire new weapons, learn powerful super moves, and discover hidden secrets. Cuphead is all action, all the time.',
            // terraria
            'Dig, Fight, Explore, Build: The very world is at your fingertips as you fight for survival, fortune, and glory. Will you delve deep into cavernous expanses in search of treasure and raw materials with which to craft ever-evolving gear, machinery, and aesthetics? Perhaps you will choose instead to seek out ever-greater foes to test your mettle in combat? Maybe you will decide to construct your own city to house the host of mysterious allies you may encounter along your travels?',
            // hades
            'A rogue-lite hack and slash dungeon crawler in which Zagreus, son of Hades the Greek god of the dead, attempts to escape his home and his oppressive father by fighting the souls of the dead through the various layers of the ever-shifting underworld, while getting to know and forging relationships with its inhabitants.',
            // the binding of isaac
            'The Binding of Isaac: Rebirth is a top down, procedurally-generated roguelike game, remade based on the original game The Binding of Isaac. You play as Isaac, a little boy who is chased to the basement by his mother who intends to kill Isaac for her savior. You explore different levels, collect items and try to defeat your mother.. and whatever other evil awaits you. If you die, you restart with none of your items you collected, and you must explore the basement and beyond again.',
            // undertale
            'A small child falls into the Underground, where monsters have long been banished by humans and are hunting every human that they find. The player controls the child as they try to make it back to the Surface through hostile environments, all the while engaging with a turn-based combat system with puzzle-solving and bullet hell elements, as well as other unconventional game mechanics.',
            // celeste
            'Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight, hand-crafted platformer from the creators of multiplayer classic TowerFall.',
            // totally accurate battle simulator
            'A physics based medieval battle simulator which lets you pit wacky waving armies against each other. In Totally Accurate Battle Simulator you pit waving arm men against each other and watch them fight it out.',
            // dead cells
            'Dead Cells is a rogue-lite, metroidvania inspired, action-platformer. You\'ll explore a sprawling, ever-changing castle... assuming you\'re able to fight your way past its keepers in 2D souls-lite combat. No checkpoints. Kill, die, learn, repeat.',
            // hollow knight
            'A 2D metroidvania with an emphasis on close combat and exploration in which the player enters the once-prosperous now-bleak insect kingdom of Hallownest, travels through its various districts, meets friendly inhabitants, fights hostile ones and uncovers the kingdom\'s history while improving their combat abilities and movement arsenal by fighting bosses and accessing out-of-the-way areas.',
            // Stray
            'Stray is a third-person cat adventure game set amidst the detailed, neon-lit alleys of a decaying cybercity and the murky environments of its seedy underbelly. Roam surroundings high and low, defend against unforeseen threats and solve the mysteries of this unwelcoming place inhabited by curious droids and dangerous creatures.',
            // teardown
            'Plan the perfect heist using creative problem solving, brute force, and everything around you. Teardown features a fully destructible and truly interactive environment where player freedom and emergent gameplay are the driving mechanics.',
            // overcooked 2
            'Overcooked returns with a brand-new helping of chaotic cooking action! Journey back to the Onion Kingdom and assemble your team of chefs in classic couch co-op or online play for up to four players. Hold onto your aprons … it\'s time to save the world (again!)',
            // wartales
            'It has been a hundred years since the world saw the fall of the once great Edoran Empire at the hands of an unprecedented plague that swept the nation. In the turmoil and uncertainty that has followed, mercenary work, banditry and thievery across the land is abundant, as honor has long since become an almost entirely forgotten virtue.
            ',
            // raft
            'By yourself or with friends, your mission is to survive an epic oceanic adventure across
            a perilous sea! Gather debris to survive, expand your raft and set sail towards forgotten and dangerous islands!',
            // muse dash
            '"Hitting while listening to music."
            "Is that the call from another world?"
            [Game Starts Now—!!]',
            // TMNT
            'Teenage Mutant Ninja Turtles: Shredder\'s Revenge features groundbreaking gameplay rooted in timeless classic brawling mechanics, brought to you by the beat \'em up experts at Dotemu (Streets of Rage 4) and Tribute Games. Bash your way through gorgeous pixel art environments and slay tons of hellacious enemies with your favorite Turtle, each with his own skills and moves - making each run unique! Choose a fighter, use radical combos to defeat your opponents and experience intense combats loaded with breathtaking action and outrageous ninja abilities. Stay sharp as you face off against Shredder and his faithful Foot Clan alone, or grab your best buds and play with up to 6 players simultaneously!',
            // Pummel Party
            'Pummel Party is a 4-8 player online and local-multiplayer party game. Pummel friends or AI using a wide array of absurd items in the board mode and compete to destroy friendships in the entertaining collection of minigames',
            // Beat Saber
            'Beat Saber is an immersive rhythm experience you have never seen before! Enjoy tons of handcrafted levels and swing your way through the pulsing music beats, surrounded by a futuristic world. Use your sabers to slash the beats as they come flying at you  every beat indicates which saber you need to use and the direction you need to match. With Beat Saber you become a dancing superhero!',
            // Escape Simulator
            'Escape Simulator is a first-person puzzler you can play solo or in an online co-op. Explore a growing set of highly interactive escape rooms. Move furniture, pick up and examine everything, smash pots and break locks! Supports community-made rooms through the level editor.',
        ];

        $game_processor = [
            // stardew
            '2 Ghz',
            // cuphead
            'Intel Core2 Duo E8400, 3.0GHz or AMD Athlon 64 X2 6000+, 3.0GHz or higher',
            // terraria
            '2.0 Ghz',
            // hades
            'Dual Core 2.4 GHz',
            // the binding of isaac
            '2.4 GHz Quad Core 2.0 (or higher)',
            // undertale
            '2 GHz',
            // celeste
            'Intel Core i3 M380',
            // totally accurate battle simulator
            'Intel Core i5-2400 @ 3.1 GHz or AMD FX-6300 @ 3.5 GHz or equivalent',
            // dead cells
            'Intel i5+',
            // hollow knight
            'Intel Core 2 Duo E5200',
            // Stray
            'Intel Core i5-8400 | AMD Ryzen 5 2600',
            // teardown
            'Intel Core i7 or better',
            // overcooked 2
            'Intel i5-650 / AMD A10-5800K',
            // wartales
            'Intel i5 3.1 Ghz Quad core',
            // raft
            'Intel Core i5-6600 3.3GHz or similar',
            // muse dash
            'Intel Core™ Duo or faster',
            // TMNT
            'Intel Core i5-2400 or AMD FX-6300',
            // Pummel Party
            'Dual Core 2.4Ghz',
            // Beat Saber
            'Intel Core i7 Skylake or equivalent',
            // Escape Simulator
            'X64 architecture with SSE2 instruction set support',
        ];

        $game_os = [
            // stardew
            'Windows Vista or greater, Mac OSX 10.10 or higher, Ubuntu 12.04 LTS or higher',
            // cuphead
            'Windows 7 or greater, Mac OS X 10.11.x or higher',
            // terraria
            'Windows Xp, Vista, 7, 8/8.1, 10',
            // hades
            'Windows 7 SP1, MAC OSX 10.13.6+',
            // the binding of isaac
            'Windows 8 / 7 / Vista / XP, MAC OSX 10.9 or higher',
            // undertale
            'Windows XP, Vista, 7, 8, or 10, Mac OS X, Ubuntu 14+',
            // celeste
            'Windows 7 or newer, Lion 10.7.5, 32/64-bit, glibc 2.17+, 32/64-bit',
            // totally accurate battle simulator
            'Windows 7, macOS Mojave',
            // dead cells
            'Windows 7+, Mavericks 10.9 or later',
            // hollow knight
            'Windows 7 (64bit), Mac OS 10.13 (64bit), Ubuntu 16.04 LTS (64bit)',
            // Stray
            'Windows 10',
            // teardown
            'Windows 10',
            // overcooked 2
            'Win7 -64 bit, MacOS High Sierra - 10.13.1, Mint 18 / Ubuntu 16.04.01',
            // wartales
            'Windows 10 64bit',
            // raft
            'Windows 7 or later',
            // muse dash
            'Windows 7 64bit or later, OS X Lion 10.7, or later.',
            // TMNT
            'Windows 10, 64-bit, glibc 2.17+, 64-bit only',
            // Pummel Party
            'Windows 7',
            // Beat Saber
            'Windows 7/8.1/10 (64bit)',
            // Escape Simulator
            'Windows 7 (SP1+), macOS High Sierra 10.13+, Linux <3'
        ];

        $game_memory = [
            // stardew
            '2 GB RAM',
            // cuphead
            '4 GB RAM',
            // terraria
            '2.5 GB RAM',
            // hades
            '4 GB RAM',
            // the binding of isaac
            '8 GB RAM',
            // undertale
            '2 GB RAM',
            // celeste
            '2 GB RAM',
            // totally accurate battle simulator
            '8 GB RAM',
            // dead cells
            '2 GB RAM',
            // hollow knight
            '4 GB RAM',
            // Stray
            '8 GB RAM',
            // teardown
            '4 GB RAM',
            // overcooked 2
            '4 GB RAM',
            // wartales
            '4 GB RAM',
            // raft
            '8 GB RAM',
            // muse dash
            '4 GB RAM',
            // TMNT
            '4 GB RAM',
            // Pummel Party
            '3 GB RAM',
            // Beat Saber
            '8 GB RAM',
            // Escape Simulator
            '2 GB RAM',
        ];

        $game_graphics = [
            // stardew
            '256 MB Video Memory',
            // cuphead
            'Intel HD Graphics 4000 or higher (requires Metal)',
            // terraria
            '128 MB Video Memory, capable of Shader Model 2.0+',
            // hades
            'Intel HD 5000 (must support Metal API)',
            // the binding of isaac
            'Intel HD Graphics 4000 and higher, ATI Radeon HD-Series 4650 and higher, Nvidia GeForce 2xx-Series and up',
            // undertale
            '128MB',
            // celeste
            'Intel HD 4000',
            // totally accurate battle simulator
            'NVIDIA GeForce GTX 670 or AMD R9 270 (2GB VRAM with Shader Model 5.0 or better)',
            // dead cells
            'Nvidia 450 GTS / Radeon HD 5750 or better',
            // hollow knight
            'GeForce 9800GTX+ (1GB)',
            // Stray
            'NVIDIA GeForce GTX 780, 3 GB | AMD Radeon R9 290X, 4 GB',
            // teardown
            'NVIDIA GeForce GTX 1080 or similar. 8 Gb VRAM.',
            // overcooked 2
            'Nvidia GeForce GTX 650 / Radeon HD 7510',
            // wartales
            'GeForce GTX 950',
            // raft
            'GeForce GTX 1050 series or similar',
            // muse dash
            'Intel® HD Graphics or better',
            // TMNT
            'Vulkan support, 2GB VRAM',
            // Pummel Party
            'GeForce 8800 GT / AMD HD 6850 / Intel HD Graphics 4400 or above',
            // Beat Saber
            'Nvidia GTX 1060 or equivalent',
            // Escape Simulator
            'OpenGL 3.2+ or Vulkan-capable GPU',
        ];

        $game_storage = [
            // stardew
            '500 MB',
            // cuphead
            '4 GB',
            // terraria
            '200 MB',
            // hades
            '15 GB',
            // the binding of isaac
            '449 MB',
            // undertale
            '200 MB',
            // celeste
            '1200 MB',
            // totally accurate battle simulator
            '4 GB',
            // dead cells
            '500 MB',
            // hollow knight
            '9 GB',
            // Stray
            '10 GB',
            // teardown
            '4 GB',
            // overcooked 2
            '3 GB',
            // wartales
            '10 GB',
            // raft
            '10 GB',
            // muse dash
            '1 GB',
            // TMNT
            '2 GB',
            // Pummel Party
            '1 GB',
            // Beat Saber
            '200 MB',
            // Escape Simulator
            '14 GB',
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
                'status' => 'published',
                'admin_note' => null,
            ]);
        }

        for ($i = 11; $i <= 20; $i++) {
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
                'status' => 'pending',
                'admin_note' => null,
            ]);
        }

        // Array buat game review
        $game_rating = [
            // stardew
            5,
            // cuphead
            4,
            // terraria
            5,
            // hades
            5,
            // the binding of isaac
            4,
            // undertale
            4,
            // celeste
            4,
            // totally accurate battle simulator
            4,
            // dead cells
            5,
            // hollow knight
            5,
            // Stray
            5,
            // teardown
            5,
            // overcooked 2
            5,
            // wartales
            5,
            // raft
            5,
            // muse dash
            5,
            // TMNT
            5,
            // Pummel Party
            5,
            // Beat Saber
            5,
            // Escape Simulator
            5,
        ];

        $game_comment = [
            // stardew
            'Stardew valley is a really amazing game, it is very fun and the graphics are so good, I love it!. The gameplay isn\'t boring and the gameplay is very intuitive, hence making it a really easy and great gasme to play. I recommend this game to all of you who want to play this game.',
            // cuphead
            'Cuphead is an amazing game, but there are some things that doesn\'t feel right to me. Personally, I like games that are very retro and pixelated, so Cuphead\'s visuals ain\'t my cup of tea. Nevertheless, it is still a great game, you guys should give this game a try.',
            // terraria
            'Terraria is an amazing game!!! I had lots of fun and amazing memories with this game. Terraria is really fun when you play it with friends, the game itself isn\' very grindy and the death in this game isn\'t very taxing, making it a really beginner-friendly game. I would recommend this game to you guys that are searching for a new game to play with your friends.',
            // hades
            'Oh boy, what can I say more man, the awards speak for itself. The game of the year, amazing graphics, gameplay, and soundtracks, man what more can u ask from a game. I really like the theme of this game and the gameplay is just mesmerizing to top it off, the graphics are just \'wow\'. You guys should definitely download this game ASAP, the price is so-so-so worth it man.',
            // the binding of isaac
            'The binding of isaac is a really amazing game, but the graphics are too eerie for me as it gross me out frequently. Other than the graphics there are no real downside to buying this game, the gameplay is fun and the story is rich but beware this game causes real trouble for you if you play it alone.',
            // undertale
            'Undertale is an amazing game, but there are times where I feel like I want to quit because how frustrating it is. I feel like I hit the deadend so many times in this game, but I prevailed and I am able to finish this game. This is one of the classics of gaming, and I would really recommend this game to all of you that are in for a challenge',
            // celeste
            'Celeste is an okay game, it is fun at first, but the longer you play the fun get reduced and the storyline is very taxing mentally for casuals. I would recommend this game to you guys that are hardcore gamers to the core.',
            // totally accurate battle simulator
            'TABS is a really fun game but the graphics are really taxing to my GPU card. I had too much fun in simulating battles that are too much for my GPU to handle, but there are still a lot of game breaking bugs that exists. I would recommend this game to you guys that loves to have fun and laugh on absurd things.',
            // dead cells
            'Dead cells is really fund to play, I had a blast and I would recommend this game to all of you reading this comment. At first  I was skeptical, but I decided to download this game nonetheless and it turned out to be one of the best decisions that I have ever made.',
            // hollow knight
            'Hollow knight is a really fun game, the game itself is visually pleasing and rich in story, making it one of my favorite games right away. Personally, I like the design and backstory of the main character and its depth, making him a really intriguing but confusing character. The twist and the turns of the story is just perfect, no over dramatization or over-the-top stuff.',
            // Stray
            'Stray is a really fun game, the game itself is visually pleasing and rich in story, making it one of my favorite games right away. Personally, I like the design and backstory of the main character and its depth, making him a really intriguing but confusing character. The twist and the turns of the story is just perfect, no over dramatization or over-the-top stuff.',
            // teardown
            'If you enjoy and crave dynamic destructible environments, fire and exquisite physics, awesome driving and shooting, then you\'ll put 100\'s of hours into Teardown and enjoy every moment. What this actually is, is the worlds most elaborate puzzle game, and I\'m here for it, but, if your not feeling a challenge, enjoying the levels youve unlocked in sandbox or seeing what wizardry the modding community has come up with this week, will keep you coming back!',
            // overcooked 2
            'It\'s one of those games where you have to play with at least one other person as you will be yelling/crying to "throw the dang meat" or to "get out of the way" to get to the rice that is about to burn. This game is one like monopoly, a relationship tester. This game is really fun with more people because of the anxiety-producing chaos.',
            // wartales
            'What to say for a game that has sucked me in like the days of the original X-Com, Jagged Alliance, and Panzer General... there is so much to this game that it unwinds like a good book with unexpected turns around every corner. The different skills that players acquire as they advance in rank complement each other tremendously (for example my two war ponies have become more of a logistics troop as I use them to enhance surrounding players\' movement...or the spearman who positions himself next to three allies in a crowded scrum and counterstrikes LIKE A BOSS!) I love everything about this game...the developers clearly listen to feedback, regularly post updates, and have a deep passion and love for the project they created. I have never "followed" a publisher on steam...I do now. Congratulations to the designers and publishers on a job very well done.',
            // raft
            'This game captures a lot of great parts for what it\'s trying to be and It\'s an early access done right. They had a vision for what they wanted the game to become, we got content, a story and best of all a fun experience. There is both chill building and tense diving moments with exploration in-between. My only negative factor would be a single small glitch and an annoying enemy but otherwise a really great game.',
            // muse dash
            'I absolutely love rhythm games! I played a lot of Guitar Hero, Rocksmith, Melody\'s Escape, etc. My first one and the most favorite is probably Guitar Hero III: Legends of Rock. I used to play it every evening when I was a teen and spent tons of hours playing it. When I stumbled across Muse Dash, I didn\'t expect a lot. In fact, I didn\'t even check out which kind of music is in the game. I really liked the colorful art style, so I just bought it. The price was cheep anyway.',
            // TMNT
            'Having grown up watching the TMNT cartoon in the late 1980s and early 1990s, and played the arcade game and its console version on the NES, I\'m definitely the target audience of Shredder\'s Revenge. Thankfully, the game does a good job in stirring up happy childhood memories, and features quality of life improvements that befit gamers my age.',
            // Pummel Party
            'Never in my life, have I harboured deeper hatred and anger towards my friends than in this game.
            Never in my life, have I experienced the "gamer rage" as fierce and raw, than in this game.
            Never in my life, have I wanted to scream at the top of my lungs towards my friends, how much of an annoying **** they are while playing this game.',
            // Beat Saber
            'this game is really cool. you can slice and dodge to your hearts content because there is no end to this game. when you beat every song, you can mod the game too! Last week I stole a katana from a museum and sliced my boss in half and it was just like beat saber! then i chopped him to little bits (like the boxes in beatsaber) and stored him in my freezer!',
            // Escape Simulator
            'this game never fails to remind me how incredibly dumb I am. It\'s a lot of fun but if you have **** for brains these rooms will definitely take you a while. either I didn\'t win the lottery when it came to the intelligent side of the gene pool or Pine studios went a little overboard making these rooms...spoiler alert probably a bit of both. It\'s a fun game nonetheless, but I\'d definitely recommend playing the core game with friends. personally I have more fun playing community made rooms. They\'re still a challenge, but there\'s just so much packed in the core levels I don\'t know how anyone beats those levels in 15 minutes. The tutorial is literally NOTHING compared to the rest of the game which was rather disappointing because I was really looking forward to the levels and seeing what they had to offer, BUT if it was that easy the whole way through the game I suppose nobody would be buying the game now would they? Just beware every single level is pretty challenging IMO. Not gonna stop me from having fun though : D',
        ];

        // Array buat game donos
        $dono_payment_method = [
            // stardew valley
            'Bank Transfer',
            // cuphead
            'Paypal',
            // terraria
            'Paypal',
            // hades
            'Paypal',
            // the binding of isaac
            'Credit Card',
            // undertale
            'Bank Transfer',
            // celeste
            'Credit Card',
            // totally accurate battle simulator
            'Bank Transfer',
            // dead cells
            'Paypal',
            // hollow knight
            'Credit Card',
            // Stray
            'Credit Card',
            // teardown
            'Credit Card',
            // overcooked 2
            'Credit Card',
            // wartales
            'Bank Transfer',
            // raft
            'Credit Card',
            // muse dash
            'Credit Card',
            // TMNT
            'Paypal',
            // Pummel Party
            'Credit Card',
            // Beat Saber
            'Credit Card',
            // Escape Simulator
            'Paypal',
        ];

        $dono_amount = [
            // stardew valley
            2000000,
            // cuphead
            650000,
            // terraria
            440000,
            // hades
            6666000,
            // the binding of isaac
            690000,
            // undertale
            442000,
            // celeste
            142000,
            // totally accurate battle simulator
            50000,
            // dead cells
            90000,
            // hollow knight
            654321,
            // Stray
            400000,
            // teardown
            140000,
            // overcooked 2
            500000,
            // wartales
            350000,
            // raft
            240000,
            // muse dash
            250000,
            // TMNT
            450000,
            // Pummel Party
            300000,
            // Beat Saber
            550000,
            // Escape Simulator
            700000,
        ];

        $dono_msg = [
            // stardew valley
            'Very nice game, I really like it',
            // cuphead
            'I had fun thank you!',
            // terraria
            'U DA GOAT MY G',
            // hades
            'GOTY GOTY GOTY GOTY',
            // the binding of isaac
            'Nice work, keep it up!',
            // undertale
            'MEGALOVANIAMEGALOVANIAMEGALOVANIA',
            // celeste
            'WHYYYYYYYYYYYYYYYYYYYYY',
            // totally accurate battle simulator
            'HAHAHAHAHA ULOL ULOL ULOL',
            // dead cells
            'VERY NICE GAME MAKE MORE PLS',
            // hollow knight
            'BING CHILLING',
            // Stray
            'MEOW MEOW',
            // teardown
            'COOL COOL COOL',
            // overcooked 2
            'I LIKE IT',
            // wartales
            'I LIKE IT',
            // raft
            'CHILL CHILL',
            // muse dash
            'WATASHI VERY LIKE IT',
            // TMNT
            'NOSTALGIA',
            // Pummel Party
            'HAHAHAHA :DDDD',
            // Beat Saber
            'COOL GAME VERY GOOD',
            // Escape Simulator
            'MY BRAIN IS FRIED',
        ];

        for($i=1; $i<=10; $i++){
            Wishlist::create([
                'game_id' => $i,
                'user_id' => $i
                //$faker->numberBetween(1, 10),
            ]);

            GameLibrary::create([
                'game_id' => $i,
                'user_id' => $i
                //$faker->numberBetween(1, 10),
            ]);

            GameReview::create([
                'game_id' => $i,
                'user_id' => $i,
                'rating' => $game_rating[$i - 1],
                'comment' => $game_comment[$i - 1],
            ]);
    
            GamePayment::create([
                'game_id' => $faker->numberBetween(1, 10),
                'user_id' => $faker->numberBetween(1, 10),
                'payment_method' => $faker->randomElement(['paypal', 'credit_card', 'bank_transfer']),
                'amount' => $faker->numberBetween(10000, 1000000),
            ]);
    
            GameDonation::create([
                'game_id' => $i,
                'user_id' => $i,
                'payment_method' => $dono_payment_method[$i - 1],
                'amount' => $dono_amount[$i - 1],
                'message' => $dono_msg[$i - 1]
            ]);
        }

        for ($i = 1; $i <= 20; $i++) {
            TagDetail::create([
                'tag_id' => $faker->numberBetween(1, 3), //ini diganti tadinya 1-10
                'game_id' => $i,
            ]);
        }
    }
}
