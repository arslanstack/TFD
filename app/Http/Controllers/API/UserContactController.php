<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Validator;

class UserContactController extends Controller
{
    public function store(Request $request)
    {
        // return response()->json(['msg' => 'received', 'data' => $request->all()]);
        $data = $request->all();

        $validate = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['msg' => 'error', 'response' => $validate->errors()->first()]);
        }

        $inquiry = new Inquiry();
        $inquiry->name = $data['fname'] . ' ' . $data['lname'];
        $inquiry->company = $request->company ? $request->company : null;
        $inquiry->phone = $data['phone'];
        $inquiry->email = $data['email'];
        $inquiry->message = $data['message'];

        if ($inquiry->save()) {
            $company = $request->input('company') ? $request->input('company') : "N/A";
            $email = $request->input('email');
            $phone = $request->input('phone');
            $message = $request->input('message');
            $name = $request->input('fname') . ' ' . $request->input('lname');

            $headers = "From: webmaster@example.com\r\n";
            $headers .= "Reply-To: webmaster@example.com\r\n";
            $headers .= "Content-Type: text/html\r\n";
            $subject = 'New Inquiry Request from ' . $name;
            $emailTemplate = view('emails.inquiry', compact('name', 'company', 'email', 'phone', 'message'))->render();
            $verification = mail("calebjanaltair@gmail.com", $subject, $emailTemplate, $headers);
            if($verification) {
                return response()->json(['msg' => 'success', 'response' => 'Your inquiry has been submitted successfully.']);            
            } else {
                return response()->json(['msg' => 'error', 'response' => 'Something went wrong. Please try again.']);
            }
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Something went wrong. Please try again.']);
        }
    }
}
