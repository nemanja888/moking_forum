<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionReuest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Question;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
        $data = $request->all();
        $question = auth()->user()->questions()->create($data);

        return Response(new QuestionResource($question), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return QuestionResource
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
    public function update(UpdateQuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);

        $question->fill($request->all());
        if ($question->isClean()) {

            return response('You have to specify different data', Response::HTTP_NOT_MODIFIED);
        }
        $question = tap($question)->update();

        return response(new QuestionResource($question), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
