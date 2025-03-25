<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option; // Add this
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options')->get(); // Eager load options
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'QuestionText' => 'required|string',
            'Category' => 'nullable|string',
            'options.*.OptionText' => 'required|string', // Validate options
        ]);

        $question = Question::create($request->only(['QuestionText', 'Category']));

        if ($request->has('options')) {
            foreach ($request->input('options') as $optionData) {
                $question->options()->create($optionData);
            }
        }

        return redirect()->route('questions.index')->with('success', 'Question added successfully.');
    }

    public function show(Question $question)
    {
        $question->load('options'); // Lazy load options if needed
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'QuestionText' => 'required|string',
            'Category' => 'nullable|string',
            'options.*.OptionText' => 'required|string', // Validate options
        ]);

        $question->update($request->only(['QuestionText', 'Category']));

        if ($request->has('options')) {
            // Sync options (more efficient for updates)
            $newOptions = '';
            foreach ($request->input('options') as $optionData) {
                $newOptions[$optionData['OptionID'] ?? null] = $optionData;
            }

            $question->options()->get()->each(function ($option) use ($newOptions) {
                if (isset($newOptions[$option->OptionID])) {
                    $option->update($newOptions[$option->OptionID]);
                    unset($newOptions[$option->OptionID]);
                } else {
                    $option->delete();
                }
            });

            foreach ($newOptions as $optionData) {
                $question->options()->create($optionData);
            }
        }

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}