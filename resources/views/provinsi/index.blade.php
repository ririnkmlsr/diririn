@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    
<a href="{{route('provinsi.create')}}" class="btn btn-primary float-right"><b>Add Data</b></a>
                    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode</th>
      <th scope="col">Provinsi</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @php $no = 1; @endphp
  @foreach($provinsi as $data)
    <tr>
      <th scope="row">{{$no++}}</th>
      <td>{{$data->kode_provinsi}}</td>
      <td>{{$data->nama_provinsi}}</td>
      <td>
       <form action="{{route('provinsi.destroy',$data->id)}}"  method="post">
       @csrf
       @method('DELETE')
       <a href="{{route('provinsi.show',$data->id)}}" class="btn btn-sm btn-success">Show</a> |
       <a href="{{route('provinsi.edit',$data->id)}}" class="btn btn-sm btn-warning">Edit</a> |
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
