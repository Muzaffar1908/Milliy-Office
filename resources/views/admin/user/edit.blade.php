@extends('admin.layout.index')

@section('style')
  {{-- <link href="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">     --}}
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Users Update</h5>
                <a href="{{route('u-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
            </div>

            <div class="mb-3 mb-lg-0">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-has-icon">
                            {{-- <div class="alert-icon">
                                <i class="far fa-lightbulb"></i>
                            </div> --}}
                            <div class="alert-body">
                                <div class="alert-title">Error!!!</div>
                                {{ session('warning') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <div class="card p-3">
                    <div class="form-validation">
                            <div class="basic-form">
                                <form action="{{route('u-update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$user->id}}" />
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-4">
                                            <label for="firstName" class="form-label">First name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First name..." value="{{$user->first_name}}" required>
                                            <div class="invalid-feedback">
                                                Valid first name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <label for="lastName"  class="form-label">Last name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last name..." value="{{$user->last_name}}" required>
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <label for="middleName"  class="form-label">Middle name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="middle_name" class="form-control" id="middleName" placeholder="Middle name..." value="{{$user->middle_name}}" required>
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>

                                    </div>
                                     <br>
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <label for="email"  class="form-label">Email <span
                                                class="text-muted">(Optional)</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="{{$user->email}}">
                                            <div class="invalid-feedback">
                                                Please enter a valid email address for shipping updates.
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="Phone"  class="form-label">Phone Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="phone" class="form-control" id="Phone" placeholder="Last name..." value="{{$user->phone}}" required>
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="username"  class="form-label">Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" name="user_name" class="form-control" id="username" placeholder="Username" required value="{{$user->user_name}}">
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    Your username is required.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <label class="col-form-label col-sm-3 pt-0">Gender</label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" @if ($user->gender == 1) checked @endif value="1">
                                                    <label class="form-check-label">
                                                        Erkak
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" @if ($user->gender == 2) checked @endif value="2">
                                                    <label class="form-check-label">
                                                        Ayol
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <label class="col-form-label" for="validationCustom01">User Image
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-file">
                                                <input type="file" name="user_image" class="form-file-input form-control">
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="m-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

{{-- <script src="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script> --}}

@endsection