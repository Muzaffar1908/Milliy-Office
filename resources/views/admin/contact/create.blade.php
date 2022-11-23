@extends('admin.layout.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Contact Create</h5>
                <a href="{{route('ct-index')}}"><button type="button" class="btn btn-primary">Back</button></a>
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
                        <form action="{{route('ct-store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
                            @csrf

                            <div class="row">

                                <div class="mb-3">
                                    {{-- <label for="id"></label> --}}
                                    <input type="hidden" name="id"  class="form-control" id="id" value="{{old('id')}}" />
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Address uz<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="address_uz"  class="form-control" id="address_uz" placeholder="Address uz enter" value="{{old('address_uz')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Address uz.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Address ru<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="address_ru"  class="form-control" id="address_ru" placeholder="Address ru enter" value="{{old('address_ru')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Address ru.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Address en<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="address_en"  class="form-control" id="address_en" placeholder="Address en enter" value="{{old('address_en')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Address en.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Phone Number<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="text" name="phone"  class="form-control" id="phone" placeholder="Phone Number enter" value="{{old('phone')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Phone Number.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Email<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="email" name="email"  class="form-control" id="email" placeholder="Email enter" value="{{old('email')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Email.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Started At<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="datetime-local" name="started_at"  class="form-control" id="started_at" placeholder="Started At enter" value="{{old('started_at')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Started At.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-3">
                                    <label class="col-form-label" for="validationCustom02">Stopped At<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <input type="datetime-local" name="stopped_at"  class="form-control" id="stopped_at" placeholder="Stopped At enter" value="{{old('stopped_at')}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Stopped At.
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