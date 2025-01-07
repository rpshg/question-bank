<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Program;
use App\Models\Level;
use App\Models\Lesson;
use App\Models\ObjectiveQuestion;
use Illuminate\Http\Request;
use App\Http\Requests\ObjectiveQuestion\StoreObjectiveQuestionRequest;
use App\Http\Requests\ObjectiveQuestion\UpdateObjectiveQuestionRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ObjectiveQuestionController extends Controller
{
    private $program;
    private $level;
    private $lesson;
    private $question;

    public function __construct(Program $program, Level $level, Lesson $lesson, ObjectiveQuestion $question)
    {
        $this->middleware('auth:admin');
        $this->program      = $program;
        $this->level        = $level;
        $this->lesson       = $lesson;
        $this->question     = $question;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions        = $this->question->query();
        $questions        = $questions->get();
        return view('admin.objective-question.index', compact('questions'))->with('title', 'Objective questions');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = $this->program->pluck('name', 'id');
        $levels = $this->level->pluck('name', 'id');
        $lessons = $this->lesson->pluck('name', 'id');
        $question = $this->question;
        return view('admin.objective-question.create', compact('programs', 'levels', 'lessons', 'question'))->with('title', 'Create objective question');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObjectiveQuestionRequest $request)
    {
        $this->question->program_id               = $request->program_id;
        $this->question->level_id                 = $request->level_id;
        $this->question->lesson_id                = $request->lesson_id;
        $this->question->status                   = $request->status;
        $this->question->question                 = $request->question;
        $this->question->correct_answer           = $request->correct_answer;
        $this->question->option_1                 = $request->option_1;
        $this->question->option_2                 = $request->option_2;
        $this->question->option_3                 = $request->option_3;
        $this->question->option_4                 = $request->option_4;
        $this->question->option_5                 = $request->option_5;
        $this->question->option_6                 = $request->option_6;
        $this->question->explanation              = $request->explanation;
        $this->question->save();

        return redirect()->route('obj-question.index')->with('success', 'Objective question created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programs = $this->program->pluck('name', 'id');
        $levels = $this->level->pluck('name', 'id');
        $lessons = $this->lesson->pluck('name', 'id');
        $question = $this->question->find($id);
        return view('admin.objective-question.edit', compact('programs', 'levels', 'lessons', 'question'))->with('title', 'Edit objective question');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObjectiveQuestionRequest $request, string $id)
    {
        $question = $this->question->find($id);

        $question->program_id            = $request->program_id;
        $question->level_id              = $request->level_id;
        $question->lesson_id             = $request->lesson_id;
        $question->status                = $request->status;
        $question->question              = $request->question;
        $question->correct_answer        = $request->correct_answer;
        $question->option_1              = $request->option_1;
        $question->option_2              = $request->option_2;
        $question->option_3              = $request->option_3;
        $question->option_4              = $request->option_4;
        $question->option_5              = $request->option_5;
        $question->option_6              = $request->option_6;
        $question->explanation           = $request->explanation;

        $question->save();

        return redirect()->route('obj-question.index')->with('success', 'Objective question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = $this->question->findOrFail($id);
        $question->delete();
        return redirect()->route('obj-question.index')->with('success', 'Objective question deleted successfully');
    }


    /**
     * Show soft deleted resource.
     */
    public function getSoftDeleted()
    {
        $questions = $this->question->onlyTrashed()->get();
        return view('admin.objective-question.trash', compact('questions'))->with('title', 'Soft deleted objective questions');
    }


    /**
     * Restore the soft deleted resource.
     */
    public function restore($id)
    {
        $question = $this->question->withTrashed()->findOrFail($id);
        $question->restore();
        return redirect()->route('obj-question.index')->with('success', 'Objective question restored successfully');
    }


    /**
     * Permanently delete the soft deleted resource.
     */
    public function permanentDelete($id)
    {
        $question = $this->question->onlyTrashed()->find($id);
        $question->forceDelete();
        return redirect()->route('obj-question.trash')->with('success', 'Objective question permanently deleted');
    }

    /**
     * Show import page.
     */
    public function import()
    {
        $programs = $this->program->pluck('name', 'id');
        $levels = $this->level->pluck('name', 'id');
        $lessons = $this->lesson->pluck('name', 'id');
        return view('admin.objective-question.import', compact('programs', 'levels', 'lessons'))->with('title', 'Import objective questions(excel)');
    }

    /**
     * Post import data to database
     */
    public function importObjectiveQuestion(Request $request)
    {
        $program_id                 = intval($request->program_id);
        $level_id                   = intval($request->level_id);
        $lesson_id                  = intval($request->lesson_id);

        $file = $request->file('file');
        (new FastExcel)->import($file, function ($row) use ($program_id, $level_id, $lesson_id) {
            $validStatus = ['APPROVED', 'PENDING', 'DISAPPROVED'];
            return $this->question::create([
                'program_id'                    => $program_id,
                'level_id'                      => $level_id,
                'lesson_id'                     => $lesson_id,
                'question'                      => $row['question'],
                'correct_answer'                => $row['correct_answer'],
                'option_1'                      => $row['option_1'],
                'option_2'                      => $row['option_2'],
                'option_3'                      => $row['option_3'],
                'option_4'                      => $row['option_4'],
                'option_5'                      => $row['option_5'],
                'option_6'                      => $row['option_6'],
                'explanation'                   => $row['explanation'],
                'status'                        => in_array($row['status'], $validStatus) ? $row['status'] : 'PENDING', // Default to 'PENDING' if invalid
            ]);
        });

        return back()->with('success', 'Objective questions imported successfully!');
    }
}
