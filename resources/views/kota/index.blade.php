@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kota') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <a href="{{route('kota.create')}}" class="btn btn-primary float-right">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Kota</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($kota as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>{{ $data->kode_kota }}</td>
                                <td>{{ $data->nama_kota }}</td>
                                <td>{{ $data->provinsi->nama_provinsi }}</td>
                                <td>
                                    <form action="{{route('kota.destroy',$data->id)}}"  method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('kota.show',$data->id)}}" class="btn btn-sm btn-success">Show</a> |
                                        <a href="{{route('kota.edit',$data->id)}}" class="btn btn-sm btn-warning">Edit</a> |
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