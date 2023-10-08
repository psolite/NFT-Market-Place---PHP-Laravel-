<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MailUser;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use App\Models\Gateway;
use App\Models\History;
use App\Models\Mint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['totalnft'] = Mint::count();
        $data['totalnftlisted'] = Mint::where('is_listed', true)->count();
        $data['tdeposit'] = History::where('type', 'Deposit')->sum('amount');
        $data['tdepositpending'] = History::where('type', 'Deposit')->where('status', 'pending')->sum('amount');
        $data['history'] = History::orderBy('created_at', 'desc')->take(10)->get();
        return view('admin.index', $data);
    }

    public function users()
    {
        $data['users'] = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        })->orderBy('created_at', 'desc')->get();
        return view('admin.users', $data);
    }

    public function suspendUser($id)
    {

        $user = User::find($id);
        if ($user->status == 'Active') {
            $user->status = 'Suspended';
        } else {
            $user->status = 'Active';
        }
        $user->save();

        return back()->with('msg', 'Successful');
    }

    public function badge($id)
    {

        $user = User::find($id);
        if ($user->has_badge) {
            $user->has_badge = false;
        } else {
            $user->has_badge = true;
        }
        $user->save();

        return back()->with('msg', 'Successful');
    }

    public function gateway()
    {
        $data['gateway'] = Gateway::get();
        return view('admin.gateway', $data);
    }

    public function gatewaystatus($id)
    {
        $gateway = Gateway::findOrFail($id);

        if ($gateway->is_active) {
            $gateway->is_active = false;
        } else {
            $gateway->is_active = true;
        }
        $gateway->save();
        return back();
    }

    public function gatewayedit($id)
    {
        $gateway = Gateway::findOrFail($id);

        $gateway->wallet = request('wallet');
        $gateway->save();

        return back()->with('msg', 'Successfully Updated');
    }

    public function pendingDeposit()
    {

        $data['transaction'] = History::where('type', 'Deposit')->where('status', 'Pending')->orderBy('created_at', 'desc')->get();
        return view('admin.pending_deposit', $data);
    }

    public function completeDeposit($id)
    {
        $transaction = History::findOrFail($id);
        $balance = User::findOrFail($transaction->user_id);

        $balance->balance = $balance->balance + $transaction->amount;

        $transaction->status = 'Complete';

        $transaction->save();
        $balance->save();

        

        return back()->with('msg', 'Completed');
    }

    public function pugedDeposit($id)
    {
        $transaction = History::findOrFail($id);

        $transaction->status = 'Puged';

        $transaction->save();
        return back()->with('msg', 'Successfully Puged');
    }

    public function depositHistory()
    {

        $data['transaction'] = History::where('type', 'Deposit')->orderBy('created_at', 'desc')->get();
        return view('admin.deposit_history', $data);
    }

    public function mint()
    {

        return view('admin.mint');
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
        $mint->is_active = true;
        $mint->user_id = 1;
        $mint->sellcode = $code;

        $mint->save();

        return back()->with('msg', 'Mint Successful');
    }

    public function nfts()
    {
        $data['mint'] = Mint::whereNotBetween('id', [1, 6])->orderBy('created_at', 'desc')->get();

        return view('admin.nfts', $data);
    }

    public function mintApproval($id)
    {
        $mint = Mint::findOrFail($id);

        if ($mint->is_active) {
            $mint->is_active = false;
            $mint->save();
        } else {
            $mint->is_active = true;
            $mint->save();

            // user mail mint Approval done
            $data['nftname'] = $mint->nftname;
            $data['name'] = User::where('id', $mint->user_id)->first();
            $emailname = User::where('id', $mint->user_id)->first();
            $email = $emailname->email;
            $content = Email::where('description', 'User Mint Approval')->first();

            Mail::to($email)->send(new MailUser($content, $data));
        }


        return back();
    }

    public function editNFT($id)
    {
        $mint = Mint::findOrFail($id);
        $user = Auth::user()->id;
        // return request()->file('avatar');
        if (request()->has('file')) {
            $file = request()->file('file');
            $fileName = 'NFT' . $user . $mint->sellcode . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('/images/');
            $file->move($filePath, $fileName);
        } else {

            $fileName =  $mint->file;
        }


        $mint->file = $fileName;
        $mint->nftname = request('nftname');
        $mint->author = request('author');
        $mint->category = request('category');
        $mint->price = request('price');
        $mint->desc = request('desc');
        $mint->is_active = $mint->is_active;
        $mint->user_id = $mint->user_id;

        $mint->save();

        return back()->with('msg', 'Updated Successfully');
    }

    //----------------------------------------------

    public function pendingWithdrawal()
    {

        $data['transaction'] = History::where('type', 'Withdrawal')->where('status', 'Pending')->orderBy('created_at', 'desc')->get();
        return view('admin.pending_withdrawal', $data);
    }

    public function completeWithdrawal($id)
    {

        $transaction = History::findOrFail($id);
        $balance = User::findOrFail($transaction->user_id);

        $balance->balance = $balance->balance - $transaction->amount;

        $transaction->status = 'Complete';

        $transaction->save();
        $balance->save();

       

        return back()->with('msg', 'Successful');
    }

    public function pugedWithdrawal($id)
    {
        $transaction = History::findOrFail($id);

        $transaction->status = 'Puged';

        $transaction->save();
        return back()->with('msg', 'Successfully Puged');
    }

    public function WithdrawalHistory()
    {

        $data['transaction'] = History::where('type', 'Withdrawal')->orderBy('created_at', 'desc')->get();
        return view('admin.withdrawal_history', $data);
    }
}
