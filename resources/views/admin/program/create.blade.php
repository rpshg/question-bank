@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ $title }}</h1>
                        </div>

                        <form class="user" method="POST" action="{{ route('program.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.program.form')
                            <button type="submit" class="btn btn-primary px-3">
                                Create
                            </button>
                            <hr>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection