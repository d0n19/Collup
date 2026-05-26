<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;
use App\Models\ChatMessage;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function newsFeed()
    {
        
        $latestProjects = \App\Models\Project::with('owner')->latest()->take(5)->get();
        $newMembers = User::latest()->take(5)->get();
        return view('dashboard', compact('latestProjects', 'newMembers'));
    }

    public function friends()
    {
        $user = Auth::user();
        $friends = $user->friends;
        $pendingRequests = Friendship::where('friend_id', $user->id)
            ->where('status', 'pending')
            ->with('user')
            ->get();
        
        $allUsers = User::where('id', '!=', $user->id)
            ->whereDoesntHave('friendships', function($q) use ($user) {
                $q->where('friend_id', $user->id);
            })->take(10)->get();

        return view('social.friends', compact('friends', 'pendingRequests', 'allUsers'));
    }

    public function addFriend(User $user)
    {
        Friendship::firstOrCreate([
            'user_id' => Auth::id(),
            'friend_id' => $user->id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Friend request sent!');
    }

    public function acceptFriend(Friendship $friendship)
    {
        if ($friendship->friend_id !== Auth::id()) abort(403);
        
        $friendship->update(['status' => 'accepted']);
        
      
        Friendship::firstOrCreate([
            'user_id' => Auth::id(),
            'friend_id' => $friendship->user_id,
            'status' => 'accepted'
        ]);

        return back()->with('success', 'Friend request accepted!');
    }

    public function chat(User $user = null)
    {
        $friends = Auth::user()->friends;
        $activeChat = $user;
        $messages = [];

        if ($user) {
            $messages = ChatMessage::where(function($q) use ($user) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
            })->orWhere(function($q) use ($user) {
                $q->where('sender_id', $user->id())->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
        }

        return view('social.chat', compact('friends', 'activeChat', 'messages'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'sent', 'message' => $message]);
    }
}
