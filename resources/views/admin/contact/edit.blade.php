@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Aloqani o`zgartirish</h5>
                <a href="{{route('ct-index')}}"><button type="button" class="btn btn-primary">Orqaga</button></a>
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
                        <form action="{{route('ct-update', $contact->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="mb-3">
                                    {{-- <label for="id"></label> --}}
                                    <input type="hidden" name="id"  class="form-control" id="id" value="{{$contact->id}}" />
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Manzil uz<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="address_uz"  class="form-control" id="address_uz" placeholder="Manzil uz kiriting ..." value="{{$contact->address_uz}}" />
                                        <div class="invalid-feedback">
                                            Iltimos, manzil uz ni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Manzil ru<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="address_ru"  class="form-control" id="address_ru" placeholder="Manzil ru kiriting ..." value="{{$contact->address_ru}}" />
                                        <div class="invalid-feedback">
                                            Iltimos, manzil ru ni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Manzil en<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="address_en"  class="form-control" id="address_en" placeholder="Manzil en kiriting ..." value="{{$contact->address_en}}" />
                                        <div class="invalid-feedback">
                                            Iltimos, manzil en ni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Telefon raqam<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="phone"  class="form-control" id="phone" placeholder="Telefon raqamini kiriting ..." value="{{$contact->phone}}" />
                                        <div class="invalid-feedback">
                                            Telefon raqamini kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Elektron pochta<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="email" name="email"  class="form-control" id="email" placeholder="Elektron pochtani kiriting ..." value="{{$contact->email}}" />
                                        <div class="invalid-feedback">
                                            Iltimos, elektron pochta manzilini kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Boshlangan vaqt<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="datetime-local" name="started_at"  class="form-control" id="started_at" placeholder="Boshlangan vaqtni kiriting ..." value="{{$contact->started_at}}" />
                                        <div class="invalid-feedback">
                                            Iltimos, Boshlangan vaqtni kiriting.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Tugagan vaqt<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="datetime-local" name="stopped_at"  class="form-control" id="stopped_at" placeholder="Tugagan vaqtni kiriting ..." value="{{$contact->stopped_at}}" />
                                        <div class="invalid-feedback">
                                            Iltimos, Tugagan vaqtni kiriting.
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