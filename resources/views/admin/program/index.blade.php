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
        <a href="{{ route('program.create') }}" class="btn btn-success btn-circle ml-3">
            <i class="fas fa-plus"></i>
        </a>
        <a href="{{ route('program.trash') }}" class="btn btn-warning btn-circle ml-3">
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
                    @foreach($programs as $program)
                    <tr>
                        <td>{{ $program->name }}</td>
                        <td>{{ $program->status }}</td>
                        <td>
                            <a href="{{ route('program.edit',$program->id) }}" class="btn btn-info btn-circle">
                                <i class="fas fa-edit fa-circle"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal" data-title="delete this program" data-url="/admin/program/{{ $program->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                   @endforeach

                   @if(!$programs->isEmpty())
                       @include('admin.components.delete-modal')
                   @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection