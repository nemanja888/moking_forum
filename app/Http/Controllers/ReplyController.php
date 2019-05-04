<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Question;
use App\Reply;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Question $question
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param StoreReplyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, StoreReplyRequest $request)
    {
        $reply = new ReplyResource($question->replies()->create($request->all()));

        return response(['reply' => $reply], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @param \App\Reply $reply
     * @return ReplyResource
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, UpdateReplyRequest $request, Reply $reply)
    {
        if ($reply->user_id == Auth::user()->id) {
            $reply->body = $request->reply;

            if ($reply->isClean()) {

                return response('You have to specify different data', Response::HTTP_NOT_MODIFIED);
            }
            $reply = tap($reply)->update();

            return response(new ReplyResource($reply), Response::HTTP_ACCEPTED);
        }

        return response('You are not authorized to update this reply', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param \App\Reply $reply
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();

        return response( 'deleted', Response::HTTP_ACCEPTED);
    }
}
