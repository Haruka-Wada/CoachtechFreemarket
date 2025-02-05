<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Information;
use App\Mail\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\MailRequest;

class MailableController extends Controller
{
    public function InformationMail() {
        return view('mail.information_index');
    }

    public function InformationSend(MailRequest $request) {
        $data = $request->all();
        $users = User::all();
        foreach($users as $user) {
            Mail::to($user)->send(new Information($data));
        }
        return back()->with('sent', '送信完了しました');
    }

    public function contactMail(Request $request) {
        $user = User::find($request->user_id);

        return view('mail.contact_index', compact('user'));
    }

    public function contactSend(MailRequest $request) {
        $data = $request->all();
        $user = User::find($request->user_id);

        Mail::to($user)->send(new Contact($data));

        return back()->with('sent', '送信完了しました');
    }
}
