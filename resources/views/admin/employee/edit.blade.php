@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Administration Create</h5>
                <a href="{{route('emp-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('emp-update')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$employee->id}}" />
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">User Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>Choose your username...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}" @if($user->id==$employee->user_id) selected @endif>{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Position Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="pos_id" id="single-select" class="form-control">
                                                <option selected>Choose your position name...</option>
                                                @foreach($positions as $pos)
                                                 <option value="{{$pos->id}}" @if($pos->id==$employee->pos_id) selected @endif>{{$pos->pos_name_uz}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Image <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <img src="{{asset('/upload/employee/' . $employee->user_image.'_thumbnail_550.png')}}" alt="img" with="100px" height="60px">
                                            <input type="file" name="user_image" class="form-control" id="validationCustom02"  placeholder="Image" required value="{{$employee->user_image}}">
                                            <div class="invalid-feedback">
                                                Please enter a Image.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Full Name uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="full_name_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Full Name uz" required value="{{$employee->full_name_uz}}">
                                            <div class="invalid-feedback">
                                                Please enter a Full Name uz.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Full Name ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="full_name_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Full Name ru" required value="{{$employee->full_name_ru}}">
                                            <div class="invalid-feedback">
                                                Please enter a Full Name ru.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Full Name en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="full_name_en" class="form-control" id="validationCustom02"  placeholder="Enter is Full Name en" required value="{{$employee->full_name_en}}">
                                            <div class="invalid-feedback">
                                                Please enter a Full Name en.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Email <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="email" name="email" class="form-control" id="validationCustom02"  placeholder="Enter is Email" required value="{{$employee->email}}">
                                            <div class="invalid-feedback">
                                                Please enter a Email.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Phone Number <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="phone" class="form-control" id="validationCustom02"  placeholder="Enter is Phone Number" required value="{{$employee->phone}}">
                                            <div class="invalid-feedback">
                                                Please enter a Phone Number.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02">Title uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="title_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Title uz" required value="{{$employee->title_uz}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title uz.
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02">Title ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="title_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Title ru" required value="{{$employee->title_ru}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title ru.
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02">Title en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="title_en" class="form-control" id="validationCustom02"  placeholder="Enter is Title en" required value="{{$employee->title_en}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title en.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <br>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Biography uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="biography_uz" id="textarea" cols="10" rows="5" >{{$employee->biography_uz}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Biography ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="biography_ru" id="textarea" cols="10" rows="5" >{{$employee->biography_ru}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Biography en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="biography_en" id="textarea" cols="10" rows="5" >{{$employee->biography_en}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Responsibilities uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="responsibilities_uz" id="textarea" cols="10" rows="5" >{{$employee->responsibilities_uz}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Responsibilities ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="responsibilities_ru" id="textarea" cols="10" rows="5" >{{$employee->responsibilities_ru}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Responsibilities en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="responsibilities_en" id="textarea" cols="10" rows="5" >{{$employee->responsibilities_en}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection