@extends('layouts.sidebarKepsek')

@section('content')
<div class="col-md-12 mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.kepsek')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: gray;">Edit RPP</li>
        </ol>
    </nav>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="m-0 font-weight-bold"> Edit RPP</h4>
        </div>
        <div class="card-body">
            <form action=" " method="POST" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label><br>
                    <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" placeholder="Masukkan Mata Pelajaran" value ="{{ $rpp->mata_pelajaran }}">
            </div>
            <div class="mb-3">
                <label for="kompetensi_inti" class="form-label">Kompetensi inti</label><br>
                <input type="text" class="form-control" id="kompetensi_inti" name="kompetensi_inti" placeholder="kompetensi_inti" value ="{{ $rpp->kompetensi_inti }}">
            </div>
            <div class="mb-3">
                <label for="penjelasan" class="font-weight-bold" for="foto">Penjelasan</label>
                <input type="text" class="form-control" id="penjelasan" name="penjelasan" placeholder="penjelasan" value ="{{ $rpp->penjelasan }}">
            </div>
            <br>
            <br>

            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/rpp-kepsek') }}" class="btn btn-success">Kembali</a>
        </div>
        </div>
    </div>
</div>
@endsection