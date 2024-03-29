@extends('layout.body.main') @section('layout')
@include('sweetalert::alert')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('kategori.create') }}" class="btn btn-inverse-info ">
                Tambah Kategori</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tabel Kategori</h6>
                    

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $ktg)
                                <tr>
                                    <form action="{{ route('kategori.destroy', ['id' => $ktg->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ktg->name }}</td>
                                        <td>{{ $ktg->created_at->format('d F Y') }}</td>
                                        <td>
                                            <a href="{{ route('kategori.edit', ['id' => $ktg->id]) }}" class="btn btn-inverse-warning  btn-icon">
                                                <i class="link-icon" data-feather="edit"></i>
                                            </a>
                            
                                            <button type="submit" class="btn btn-inverse-danger  btn-icon">
                                                <i class="link-icon" data-feather="trash"></i>
                                            </button>
                                        </td>
                                    </form>
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