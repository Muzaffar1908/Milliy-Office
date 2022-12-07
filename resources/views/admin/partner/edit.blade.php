@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Hamkorlarni o'zgartirish</h5>
                <a href="{{route('p-index')}}"><button type="button" class="btn btn-primary">Orqaga</button></a>
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
                        <form action="{{route('p-update', $partner->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="mb-3">
                                    {{-- <label for="id"></label> --}}
                                    <input type="hidden" name="id"  class="form-control" id="id"  value="{{$partner->id}}" />
                                </div>

                                <div class="col-sm-12">
                                    <label class="col-form-label" for="validationCustom01">Foydalanuvchi nomi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <select name="user_id" id="single-select" class="form-control">
                                            <option selected>O'zingizga Foydalanuvchi nomi kiriting...</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($user->id==$partner->user_id) selected @endif >{{$user->user_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Rasm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <img src="{{asset('/upload/partner/' .$partner->image.'_thumbnail_550.png')}}" class="p-2" alt="img" with="100px" height="60px">
                                        <input type="file" name="image"  class="form-control" id="image" placeholder=" Image enter" />
                                        <div class="invalid-feedback">
                                        Iltimos, rasm kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-2">
                                    <label class="col-form-label" for="validationCustom02">Rasm havola<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="image_url"  class="form-control" id="image_url" placeholder=" Image url enter" value="{{$partner->image_url}}" />
                                        <div class="invalid-feedback">
                                        Iltimos, rasm havola kiriting.
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