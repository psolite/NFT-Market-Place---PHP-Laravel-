<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\MailUser;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use App\Models\Gateway;
use App\Models\History;
use App\Models\Mint;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class UserDashsController extends Controller
{
    public function index()
    {

        $user = Auth::user()->id;
        $data['dhistory'] = History::where('user_id', $user)->get();
        $data['nftcount'] = Mint::where('user_id', $user)->where('is_active', true)->count();
        $data['pendingnftcount'] = Mint::where('user_id', $user)->where('is_active', false)->count();
        $data['pendingtransaction'] = History::where('user_id', $user)->where('status', 'Pending')->sum('amount');

        return view('user.index', $data);
    }

    public function deposit()
    {
        $data['gateway'] = Gateway::get();
        return view('user.deposit', $data);
    }


    public function depositform(Request $request)
    {


        $request->session()->put('amount', request('amount'));
        $request->session()->put('crypto', request('crypto'));


        return redirect('/user/confirmdeposit');
    }

    public function confirmDeposit(Request $request)
    {
        if ($request->session()->get('amount') == "") {
            return redirect('/user/deposit')->with('wmsg', 'Please enter the amount you want to deposit');
        } else {
            $data['gateway'] = Gateway::get();
            $data['amount'] = $request->session()->get('amount');
            $data['crypto'] = $request->session()->get('crypto');
            return view('user.confirmdeposit', $data);
        }
    }

    public function confirmDepositStore(Request $request)
    {

        $user = Auth::user()->id;
        $deposit = new History();

        $deposit->amount = $request->session()->get('amount');
        $deposit->crypto = $request->session()->get('crypto');
        $deposit->user_id = $user;
        $deposit->type = 'Deposit';
        $deposit->status = 'Pending';

        $deposit->save();

        // mail Done
        $email = Auth::user()->email;

        $data['amount'] = $request->session()->get('amount');
        $data['crypto'] = $request->session()->get('crypto');
        $data['name'] = Auth::user()->name;
        $content = Email::where('description', 'User Deposit Mail')->first();

        Mail::to($email)->send(new MailUser($content, $data));

        //Admin Deposit mail Done        
        $data['name'] = Auth::user()->name;
        $content = Email::where('description', 'Admin Deposit Notice')->first();
        $settings = Setting::where('id', 1)->first();

        Mail::to($settings->appemail)->send(new MailUser($content, $data));

        $request->session()->forget('amount');
        $request->session()->forget('crypto');
        return redirect('/user/deposit')->with('msg', 'Successful');
    }

    public function withdrawal()
    {
        $data['gateway'] = Gateway::get();
        return view('user.withdrawal', $data);
    }

    public function withdrawalform(Request $request)
    {
        $user = Auth::user()->id;
        $balance = Auth::user()->balance;
        $pendingwithdrawal = History::where('user_id', $user)->where('status', 'Pending')->where('type', 'Withdrawal')->sum('amount');
        $tbalance = request('amount') + $pendingwithdrawal;

        if ($tbalance <= $balance) {
            $withdrawal = new History();

            $withdrawal->user_id = $user;
            $withdrawal->amount = request('amount');
            $withdrawal->crypto = request('crypto');
            $withdrawal->wallet = request('wallet');

            $withdrawal->type = 'Withdrawal';
            $withdrawal->status = 'Pending';

            $withdrawal->save();

            // mail withdrawal done
            $data['amount'] = request('amount');
            $data['crypto'] = request('crypto');
            $data['name'] = Auth::user()->name;
            $email = Auth::user()->email;
            $content = Email::where('description', 'User Withdrawal Submission')->first();

            Mail::to($email)->send(new MailUser($content, $data));

            // Admin  mail
            $data['name'] = Auth::user()->name;
            $content = Email::where('description', 'Admin Withdrawal Notice')->first();
            $settings = Setting::where('id', 1)->first();

            Mail::to($settings->appemail)->send(new MailUser($content, $data));


            return back()->with('msg', 'Withdrawal Successful, if any delay contact customer care');
        } else {
            return back()->with('wmsg', 'Insufficient Fund');
        }
    }

    public function mint()
    {
        return view('user.mint');
    }

    public function myNFT()
    {
        $user = Auth::user()->id;
        $data['nft'] = Mint::where('user_id', $user)->orderBy('updated_at', 'desc')->get();
        return view('user.myNFT', $data);
    }

    public function history()
    {
        $user = Auth::user()->id;
        $data['dhistory'] = History::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('user.history', $data);
    }

    public function generateUniqueCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $random_string = '';
        for ($i = 0; $i < 5; $i++) {
            $random_string .= $characters[random_int(0, strlen($characters) - 1)];
        }

        $random_number = random_int(1000, 9999);
        $code = "NFT";

        $merged_code = '';
        $code_array = str_split($code . $random_number . $random_string);

        shuffle($code_array);

        foreach ($code_array as $char) {
            $merged_code .= $char;
        }

        do {
            $code = $merged_code;
        } while (Mint::where("sellcode", "=", $code)->first());

        return $code;
    }

    public function mintNFT()
    {
        $set = Setting::where('id', 1)->first();
        $balance = Auth::user()->balance;
        if ($balance < $set->mintprice) {

            return back()->with('wmsg', 'Fund Your Amount and try again');
        } else {
            $code = $this->generateUniqueCode();
            $user = Auth::user()->id;
            // return request()->file('avatar');
            if (request()->has('file')) {
                $file = request()->file('file');
                $fileName = 'NFT' . $user . $code . '.' . $file->getClientOriginalExtension();
                $filePath = public_path('/images/');
                $file->move($filePath, $fileName);
            }

            $mint = new Mint();

            $mint->file = $fileName;
            $mint->nftname = request('nftname');
            $mint->author = request('author');
            $mint->category = request('category');
            $mint->price = request('price');
            $mint->desc = request('desc');
            $mint->user_id = $user;
            $mint->sellcode = $code;

            $mint->save();


            // Admin mail mint done
            $data['name'] = Auth::user()->name;

            $content = Email::where('description', 'Admin Mint Notice')->first();;
            $settings = Setting::where('id', 1)->first();

            Mail::to($settings->appemail)->send(new MailUser($content, $data));

            return back()->with('msg', 'Minted Successfully wait for approval, if it last for 7 days without approval contact customer care, Thank you');
        }
    }

    public function buy($sellcode)
    {
        $balance = Auth::user()->balance;
        $user = Auth::user()->id;
        $nftprice =  Mint::where('sellcode', $sellcode)->first();

        if ($user == $nftprice->user_id) {
            return back()->with('wmsg', 'You are already the owner of this nft');
        } elseif (Auth::check() && $balance < $nftprice->price) {

            return back()->with('wmsg', 'Fund your account and try again');
        } else {

            $currentbalance = $balance - $nftprice->price;
            $userbalance = User::where('id', $user)->first();

            $userbalance->balance = $currentbalance;

            $userbalance->save();

            $buymint = Mint::where('sellcode', $sellcode)->first();

            // mail seller done
            $data['nftprice'] = $nftprice->price;
            $data['nftname'] = $nftprice->nftname;
            $data['name'] = User::where('id', $buymint->user_id)->first();
            $emailname = User::where('id', $buymint->user_id)->first();
            $email = $emailname->email;
            $content = Email::where('description', 'User Sell NFT')->first();

            Mail::to($email)->send(new MailUser($content, $data));

            //Admin NFT Sold
            $data['name'] = User::where('id', $buymint->user_id)->first();
            $data['name2'] = Auth::user()->email;
            $data['nftprice'] = $nftprice->price;
            $content = Email::where('description', 'Admin NFT Sold')->first();
            $settings = Setting::where('id', 1)->first();

            Mail::to($settings->appemail)->send(new MailUser($content, $data));


            $buymint->user_id = $user;
            $buymint->save();

            // mail buyer done
            $email = Auth::user()->email;

            $data['nftname'] = $nftprice->nftname;
            $data['name'] = Auth::user()->name;
            $content = Email::where('description', 'User Buy NFT')->first();

            Mail::to($email)->send(new MailUser($content, $data));

            return back()->with('msg', 'You are now the owner of this NFT');
        }
    }

    public function list($id)
    {
        $mint = Mint::where('id', $id)->first();
        if ($mint->is_listed) {
            $mint->is_listed = false;
        } else {
            $mint->is_listed = true;
        }
        $mint->save();

        return back();
    }

    public function updateNftPrice($id)
    {
        $mint = Mint::where('id', $id)->first();
        $mint->price = request('price');

        $mint->save();

        return back()->with('msg', 'Successful');
    }
}
