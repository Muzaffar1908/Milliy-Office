@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Divisions Create</h5>
                <a href="{{route('d-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('d-store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{old('id')}}" />
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom01">User Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>Choose your username...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}">{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02" >Divisions Name uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="dep_name_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Divisions Title uz" required value="{{old('dep_name_uz')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Divisions Name uz.
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02" >Divisions Name ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="dep_name_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Divisions Title ru" required value="{{old('dep_name_ru')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Divisions Name ru.
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02" >Divisions Name en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="dep_name_en" class="form-control" id="validationCustom02"  placeholder="Enter is Divisions Title en" required value="{{old('dep_name_en')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Divisions Name en.
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    
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