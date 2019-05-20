<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
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
            'user_id' => auth()->id()
        ]);
        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }


    public function dislike(Reply $reply)
    {
        $reply->like()
              ->where('user_id', auth()->id())
              ->first()
              ->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();
    }
}
