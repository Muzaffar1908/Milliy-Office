@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Xodim yaratish</h5>
                <a href="{{route('emp-index')}}"><button type="button" class="btn btn-primary">Orqaga</button></a>
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
                        <form action="{{route('emp-store_employee')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="mb-3">
                                        {{-- <label for="id"></label> --}}
                                        <input type="hidden" name="id"  class="form-control" id="id" placeholder="Firstname enter" value="{{old('id')}}" />
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Foydalanuvchi nomi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="user_id" id="single-select" class="form-control">
                                                <option selected>O'zingizga foydalanuvchi nom tanlang...</option>
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}">{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Bo'lim nomi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="dep_id" id="single-select" class="form-control">
                                                <option selected>Bo'lim nomini tanlang...</option>
                                                @foreach($departments as $dep)
                                                 <option value="{{$dep->id}}">{{$dep->dep_name_uz}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Lavozim nomi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="pos_id" id="single-select" class="form-control">
                                                <option selected>Lavozim nomini tanlang...</option>
                                                @foreach($positions as $pos)
                                                 <option value="{{$pos->id}}">{{$pos->pos_name_uz}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Rasm <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="file" name="user_image" class="form-control" id="validationCustom02"  placeholder="Rasm ..." required value="{{old('user_image')}}">
                                            <div class="invalid-feedback">
                                                Iltimos, rasm kiriting.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">To'liq ismi uz <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="full_name_uz" class="form-control" id="validationCustom02"  placeholder="To'liq ism uz ni kiriting ..." required value="{{old('full_name_uz')}}">
                                            <div class="invalid-feedback">
                                                Iltimos, to'liq ismingizni kiriting uz.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">To'liq ismi ru <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="full_name_ru" class="form-control" id="validationCustom02"  placeholder="To'liq ism ru ni kiriting ..." required value="{{old('full_name_ru')}}">
                                            <div class="invalid-feedback">
                                                Iltimos, to'liq ismingizni kiriting ru.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">To'liq ismi en <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="full_name_en" class="form-control" id="validationCustom02"  placeholder="To'liq ism en ni kiriting ..." required value="{{old('full_name_en')}}">
                                            <div class="invalid-feedback">
                                                Iltimos, to'liq ismingizni kiriting en.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Elektron pochta <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="email" name="email" class="form-control" id="validationCustom02"  placeholder="Elektron pochta manzilini kiriting ..." required value="{{old('email')}}">
                                            <div class="invalid-feedback">
                                                Iltimos, elektron pochta manzilini kiriting.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Telefon raqam <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="phone" class="form-control" id="validationCustom02"  placeholder="Telefon raqamini kiriting ..." required value="{{old('phone')}}">
                                            <div class="invalid-feedback">
                                                Telefon raqamini kiriting.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Telefon raqami kodi <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" name="code" class="form-control" id="validationCustom02"  placeholder="Telefon raqami kodini kiriting ..." required value="{{old('code')}}">
                                            <div class="invalid-feedback">
                                                Telefon raqami kodini kiriting.
                                            </div>
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