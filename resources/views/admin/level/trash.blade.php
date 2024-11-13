@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 text-gray-800">{{ $title }}</h1>
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <a href="{{ route('level.create') }}" class="btn btn-success btn-circle ml-3">
            <i class="fas fa-plus"></i>
        </a>
        <a href="{{ route('level.trash') }}" class="btn btn-warning btn-circle ml-3">
            <i class="fas fa-exclamation-triangle"></i>
        </a>
    </div>
</div>

<!--Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form>
            <div class="input-group">
                <input type="text" class="form-control bg-light border-1" placeholder="Search level..."
                    aria-label="Search" aria-describedby="basic-addon2">
                
                <button type="submit" class="btn btn-success ml-5">
                    <span class="text">Search</span>
                </button>
            </div>
        </form>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
        	@if($levels->isEmpty())
	        	<small class="text text-lg text-danger">No records found !!</small>
        	@else
	            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                <thead>
	                    <tr>
	                        <th>Name</th>
	                        <th>Program</th>
	                        <th>Status</th>
	                        <th>Action</th>
	                    </tr>
	                </thead>
	                
	                <tbody>
	                    @foreach($levels as $level)
	                    <tr>
	                        <td>{{ $level->name }}</td>
	                        <td>{{ $level->program->name ?? '-' }}</td>
	                        <td>{{ $level->status }}</td>
	                        <td>
	                            <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-target="#restoreModal" data-title="restore this level" data-url="/admin/level/restore/{{ $level->id }}">
	                                <i class="fas fa-undo"></i>
	                            </a>
	                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal" data-title="permanently delete this level" data-url="/admin/level/remove/{{ $level->id }}">
	                                <i class="fas fa-trash"></i>
	                            </a>
	                        </td>
	                    </tr>
	                    @endforeach
	                    @include('admin.components.restore-modal')
	                    @include('admin.components.delete-modal')
	                </tbody>
	            </table>
            @endif
        </div>
    </div>
</div>

@endsection