@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('tambah data provinsi') }}</div>

                <div class="card-body">
                    
                <form action="{{route('provinsi.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="" class="form-label">Kode Provinsi</label>
                    <input type="text" name="kode_provinsi" class="form-control" id="" >
                    </div>
                        <div class="mb-3">
                        <label for=" " class="form-label">Nama Provinsi</label>
                        <input type="text" name="nama_provinsi" class="form-control" id="">
                        </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
