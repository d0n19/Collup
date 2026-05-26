<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function feed() { return view('newsfeed'); }
    public function jobs() { return view('jobs'); }
    public function workspace() { return view('workspace'); }
    public function friends() { return view('friends'); }
    public function profile() { return view('dashboard'); }
}
