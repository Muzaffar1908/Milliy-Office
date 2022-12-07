@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Bosh saxifani o'zgartirish</h5>
                <a href="{{route('m-index')}}"><button type="button" class="btn btn-primary">Orqaga</button></a>
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
                        <form action="{{route('m-update', $main->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$main->id}}" />
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">foydalanuvchi nomi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>O'zingizga foydalanuvchi nom tanlang...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}" @if($user->id == $main->user_id) selected @endif>{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Sarlavha uz  <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="title_uz" class="form-control" id="validationCustom02"  placeholder="Iltimos, sarlavha kiriting uz" required value="{{$main->title_uz}}">
                                            <div class="invalid-feedback">
                                                Iltimos, sarlavha kiriting uz.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Sarlavha uz  <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="title_ru" class="form-control" id="validationCustom02"  placeholder="Iltimos, sarlavha kiriting ru" required value="{{$main->title_ru}}">
                                            <div class="invalid-feedback">
                                                Iltimos, sarlavha kiriting ru.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Sarlavha uz  <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="title_en" class="form-control" id="validationCustom02"  placeholder="Iltimos, sarlavha kiriting en" required value="{{$main->title_en}}">
                                            <div class="invalid-feedback">
                                                Iltimos, sarlavha kiriting en.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Orqa fon rasm <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <img src="{{asset('/upload/main/' .$main->background_image.'_big_1920.png')}}" class="p-2" alt="img" with="100px" height="60px">
                                            <input type="file" name="background_image" class="form-control" id="validationCustom02"  placeholder="" required value="{{$main->background_image}}">
                                            <div class="invalid-feedback">
                                              Iltimos Orqa fon rasm kiriting. 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Youtobe ID <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="youtobe_id" class="form-control" id="validationCustom02"  placeholder="Youtobe ID" required value="{{$main->youtobe_id}}">
                                            <div class="invalid-feedback">
                                            Iltimos, Youtobe ID kiriting.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Majburiyat uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="description_uz" id="textarea" cols="10" rows="5" >{{$main->description_uz}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Majburiyat ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="description_ru" id="textarea" cols="10" rows="5" class="form-control">{{$main->description_ru}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label" for="validationCustom02">Majburiyat en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="">
                                            <textarea name="description_en" id="textarea" cols="10" rows="5" class="form-control">{{$main->description_en}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">Yuborish</button>
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