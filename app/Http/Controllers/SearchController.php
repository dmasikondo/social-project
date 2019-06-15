<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\User;

class SearchController extends Controller
{
   public function getResults(Request $request)
   {          
   	$query = $request->input('query');
      $profiles = User::where(\DB::raw("CONCAT(first_name,' ', last_name)"), 'LIKE',"%{$query}%")
            ->orWhere('location','LIKE',"%{$query}%")
            ->orWhere('email', 'LIKE',"%{$query}%")
            ->get();       
   	if(!$query){
   		return redirect()->route('home');
   	}
   	return view('search.results', compact('query','profiles'));
   }

   
}
