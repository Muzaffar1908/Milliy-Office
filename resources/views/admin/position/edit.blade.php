@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Positions Update</h5>
                <a href="{{route('po-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('po-update')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$position->id}}" />
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">User Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>Choose your username...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}" @if($user->id == $position->user_id) selected @endif>{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02" >Position Name uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="pos_name_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Position Title uz" required value="{{$position->pos_name_uz}}">
                                            <div class="invalid-feedback">
                                                Please enter a Position Name uz.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02" >Position Name ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="pos_name_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Position Title ru" required value="{{$position->pos_name_ru}}">
                                            <div class="invalid-feedback">
                                                Please enter a Position Name ru.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02" >Position Name en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="pos_name_en" class="form-control" id="validationCustom02"  placeholder="Enter is Position Title en" required value="{{$position->pos_name_en}}">
                                            <div class="invalid-feedback">
                                                Please enter a Position Name en.
                                            </div>
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