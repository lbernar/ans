<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of answers.
     */
    public function index()
    {
        $answers = Answer::with('question')->get();
        return view('answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new answer.
     */
    public function create()
    {
        return view('answers.create');
    }

    /**
     * Store a newly created answer in storage.
     */
    public function store(StoreAnswerRequest $request)
    {
        Answer::create($request->validated());

        return redirect()->route('answers.index')
            ->with('success', 'Resposta cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified answer.
     */
    public function edit(Answer $answer)
    {
        return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified answer in storage.
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        $answer->update($request->validated());

        return redirect()->route('answers.index')
            ->with('success', 'Resposta atualizada com sucesso!');
    }

    /**
     * Remove the specified answer from storage.
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resposta deletada com sucesso!'
        ]);
    }
}

