<?php

namespace App\Http\Controllers\admin;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\ResponseTrait;

class MailController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $rules = [];

        $rules['email'] = 'required|email';
        $rules['subject'] = 'required|string|max:200';
        $rules['message'] = 'required|string|max:255';
        $rules['name'] = 'required|string|max:50';

        $this->validate($request, $rules);
        $mailData = [
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'name' => $request->name
        ];

        Mail::to('ma4187418@gmail.com')->send(new DemoMail($mailData));

        // return redirect()->back();

        return $this->sendResponse(null, __('item_added'));
    }
}
