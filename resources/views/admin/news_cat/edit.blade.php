@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">News Category Update</h5>
                <a href="{{route('c-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('c-update', $news_cat->id)}}" method="POST" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                {{-- <label for="id"></label> --}}
                                <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$news_cat->id}}" />
                            </div>
                                
                            <div class="row">

                                <div class="col-sm-12">
                                    <label class="col-form-label" for="validationCustom01">Username
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <select name="user_id" id="single-select" class="form-control">
                                            <option value="" selected>Choose your username...</option>
                                            @foreach($users as $user)
                                              <option value="{{$user->id}}" @if($user->id==$news_cat->user_id) selected @endif>{{$user->user_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <br>
                            
                            <div class="row">

                                <div class="col-sm-4">
                                    <label class="col-form-label" for="validationCustom02">Title uz <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="title_uz" class="form-control" id="validationCustom02"  placeholder="Enter is Title uz" required value="{{$news_cat->title_uz}}">
                                        <div class="invalid-feedback">
                                            Please enter a Title uz.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label class="col-form-label" for="validationCustom02">Title ru <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="title_ru" class="form-control" id="validationCustom02"  placeholder="Enter is Title ru" required value="{{$news_cat->title_ru}}">
                                        <div class="invalid-feedback">
                                            Please enter a Title ru.
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="validationCustom02">Title en <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="title_en" class="form-control" id="validationCustom02"  placeholder="Enter is Title en" required value="{{$news_cat->title_en}}">
                                        <div class="invalid-feedback">
                                            Please enter a Title en.
                                        </div>
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

@endsection