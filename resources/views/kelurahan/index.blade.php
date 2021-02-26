@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kelurahan') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <a href="{{route('kelurahan.create')}}" class="btn btn-primary float-right">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Kelurahan</th>
                                <th scope="col">Kelurahan</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($kelurahan as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>{{ $data->kode_kelurahan }}</td>
                                <td>{{ $data->nama_kelurahan }}</td>
                                <td>{{ $data->kecamatan->nama_kecamatan }}</td>
                                <td>
                                    <form action="{{route('kelurahan.destroy',$data->id)}}"  method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('kelurahan.show',$data->id)}}" class="btn btn-sm btn-success">Show</a> |
                                        <a href="{{route('kelurahan.edit',$data->id)}}" class="btn btn-sm btn-warning">Edit</a> |
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin ?')">
                                            Delete
                                        </button>
                                    </form>
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
@endsection