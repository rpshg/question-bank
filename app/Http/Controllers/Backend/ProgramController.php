<?php

namespace App\Http\Controllers\Backend;

use App\Models\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    private $program;

    public function __construct(Program $program){
        $this->middleware('auth:admin');
        $this->program = $program;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = $this->program->query();
        $programs = $programs->get();
        return view('admin.program.index', compact('programs'))->with('title','Programs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program.create')->with('title','Create Program');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramRequest $request)
    {
        if($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('programs', 'public');
            $this->program->avatar = $avatar_path;
        }

        $this->program->name                    = $request->name;
        $this->program->slug                    = $request->slug;
        $this->program->status                  = $request->status;
        $this->program->description             = $request->description;
        $this->program->meta_description        = $request->meta_description;
        $this->program->meta_title              = $request->meta_title;
        $this->program->meta_keyword            = $request->meta_keyword;

        $this->program->save();

        return redirect()->route('program.index')->with('success','Program created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = $this->program->find($id);
        return view('admin.program.edit', compact('program'))->with('title','Edit program');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, string $id)
    {
        $program = $this->program->find($id);

        // update avatar
        if($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($program->avatar) {
                Storage::disk('public')->delete($program->avatar);
            }

            $avatar_path = $request->file('avatar')->store('programs', 'public');
            $program->avatar = $avatar_path;
        }

        $program->name                  = $request->name;
        $program->slug                  = $request->slug;
        $program->status                = $request->status;
        $program->description           = $request->description;
        $program->meta_description      = $request->meta_description;
        $program->meta_title            = $request->meta_title;
        $program->meta_keyword          = $request->meta_keyword;
        
        $program->save();

        return redirect()->route('program.index')->with('success','Program updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = $this->program->findOrFail($id);
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program deleted successfully');
    }


    /**
     * Show soft deleted programs.
     */
    public function getSoftDeleted()
    {
        $programs = $this->program->onlyTrashed()->get();
        return view('admin.program.trash', compact('programs'))->with('title','Soft Deleted Programs');
    }   


    /**
     * Restore the soft deleted admin.
     */
    public function restore($id)
    {
        $program = $this->program->withTrashed()->findOrFail($id);
        $program->restore();
        return redirect()->route('program.index')->with('success', 'Program restored successfully');
    }


    /**
     * Permanently delete the soft deleted admin.
     */
    public function permanentDelete($id)
    {
        $program = $this->program->onlyTrashed()->find($id)->forceDelete();

        if ($program->avatar) {
            Storage::disk('public')->delete($program->avatar);
        }

        $program->forceDelete();
        return redirect()->route('program.trash')->with('success','Program permanently deleted');
    }
}
