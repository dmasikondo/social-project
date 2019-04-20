<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\User;

class SearchController extends Controller
{
   public function getResults(Request $request)
   {
   	$query = $request->input('query');
   	if(!$query){
   		return redirect()->route('home');
   	}
   		$users = User::where(\DB::raw("CONCAT(first_name,' ', last_name)"), 'LIKE',"%{$query}%")
   				->orWhere('location','LIKE',"%{$query}%")
               ->orWhere('email', 'LIKE',"%{$query}%")
   				->get()->toArray();
   	return view('search.results', compact('users','query'));
   }

   
}
