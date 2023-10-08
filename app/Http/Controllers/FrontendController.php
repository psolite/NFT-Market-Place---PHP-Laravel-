<?php

namespace App\Http\Controllers;

use App\Models\Mint;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class FrontendController extends Controller
{
    public function index()
    {
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'user']);
        // $user = User::find(1);
        // $user->assignRole('admin');
        $data['user'] = User::get();
        $data['nft'] = Mint::where('is_active', true)->where('is_listed', true)->take(12)->get();
        $data['nftt'] = Mint::where('is_active', true)->where('is_listed', true)->orderBy('created_at', 'desc')->take(12)->get();
        $data['games'] = Mint::where('is_active', true)->where('category', 'games')->where('is_listed', true)->first();
        $data['music'] = Mint::where('is_active', true)->where('category', 'music')->where('is_listed', true)->first();
        $data['artwork'] = Mint::where('is_active', true)->where('category', 'artwork')->where('is_listed', true)->first();
        $data['photography'] = Mint::where('is_active', true)->where('category', 'photography')->where('is_listed', true)->first();
        $data['cryptocard'] = Mint::where('is_active', true)->where('category', 'crypto-card')->where('is_listed', true)->first();
        $data['others'] = Mint::where('is_active', true)->where('category', 'others')->where('is_listed', true)->first();

        // owners
        $set = Setting::where('id', 1)->first();

        $data['gamesowners'] = $set->gamesitemamount;
        $data['musicowners'] = $set->musicitemamount;
        $data['artworkowners'] = $set->artworkitemamount;
        $data['photographyowners'] = $set->photographyitemamount;
        $data['cryptocardowners'] = '545';
        $data['othersowners'] = $set->othersitemamount;

        return view('frontend.index', $data);
    }

    public function allnft() {
        $data['user'] = User::get();
        $data['nft'] = Mint::where('is_active', true)->where('is_listed', true)->simplePaginate(15);
        return view('frontend.all', $data);
    }



    public function nftDetails($sellcode)
    {
        $data['view'] = random_int(500, 9999);
        $data['nft'] = Mint::where('is_active', true)->where('is_listed', true)->get();
        $data['mint'] = Mint::where('sellcode', $sellcode)->first();
        return view('frontend.nft_details', $data);
    }

    public function category($id)
    {
        $data['user'] = User::get();
        
        $games = 'Immerse yourself in the exciting world of NFT gaming with our dedicated gaming category. Collect rare in-game items, virtual assets, and unique characters that can be used across various gaming platforms and decentralized applications. Experience the thrill of owning and trading valuable digital items that enhance your gaming experience, while also having the potential to appreciate in value over time.';
        $music = 'Unlock premium features, exclusive content, and exciting perks by becoming a member of our NFT platform. Collect membership NFTs that grant you access to music communities, events, and collaborations. Enjoy early access to new releases, discounts on purchases, and the ability to connect with like-minded collectors and creators in an exclusive environment';
        $artwork = 'mmerse yourself in the world of digital art with our NFT platforms dedicated art category. Discover and collect one-of-a-kind digital artworks created by talented artists from around the globe. From stunning paintings and sculptures to mesmerizing animations and immersive installations, experience the limitless possibilities of digital creativity.';
        $photography = 'Discover the power of visual storytelling through the captivating medium of digital photography. Browse our photography category to explore breathtaking landscapes, intimate portraits, striking still life compositions, and thought-provoking documentary series. Each photograph is meticulously captured and curated by talented photographers, ensuring a collection of truly unique and immersive visual experiences.';
        $cryptocard = 'Customize your online presence with exclusive and eye-catching Crypto Card  NFTs. Express your personality and individuality through a diverse selection of unique avatar designs, digital portraits, and animated characters. Stand out from the crowd and elevate your online identity with limited-edition Crypto Card on our platform';
        $others = 'Explore a vibrant digital marketplace where creators and collectors come together to buy, sell, and trade unique NFTs. Discover a wide range of digital assets, including art, collectibles, music, videos, and more, all authenticated on the blockchain for proven ownership and rarity.';
        if ($id == 'games') {
            $data['desc'] = $games;
        }
        if ($id == 'music') {
            $data['desc'] = $music;
        }
        if ($id == 'artwork') {
            $data['desc'] = $artwork;
        }
        if ($id == 'photography') {
            $data['desc'] = $photography;
        }
        if ($id == 'crypto-card') {
            $data['desc'] = $cryptocard;
        }
        if ($id == 'others') {
            $data['desc'] = $others;
        }

        // owners
        $set = Setting::where('id', 1)->first();
        if ($id == 'games') {
            $data['owners'] = $set->gamesitemamount;
        }
        if ($id == 'music') {
            $data['owners'] = $set->musicitemamount;
        }
        if ($id == 'artwork') {
            $data['owners'] = $set->artworkitemamount;
        }
        if ($id == 'photography') {
            $data['owners'] = $set->photographyitemamount;
        }
        if ($id == 'crypto-card') {
            $data['owners'] = 545;
        }
        if ($id == 'others') {
            $data['owners'] = $set->othersitemamount;
        }

        // volume
        if ($id == 'games') {
            $data['volume'] = '3,567';
        }
        if ($id == 'music') {
            $data['volume'] = '5,632';
        }
        if ($id == 'artwork') {
            $data['volume'] = '3,674';
        }
        if ($id == 'photography') {
            $data['volume'] = '2,789';
        }
        if ($id == 'crypto-card') {
            $data['volume'] = '12,466';
        }
        if ($id == 'others') {
            $data['volume'] = '845';
        }

        $data['listed'] =  random_int(20, 60);
        $data['uowners'] =  random_int(9, 30);

        $data['main'] = Mint::where('is_active', true)->where('category', $id)->where('is_listed', true)->first();
        $data['nft'] = Mint::where('is_active', true)->where('category', $id)->where('is_listed', true)->simplePaginate(10);
        $counted = Mint::where('is_active', true)->where('category', $id)->where('is_listed', true)->count();
        $data['count'] = $counted + 326;

        return view('frontend.category', $data);
    }

    public function pages ($slug) {
        $data['page'] = Page::where('slug', $slug)->first();

        return view('frontend.pages', $data);
    }

    

    // --------------------------------------------
    public function userRole()
    {

        if (Auth::check() && Auth::user()->roles->pluck('name')[0] == 'admin') {
            return redirect('/admin');
        }
        return redirect('/user');
    }
}
