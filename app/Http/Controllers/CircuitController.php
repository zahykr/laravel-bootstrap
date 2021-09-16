<?php

namespace App\Http\Controllers;

use App\Circuit;
use Illuminate\Http\Request;



class CircuitController extends Controller
{
  public function index()
    {
        if (request()->categorie) {
            $circuits = Circuit::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->categorie);
            })->orderBy('created_at', 'DESC')->paginate(6);
        } else {
            $circuits = Circuit::with('categories')->orderBy('created_at', 'DESC')->paginate(6);
        }

        return view('circuits.index')->with('circuits', $circuits);
    }


  public function show($slug) {
  
    $circuit = Circuit::where('slug', $slug)->firstOrFail();
    return view ('circuits.show')->with('circuit' , $circuit);
  }

  public function search(){

    request()->validate([
      'q' => 'required|min:3'
   ]);
    $q = request()->input('q');
    
    $circuits = Circuit::where('titre','like' ,"%$q%")->orWhere('description','like' ,"%$q%")->paginate(6);

    return view ('circuits.search')->with('circuits', $circuits);
  }
}
