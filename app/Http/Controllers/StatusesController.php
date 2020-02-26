<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return StatusResource::collection(
            Status::orderBy('created_at', 'DESC')->get()
        );
    }

    public function store(){
        
        request()->validate(['body' => 'required|min:5']);

        $status = Status::create([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return StatusResource::make($status);
    }

}
