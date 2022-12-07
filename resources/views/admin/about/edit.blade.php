@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Milliy Offis ma`lumotlarini o`zgartirish</h5>
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
                        <form action="{{route('a-update', $about->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="mb-3">
                                    {{-- <label for="id"></label> --}}
                                    <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{$about->id}}" />
                                </div>

                                <div class="col-sm-12">
                                    <label class="col-form-label" for="validationCustom01">Foydalanuvchi nomi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <select name="user_id" id="single-select" class="form-control">
                                            <option selected>O'zingizga foydalanuvchi nom tanlang...</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($user->id == $about->user_id) selected @endif>{{$user->user_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">Sarlavha uz <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="about_title_uz" class="form-control" id="validationCustom02"  placeholder="Sarlavha uz ..." required value="{{$about->about_title_uz}}">
                                        <div class="invalid-feedback">
                                            Iltimos, sarlavha uz ni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">Sarlavha ru <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="about_title_ru" class="form-control" id="validationCustom02"  placeholder="Sarlavha ru ..." required value="{{$about->about_title_ru}}">
                                        <div class="invalid-feedback">
                                            Iltimos, sarlavha ru ni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">Sarlavha en <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="about_title_en" class="form-control" id="validationCustom02"  placeholder="Sarlavha en ..." required value="{{$about->about_title_en}}">
                                        <div class="invalid-feedback">
                                            Iltimos, sarlavha en ni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">Bo'lim raqami <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="number" name="section_number" class="form-control" id="validationCustom02"  placeholder="Bo'lim raqamini kiriting ..." required value="{{$about->section_number}}">
                                        <div class="invalid-feedback">
                                            Iltimos Bo'lim raqamini kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02" >Bo'lim nomi uz <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="section_title_uz" class="form-control" id="validationCustom02"  placeholder="Bo'lim nomi uz ..." required value="{{$about->section_title_uz}}">
                                        <div class="invalid-feedback">
                                            Iltimos, bo'lim sarlavhasini kiriting uz.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02" >Bo'lim nomi ru <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="section_title_ru" class="form-control" id="validationCustom02"  placeholder="Bo'lim nomi ru ..." required value="{{$about->section_title_ru}}">
                                        <div class="invalid-feedback">
                                            Iltimos, bo'lim sarlavhasini kiriting ru.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02" >Bo'lim nomi en <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="section_title_en" class="form-control" id="validationCustom02"  placeholder="Bo'lim nomi ru ..." required value="{{$about->section_title_en}}">
                                        <div class="invalid-feedback">
                                            Iltimos, bo'lim sarlavhasini kiriting en.
                                        </div>
                                    </div>
                                </div>

                            </div>
        
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Yuborish</button>
                            </div>
                                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection