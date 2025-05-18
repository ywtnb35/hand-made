<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function form()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        //バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'email'=> 'required|email',
            'message' => 'required|max:1000',
        ]);

        //データベースに保存
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->route('contact.form')->with('success','お問い合わせを受け付けました。');
    }

    public function index()
    {
        //最新順で全件取得
        $contacts = \App\Models\Contact::latest()->get();

        //bladeに渡す
        return view('admin.contacts.index', compact('contacts'));
    }
}
