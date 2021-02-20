<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\User;
use App\TestNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function users()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return response()->json($users, 200);
    }
    public function notify($id)
    {
        $testNotification = new TestNotification();
        $testNotification->user_id = $id;
        $testNotification->notification = 'Test';
        $testNotification->save();

        event(new TestEvent($testNotification));

        return response()->json($testNotification, 200);
    }
}