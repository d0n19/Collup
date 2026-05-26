<?php
namespace App\Http\Controllers;
use App\Models\ChatRoom;

class CollabController extends Controller {
    private function getCommonData() {
        return ['rooms' => ChatRoom::all()];
    }

    public function index() { return view('chats', $this->getCommonData()); }
    public function feed() { return view('newsfeed', $this->getCommonData()); }
    public function jobs() { return view('jobs', $this->getCommonData()); }
    public function workspace() { return view('workspace', $this->getCommonData()); }
    public function friends() { return view('friends', $this->getCommonData()); }
    public function profile() { return view('dashboard', $this->getCommonData()); }
}