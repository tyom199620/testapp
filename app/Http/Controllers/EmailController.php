<?php

namespace App\Http\Controllers;
use App\Http\Requests\EmailRequest;
use App\Models\EmailLog;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\LogMail;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(EmailRequest $request)
    {
        $exist_user = EmailLog::where('email', $request->email)->get();

        if (!$exist_user->isEmpty()) {

            $user_email = $request->email;

            Mail::to('your_receiver_email@gmail.com')->send(new LogMail());

            if (Mail::failures()) {

                return response()->json([
                    'message' => 'Sorry! Please try again latter',
                ]);

            }else{

                return response()->json([
                    'message' => 'Great! Successfully send in your mail',
                ]);

             }

        }else{

            $sql = array('name'  => $request->name,
                         'email' => $request->email,
                         'phone' => $request->phone,
                        );

            $create_data =  EmailLog::create($sql);

            Mail::to('your_receiver_email@gmail.com')->send(new LogMail());

            if (Mail::failures()) {

                return response()->json([
                    'message' => 'Sorry! Please try again latter',
                ]);

            }else{

                return response()->json([
                    'message' => 'Great! Successfully send in your mail',
                ]);

            }
        }

    }
}
