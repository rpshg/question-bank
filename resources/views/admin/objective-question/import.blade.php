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

                        <form class="user" method="POST" action="{{ route('import-objective-qn') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row my-4">
                                <div class="col-md-4">
                                    <div class="form-group my-4">
                                        <label for="program_id">Program</label>
                                        <select class="form-control form-select" name="program_id">
                                            <option selected disabled value="">Select Program</option>
                                            @foreach($programs as $key=>$program)
                                            <option value="{{ $key }}">
                                                {{ $program }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group my-4">
                                        <label for="level_id">Job level</label>
                                        <select class="form-control form-select" name="level_id">
                                            <option selected disabled value="">Select job level</option>
                                            @foreach($levels as $key=>$level)
                                            <option value="{{ $key }}">
                                                {{ $level }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group my-4">
                                        <label for="lesson_id">Lesson</label>
                                        <select class="form-control form-select" name="lesson_id">
                                            <option selected disabled value="">Select lesson</option>
                                            @foreach($lessons as $key=>$lesson)
                                            <option value="{{ $key }}">
                                                {{ $lesson }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Import questions</label>
                                <input class="form-control" type="file" name="import_file" id="formFile">
                            </div>

                            <button type="submit" class="btn btn-primary px-3 mt-3">
                                Import
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
