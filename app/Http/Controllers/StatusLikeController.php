<?php

namespace App\Http\Controllers;

use App\Models\status;
use Illuminate\Http\Request;

class StatusLikeController extends Controller
{
    public function store(status $status){
        $status->like();
    }

    public function destroy(status $status){
        $status->unlike();
    }
}
