@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Specialist Create</h5>
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
                        <form action="{{route('sp-update', $specialist->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$specialist->id}}" />
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom01">User Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>Choose your username...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}" @if($user->id == $specialist->user_id) selected @endif>{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02" >Specialist Name uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="spe_name_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Specialist Title uz" required value="{{$specialist->spe_name_uz}}">
                                            <div class="invalid-feedback">
                                                Please enter a Specialist Name uz.
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02" >Specialist Name ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="spe_name_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Specialist Title ru" required value="{{$specialist->spe_name_ru}}">
                                            <div class="invalid-feedback">
                                                Please enter a Specialist Name ru.
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-sm-12">
                                        <label class="col-form-label" for="validationCustom02" >Specialist Name en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <input type="text" name="spe_name_en" class="form-control" id="validationCustom02"  placeholder="Enter is Specialist Title en" required value="{{$specialist->spe_name_en}}">
                                            <div class="invalid-feedback">
                                                Please enter a Specialist Name en.
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