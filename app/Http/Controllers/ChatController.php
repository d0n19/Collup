<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $rooms = ChatRoom::all();
        return view('chats.index', ['rooms' => $rooms]);
    }

    public function show($id)
    {
        $rooms = ChatRoom::all();
        $room = ChatRoom::findOrFail($id);
        $messages = $room->messages;
        return view('chats.show', compact('rooms', 'room', 'messages'));
    }

    public function storeRoom(Request $request)
    {
        ChatRoom::create(['name' => $request->name]);
        return redirect('/chats');
    }

    public function storeMessage(Request $request, $id)
    {
        Message::create([
            'chat_room_id' => $id,
            'content' => $request->content
        ]);
        return redirect('/chats/' . $id);
    }
    public function feed() { return view('newsfeed'); }
    public function jobs() { return view('jobs'); }
    public function workspace() { return view('workspace'); }
    public function friends() { return view('friends'); }
    public function profile() { return view('dashboard'); }
}