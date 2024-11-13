<?php

namespace App\Http\Controllers\Backend;

use App\Models\Level;
use App\Models\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\Level\StoreLevelRequest;
use App\Http\Requests\Level\UpdateLevelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LevelController extends Controller
{
    private $program;
    private $level;

    public function __construct(Program $program, Level $level){
        $this->middleware('auth:admin');
        $this->program = $program;
        $this->level = $level;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = $this->level->query();
        $levels = $levels->get();
        return view('admin.level.index', compact('levels'))->with('title','Job Levels');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = $this->program->pluck('name','id');
        $level = $this->level;
        return view('admin.level.create', compact('programs','level'))->with('title','Create job level');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request)
    {
        if($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('levels', 'public');
            $this->level->avatar = $avatar_path;
        }

        $this->level->program_id              = $request->program_id;
        $this->level->name                    = $request->name;
        $this->level->slug                    = $request->slug;
        $this->level->status                  = $request->status;
        $this->level->description             = $request->description;
        $this->level->meta_description        = $request->meta_description;
        $this->level->meta_title              = $request->meta_title;
        $this->level->meta_keyword            = $request->meta_keyword;

        $this->level->save();

        return redirect()->route('level.index')->with('success','Level created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programs = $this->program->pluck('name','id');
        $level = $this->level->find($id);
        return view('admin.level.edit', compact('programs','level'))->with('title','Edit job level');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLevelRequest $request, string $id)
    {
        $level = $this->level->find($id);

        // update avatar
        if($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($level->avatar) {
                Storage::disk('public')->delete($level->avatar);
            }

            $avatar_path = $request->file('avatar')->store('levels', 'public');
            $level->avatar = $avatar_path;
        }

        $level->program_id            = $request->program_id;
        $level->name                  = $request->name;
        $level->slug                  = $request->slug;
        $level->status                = $request->status;
        $level->description           = $request->description;
        $level->meta_description      = $request->meta_description;
        $level->meta_title            = $request->meta_title;
        $level->meta_keyword          = $request->meta_keyword;
        
        $level->save();

        return redirect()->route('level.index')->with('success','Level updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $level = $this->level->findOrFail($id);
        $level->delete();
        return redirect()->route('level.index')->with('success', 'Level deleted successfully');
    }

    /**
     * Show soft deleted resource.
     */
    public function getSoftDeleted()
    {
        $levels = $this->level->onlyTrashed()->get();
        return view('admin.level.trash', compact('levels'))->with('title','Soft Deleted levels');
    }   


    /**
     * Restore the soft deleted resource.
     */
    public function restore($id)
    {
        $level = $this->level->withTrashed()->findOrFail($id);
        $level->restore();
        return redirect()->route('level.index')->with('success', 'Job Level restored successfully');
    }


    /**
     * Permanently delete the soft deleted resource.
     */
    public function permanentDelete($id)
    {
        $level = $this->level->onlyTrashed()->find($id);
        if ($level->avatar) {
            Storage::disk('public')->delete($level->avatar);
        }

        $level->forceDelete();
        return redirect()->route('level.trash')->with('success','Level permanently deleted');
    }
}
