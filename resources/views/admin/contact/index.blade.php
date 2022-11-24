@extends('admin.layout.index')

@section('styles')
  <link href="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">  
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">  
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title">Contact</h5>
                {{-- <a href="{{route('ct-create')}}"><button type="button" class="btn btn-primary">Add Contact</button></a> --}}
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
                            <table id="example3" class="display table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Started At</th>
                                        <th>Stopped At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($contacts)
                                        <tr>
                                            <td>{{ $contacts->index+1 }}</td>
                                            <td>{{ $contacts->address_uz }}</td>
                                            <td>{{ $contacts->phone }}</td>
                                            <td>{{ $contacts->email }}</td>
                                            <td>{{ $contacts->started_at }}</td>
                                            <td>{{ $contacts->stopped_at }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('ct-edit', $contacts->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    {{-- <form action="{{route('p-delete')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endisset
                                    
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
 <script src="{{asset('/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
 <script src="{{asset('//cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>  
 <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endsection
