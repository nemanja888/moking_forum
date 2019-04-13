<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionReuest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionReuest $request)
    {
        Question::create($request->all());

        return Response('Created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return Question
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->fill($request->all());
        if ($question->isClean()) {
            return response('You have to specify different data', Response::HTTP_NOT_MODIFIED);
        }
        $question->update();
        return response('Questis has been updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
