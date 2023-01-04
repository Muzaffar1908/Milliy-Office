@extends('admin.layout.index')

@section('styles')
  <link href="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">  
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">  
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Yangiliklar kategoriyasi</h5>
                <a href="{{route('c-create')}}"><button type="button" class="btn btn-primary">Qo'shish</button></a>
            </div>

            <div class="mb-3 mb-lg-0">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" onclick="" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                <div class="alert-title">Done successfully!!!</div>
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
                                        <th>№</th>
                                        <th>Kategoriya nomi</th>
                                        <th>Foydalanuvchi nomi</th>
                                        <th>Holati</th>
                                        <th>Harakat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news_cat as $cat)
                                        <tr>
                                            <td>{{($news_cat->currentpage() - 1) * $news_cat->perpage() + ($loop->index+1)}}</td>
                                            <td>{{ $cat->category_name_uz }}</td>
                                            <td>{{ $cat->usersTable->user_name }}</td>
                                            <td class="p-2">
                                                <form action="{{ asset('/admin/news_cat/isactive/' . $cat->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="sweetalert">
                                                        <button type="button" class=" @if ($cat->is_active == 1) btn-success @endif  @if ($cat->is_active == 0) btn-danger @endif btn sweet-confirm btn-sm">
                                                            @if ($cat->is_active == 1)
                                                                Faol
                                                            @endif
                                                            @if ($cat->is_active == 0)
                                                               Faol emas
                                                            @endif
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('c-edit', $cat->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('c-delete',  [ 'id'=> $cat->id ] )}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger sweetalert2 shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$news_cat->links()}}
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

