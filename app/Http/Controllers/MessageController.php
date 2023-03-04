<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Create message
    public function create(Request $request, $reciever)
    {
        $res = User::find($reciever);

        if(!$res) {
            return response([
                'message' => 'Reciever not found'
            ], 401);
        }

        $fields = $request->validate([
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'message' => $fields['message'],
            'send_to' => $reciever
        ]);

        return response([
            'message' => 'Success'
        ]);

    }

    // View all user messages
    public function view(Request $request)
    {
        $id = $request->user()->id;

        return Message::all()->where('send_to',$id);
    }

}
