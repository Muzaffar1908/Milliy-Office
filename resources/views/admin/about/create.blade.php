@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">About Create</h5>
                <a href="{{route('a-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('a-store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf

                            <div class="row">

                                <div class="mb-3">
                                    {{-- <label for="id"></label> --}}
                                    <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{old('id')}}" />
                                </div>

                                <div class="col-sm-12">
                                    <label class="col-form-label" for="validationCustom01">User Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <select name="user_id" id="single-select" class="form-control">
                                            <option selected>Choose your username...</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->user_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">About Title uz <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="about_title_uz" class="form-control" id="validationCustom02"  placeholder="Enter is About Title uz" required value="{{old('about_title_uz')}}">
                                        <div class="invalid-feedback">
                                            Please enter a About Title uz.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">About Title ru <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="about_title_ru" class="form-control" id="validationCustom02"  placeholder="Enter is About Title ru" required value="{{old('about_title_ru')}}">
                                        <div class="invalid-feedback">
                                            Please enter a About Title ru.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">About Title en <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="about_title_en" class="form-control" id="validationCustom02"  placeholder="Enter is About Title en" required value="{{old('about_title_en')}}">
                                        <div class="invalid-feedback">
                                            Please enter a About Title en.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">Section Number <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="number" name="section_number" class="form-control" id="validationCustom02"  placeholder="Enter is Section Number" required value="{{old('section_number')}}">
                                        <div class="invalid-feedback">
                                            Please enter a Section Number.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02" >Section Title uz <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="section_title_uz" class="form-control" id="validationCustom02"  placeholder="Enter is  Section Title uz" required value="{{old('section_title_uz')}}">
                                        <div class="invalid-feedback">
                                            Please enter a  Section Title uz.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02" >Section Title ru <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="section_title_ru" class="form-control" id="validationCustom02"  placeholder="Enter is  Section Title ru" required value="{{old('section_title_ru')}}">
                                        <div class="invalid-feedback">
                                            Please enter a  Section Title ru.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02" >Section Title en <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="section_title_en" class="form-control" id="validationCustom02"  placeholder="Enter is  Section Title en" required value="{{old('section_title_en')}}">
                                        <div class="invalid-feedback">
                                            Please enter a  Section Title en.
                                        </div>
                                    </div>
                                </div>

                            </div>
        
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection