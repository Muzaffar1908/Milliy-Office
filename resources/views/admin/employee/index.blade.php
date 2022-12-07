@extends('admin.layout.index')

@section('styles')
  <link href="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">  
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">  
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Xodimlar</h5>
                <a href="{{route('emp-create')}}"><button type="button" class="btn btn-primary">Rahbariyat qo'shing</button></a>
                <a href="{{route('emp-create_division')}}"><button type="button" class="btn btn-primary">Bo'lim boshlig'ini qo'shing</button></a>
                <a href="{{route('emp-create_employee')}}"><button type="button" class="btn btn-primary">Xodim qo'shish</button></a>
            </div>
            <div class="card-body">

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

                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table id="example3" class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>To'liq ismi sharif</th>
                                        <th>Lavozim</th>
                                        <th>Bo'lim</th>
                                        <th>Foydalanuvchi nomi</th>
                                        <th>Holat</th>
                                        <th>Harakat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{($employees->currentpage() - 1) * $employees->perpage() + ($loop->index+1)}}</td>
                                            <td>{{ $employee->full_name_uz }}</td>
                                            <td>{{ $employee->posTable->pos_name_uz ?? null }}</td>
                                            <td>{{ $employee->depTable->dep_name_uz ?? null }}</td>
                                            <td>{{ $employee->empuserTable->user_name }}</td>
                                            <td>
                                                <form action="{{ asset('/admin/employee/isactive/' . $employee->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="sweetalert">
                                                        <button type="button" class=" @if ($employee->is_active == 1) btn-success @endif  @if ($employee->is_active == 0) btn-danger @endif btn sweet-confirm btn-sm">
                                                            @if ($employee->is_active == 1)
                                                              Faol
                                                            @endif
                                                            @if ($employee->is_active == 0)
                                                              Faol emas
                                                            @endif
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex p-3">
                                                    <a href="{{route('emp-edit_employee', $employee->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    {{-- <form action="{{route('emp-delete')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger shadow sweetalert2 btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$employees->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
 <script src="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
 <script src="{{asset('//cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>  
 <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endsection
