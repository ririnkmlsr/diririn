@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ubah Daftar Kasuses</div>
                <div class="card-body">
                    <form action="{{route('kasuses.update',$kasuses->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Jumlah Positif</label>
                            <input type="number" name="jumlah_positif" class="form-control" value="{{ $kasuses->jumlah_positif }}" placeholder="Jumlah_Positif" required>
                            <label>Jumlah Sembuh</label>
                            <input type="number" name="jumlah_sembuh" class="form-control" value="{{ $kasuses->jumlah_sembuh }}" placeholder="Jumlah_Sembuh" required >
                            <label>Jumlah Meninggal</label>
                            <input type="number" name="jumlah_meninggal" class="form-control" value="{{ $kasuses->jumlah_meninggal }}" placeholder="Jumlah_Meninggal" required >
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $kasuses->tanggal }}" placeholder="Tanggal" required>
                            <label>Nomor Rw</label>
                            <select name="id_rw" class="form-control" required>
                                @foreach ($rw as $data)
                                <option value="{{$data->id}}" {{$data->id == $kasuses->id_rw ? 'selected' : ''}} >{{$data->nama_rw}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection