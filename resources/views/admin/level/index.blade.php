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
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Program</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @foreach($levels as $level)
                    <tr>
                        <td>{{ $level->name }}</td>
                        <td>{{ $level->program->name ?? '-' }}</td>
                        <td>{{ $level->status }}</td>
                        <td>
                            <a href="{{ route('level.edit',$level->id) }}" class="btn btn-info btn-circle">
                                <i class="fas fa-edit fa-circle"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal" data-title="delete this level" data-url="/admin/level/{{ $level->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    @if(!$levels->isEmpty())
                      @include('admin.components.delete-modal')
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection