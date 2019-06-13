<?php

namespace Social\Http\Controllers;
use Auth;
use Social\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // $query = '';
        if(Auth::user()){
            $statuses = Status::notReply()->where(function($query)
            {
                return $query->where('user_id', Auth::user()->id)
                ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
            })->orderBy('created_at','desc')->paginate(2);
          
            return view('pages.home',compact('statuses'));
        }
        
        return view('pages.home');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home')->with('info', 'You were successfully logged out');
    }
}
