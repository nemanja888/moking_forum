<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function like(Reply $reply)
    {
        $reply->like()->create([
            'user_id' => '1'
//            'user_id' => auth()->id
        ]);
    }


    public function dislike(Reply $reply)
    {
        $reply->like()
              ->where('user_id', auth()->id)
              ->first()
              ->delete();
    }
}
