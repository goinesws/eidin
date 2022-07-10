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
            'name' => $faker->name,
            'role' => "admin",
            'profile_url' => $faker->imageUrl,
            'username' => 'admin12345',
            'email' => "admin@gmail.com",
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'country' => $faker->country,
            'name' => $faker->name,
            'role' => "user",
            'profile_url' => $faker->imageUrl,
            'username' => 'user42069',
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
            2
            // Stray
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            'Hollow Knight'
            // Stray
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            57999
            // Stray
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgi.png'
            // Stray
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            'https://www.youtube.com/embed/0GXyV9EvB_g'
            // Stray
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
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
            // teardown
            // overcooked 2
            // wartales
            // raft
            // muse dash
            // TMNT
            // Pummel Party
            // Beat Saber
            // Escape Simulator
        ];

        for ($i = 1; $i <= 5; $i++) {
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

        for ($i = 6; $i <= 10; $i++) {
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
                'status' => 'pending'
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
            5
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
            654321
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
        ];

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
    }
}
