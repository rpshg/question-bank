@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ $title }}</h1>
                        </div>

                        <form class="user" method="POST" action="{{ route('admin-user.store') }}">
                            @csrf
                            @include('admin.user.form')
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Create
                            </button>
                            <hr>
                        </form>

                        

                       <!--  <div class="text-center">
                            <a class="small" href="">Forgot Password?</a>
                        </div> -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection