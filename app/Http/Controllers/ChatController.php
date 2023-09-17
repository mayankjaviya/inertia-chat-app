<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $users = User::select(['id','name','last_online_at'])->where('id', '!=', auth()->id())->get()->toArray();

        $chats = Chat::where('msg_from', auth()->id())->orWhere('msg_to',auth()->id())->get();
        $chat = $chats->toArray();
        $authUser = auth()->user();
        $data = [
            'users' => $users,
            'chat' => $chat,
            'authUser' => $authUser,
        ];

        if(isset($input['msg_to'])){
            $user = User::where('name',$input['msg_to'])->first();
            $data['msg_to']  = $user->name;
            $input['msg_to']  = $user->id;
        }
        $data['visibleModal'] = false;
        if(isset($input['modal']) && $input['modal'] == 'chat-details-modal'){

            $totalMessageSent = $chats->where('msg_from', auth()->id())->where('msg_to', $input['msg_to'])->count();
            $totalMessageReceived = $chats->where('msg_from', $input['msg_to'])->where('msg_to', auth()->id())->count();
            $totalMessage = $totalMessageSent + $totalMessageReceived;
            $data['totalMessage'] = $totalMessage;
            $data['totalMessageSent'] = $totalMessageSent;
            $data['totalMessageReceived'] = $totalMessageReceived;
            $data['visibleModal'] = true;
        }

        if($request->header('X-Inertia')){
            return Inertia::render('chat',$data);
        }

        return view('Chat.index', $data);

    }

    public function store(Request $request){
        $request->validate([
            'msg_to' => 'required',
            'message' => 'required'
        ]);

        $input = $request->all();
        $user = User::find($input['msg_to']);
        $input['msg_from'] = auth()->id();
        Chat::create($input);

        return response()->json(['msg_to'=> $user->name,'message' => 'Message sent successfully']);

    }

    public function deleteChat(Request $request){
        $input = $request->all();
        $chat = Chat::where('msg_from',Auth::id())->where('id',$input['id'])->first();
        $chat->delete();

        return to_route('chat.index',['msg_to' => $input['msg_to']]);
    }
}
