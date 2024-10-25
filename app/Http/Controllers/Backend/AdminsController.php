<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;


class AdminsController extends Controller
{
    private $admin;

    public function __construct(Admin $admin){
        $this->middleware('auth:admin');
        $this->admin = $admin;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = $this->admin->query();

        $admins = $admins->get();
        return view('admin.user.index', compact('admins'))->with('title','Admins');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create')->with('title','Create Admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $this->admin->name      = $request->name;
        $this->admin->email     = $request->email;
        $this->admin->password  = bcrypt($request->password);
        $this->admin->save();

        return redirect()->route('admin-user.index')->with('success','Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = $this->admin->find($id);
        return view('admin.user.edit', compact('admin'))->with('title','Edit admin');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {
        $admin = $this->admin->find($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->has('password_change')){
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        return redirect()->route('admin-user.index')->with('success','Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = $this->admin->findOrFail($id);
        $admin->delete();
        return redirect()->route('admin-user.index')->with('success', 'Admin deleted successfully');
    }

    /**
     * Show soft deleted admins.
     */
    public function getSoftDeleted()
    {
        $admins = $this->admin->onlyTrashed()->get();
        return view('admin.user.trash', compact('admins'))->with('title','Soft Deleted Admins');
    }   


    /**
     * Restore the soft deleted admin.
     */
    public function restore($id)
    {
        $admin = $this->admin->withTrashed()->findOrFail($id);
        $admin->restore();
        return redirect()->route('admin-user.index')->with('success', 'Admin restored successfully');
    }


    /**
     * Permanently delete the soft deleted admin.
     */
    public function permanentDelete($id)
    {
        $this->admin->onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('admin-user.trash')->with('success','Admin permanently deleted');
    }

}
