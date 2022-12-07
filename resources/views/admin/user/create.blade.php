@extends('admin.layout.index')

@section('style')
  {{-- <link href="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">     --}}
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Foydalanuvchini yaratish</h5>
                <a href="{{route('u-index')}}"><button type="button" class="btn btn-primary">Orqaga</button></a>
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
                                <form action="{{route('u-store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{old('id')}}" />
                                    </div>
                                    
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <label for="firstName" class="form-label">Ismi
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First name..." value="{{old('first_name')}}" required>
                                            <div class="invalid-feedback">
                                                i.
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <label for="lastName"  class="form-label">Familiyasi
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last name..." value="{{old('last_name')}}" required>
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <label for="middleName"  class="form-label">Sharfi
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="middle_name" class="form-control" id="middleName" placeholder="Middle name..." value="{{old('middle_name')}}" required>
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>

                                    </div>
                                     <br>
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <label for="email"  class="form-label">Elektron pochta <span
                                                class="text-muted">(Optional)</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="{{old('email')}}">
                                            <div class="invalid-feedback">
                                               Iltimos, elektron pochta manzilini kiriting...
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="Phone"  class="form-label">Telefon raqam 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="phone" class="form-control" id="Phone" placeholder="Telefon raqam kiriting" value="{{old('phone')}}" required>
                                            <div class="invalid-feedback">
                                                Iltimos, telefon raqam kiriting.
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="username"  class="form-label">Foydalanuvchi
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" name="user_name" class="form-control" id="username" placeholder="Foydalanuvchi" required value="{{old('user_name')}}">
                                                <div class="invalid-feedback" style="width: 100%;">
                                                    Iltimos, Foydalanuvchini nomi kiriting.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <label class="col-form-label col-sm-3 pt-0">Jins</label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="1" checked>
                                                    <label class="form-check-label">
                                                        Erkak
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="2">
                                                    <label class="form-check-label">
                                                        Ayol
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <label class="col-form-label" for="validationCustom01">Foydalanuvchi rami
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-file">
                                                <input type="file" name="user_image" class="form-file-input form-control">
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <br>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <label for="Password" class="form-label">Parol 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password" name="password" class="form-control" id="Password" placeholder="Password..." value="{{old('password')}}" required>
                                            <div class="invalid-feedback">
                                                Iltimos, parol kiriting.
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="Password" class="form-label">Parol takroriy kiriting
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password" name="password_confirmation" class="form-control" id="Password" placeholder="Password Confirm..." value="{{old('password_confirmation')}}" required>
                                            <div class="invalid-feedback">
                                            Iltimos, parolni takroriy kiriting.
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="m-4">
                                        <button type="submit" class="btn btn-primary">Yuborish</button>
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