<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Level;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\Lesson\StoreLessonRequest;
use App\Http\Requests\Lesson\UpdateLessonRequest;


class LessonController extends Controller
{
    private $program;
    private $level;
    private $lesson;

    public function __construct(Program $program, Level $level, Lesson $lesson){
        $this->middleware('auth:admin');
        $this->program      = $program;
        $this->level        = $level;
        $this->lesson       = $lesson;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons        = $this->lesson->query();
        $lessons        = $lessons->get();
        return view('admin.lesson.index', compact('lessons'))->with('title','Lessons');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = $this->program->pluck('name','id');
        $levels = $this->level->pluck('name','id');
        $lesson = $this->lesson;
        return view('admin.lesson.create', compact('programs','levels','lesson'))->with('title','Create lesson');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        $this->lesson->program_id              = $request->program_id;
        $this->lesson->level_id                = $request->level_id;
        $this->lesson->name                    = $request->name;
        $this->lesson->slug                    = $request->slug;
        $this->lesson->status                  = $request->status;
        $this->lesson->no_of_mcqs              = $request->no_of_mcqs;
        $this->lesson->description             = $request->description;
        $this->lesson->meta_description        = $request->meta_description;
        $this->lesson->meta_title              = $request->meta_title;
        $this->lesson->meta_keyword            = $request->meta_keyword;
        $this->lesson->save();

        return redirect()->route('lesson.index')->with('success','Lesson created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programs = $this->program->pluck('name','id');
        $levels = $this->level->pluck('name','id');
        $lesson = $this->lesson->find($id);
        return view('admin.lesson.edit', compact('programs','levels','lesson'))->with('title','Edit lesson');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLessonRequest $request, string $id)
    {
        $lesson = $this->lesson->find($id);

        $lesson->program_id            = $request->program_id;
        $lesson->level_id              = $request->level_id;
        $lesson->name                  = $request->name;
        $lesson->slug                  = $request->slug;
        $lesson->status                = $request->status;
        $lesson->no_of_mcqs            = $request->no_of_mcqs;
        $lesson->description           = $request->description;
        $lesson->meta_description      = $request->meta_description;
        $lesson->meta_title            = $request->meta_title;
        $lesson->meta_keyword          = $request->meta_keyword;
        
        $lesson->save();

        return redirect()->route('lesson.index')->with('success','Lesson updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lesson = $this->lesson->findOrFail($id);
        $lesson->delete();
        return redirect()->route('lesson.index')->with('success', 'Lesson deleted successfully');
    }

    /**
     * Show soft deleted resource.
     */
    public function getSoftDeleted()
    {
        $lessons = $this->lesson->onlyTrashed()->get();
        return view('admin.lesson.trash', compact('lessons'))->with('title','Soft deleted lessons');
    }   


    /**
     * Restore the soft deleted resource.
     */
    public function restore($id)
    {
        $lesson = $this->lesson->withTrashed()->findOrFail($id);
        $lesson->restore();
        return redirect()->route('lesson.index')->with('success', 'Lesson restored successfully');
    }


    /**
     * Permanently delete the soft deleted resource.
     */
    public function permanentDelete($id)
    {
        $lesson = $this->lesson->onlyTrashed()->find($id);
        if ($lesson->avatar) {
            Storage::disk('public')->delete($lesson->avatar);
        }

        $lesson->forceDelete();
        return redirect()->route('lesson.trash')->with('success','Lesson permanently deleted');
    }
}
