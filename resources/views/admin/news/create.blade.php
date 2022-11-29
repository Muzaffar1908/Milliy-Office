@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">News Create</h5>
                <a href="{{route('n-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('n-store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" value="{{old('id')}}" />
                                        <input type="hidden" name="slug" value="{{ old('slug') }}">
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">User Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>Choose your username...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}">{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Category Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="cat_id" id="single-select" class="form-control">
                                                <option selected>Choose your news category name...</option>
                                                @foreach($news_cat as $cat)
                                                 <option value="{{$cat->id}}">{{$cat->title_uz}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Title uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="title_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Title uz" required value="{{old('title_uz')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title uz.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Title ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="title_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Title ru" required value="{{old('title_ru')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title ru.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Title en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="title_en" class="form-control" id="validationCustom02"  placeholder="Enter is Title en" required value="{{old('title_en')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title en.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">News Image <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="file" name="news_image" class="form-control" id="validationCustom02"  placeholder="Enter is Title en" required value="{{old('news_image')}}">
                                            <div class="invalid-feedback">
                                                Please enter a Title en.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Description uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="description_uz" id="textarea" cols="10" rows="5" >{{old('description_uz')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Description ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="description_ru" id="textarea" cols="10" rows="5" class="form-control">{{old('description_ru')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Description en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="description_en" id="textarea" cols="10" rows="5" class="form-control">{{old('description_en')}}</textarea>
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