@extends('admin.layout.index')

@section('style')
  <link href="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">  
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">  
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Foydalanuvchilar</h5>
                <a href="{{route('u-create')}}"><button type="button" class="btn btn-primary">Qo'shish</button></a>
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
                        <div class="alert alert-success alert-has-icon">
                            <div class="alert-icon">
                                <i class="far fa-lightbulb"></i>
                            </div>
                            <div class="alert-body">
                                <div class="alert-title">Added</div>
                                {{ session('warning') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table id="example3" class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>???</th>
                                        <th>Ism</th>
                                        <th>Familiya</th>
                                        <th>Sharfi</th>
                                        <th>Elektron pochta</th>
                                        <th>Foydalanuvchining Rasmi</th>
                                        <th>Holati</th>
                                        <th>Harakat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ($users->currentpage() - 1) * $users->perpage() + ($loop->index + 1) }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->middle_name }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td>
                                                <img src="{{asset('/upload/user/' .$user->user_image.'_phone_300.png')}}" class="p-2" alt="img" with="100px" height="60px">
                                            </td>
                                            <td>
                                                <form action="{{ asset('/admin/user/isactive/' . $user->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="sweetalert">
                                                        <button type="button" class=" @if ($user->is_active == 1) btn-success @endif  @if ($user->is_active == 0) btn-danger @endif btn sweet-confirm btn-sm">
                                                            @if ($user->is_active == 1)
                                                                Faol
                                                            @endif
                                                            @if ($user->is_active == 0)
                                                                 Faol emas
                                                            @endif
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('u-edit', $user->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{route('u-delete', $user->id)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger sweetalert2 shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script src="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
 <script src="{{asset('//cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>  
 <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

@endsection
