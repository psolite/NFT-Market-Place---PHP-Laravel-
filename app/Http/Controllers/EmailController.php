<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index () {
        $data['email'] = Email::get();
        return view('admin.email.index', $data);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $email = new Email();

        $email->description = request('desc');
        $email->subject = request('subject');
        $email->content = request('content');

        $email->save();

        return back()->with('msg', 'Successful');
    }

    public function update($id)
    {
        $email = Email::findOrFail($id);

        $email->subject = request('subject');
        $email->content = request('content');

        $email->save();

        return back()->with('msg', 'Successful');
    }
}
