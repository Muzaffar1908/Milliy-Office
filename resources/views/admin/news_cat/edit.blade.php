@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Yangiliklar kategoriyasi o'zgartirish</h5>
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
                                    <label class="col-form-label" for="validationCustom01">Foydalanuvchi nomi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <select name="user_id" id="single-select" class="form-control">
                                            <option value="" selected>O'zingizga Foydalanuvchi nomi kiriting...</option>
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
                                    <label class="col-form-label" for="validationCustom02">Kategoriyasi nomi uz <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="category_name_uz" class="form-control" id="validationCustom02"  placeholder="Kategoriyasi uz" required value="{{$news_cat->category_name_uz}}">
                                        <div class="invalid-feedback">
                                            Iltimos, Kategoriyasi nomi kiriting uz.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label class="col-form-label" for="validationCustom02">Kategoriyasi nomi ru <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="category_name_ru" class="form-control" id="validationCustom02"  placeholder="Kategoriyasi ru" required value="{{$news_cat->category_name_ru}}">
                                        <div class="invalid-feedback">
                                            Iltimos, Kategoriyasi nomi kiriting ru.
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="validationCustom02">Kategoriyasi nomi en <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="category_name_en" class="form-control" id="validationCustom02"  placeholder="Kategoriyasi en" required value="{{$news_cat->category_name_en}}">
                                        <div class="invalid-feedback">
                                            Iltimos, Kategoriyasi nomi kiriting en.
                                        </div>
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

@endsection