@extends('layouts.admin')

@section('title','Jurnal')

@section('content')

<h1> Tambah Data Jurnal</h1>
<br>
<form action="{{route('jurnal.update', $jurnal->id)}}" method="post" enctype="multipart/form-data">
    @csrf

<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="{{$jurnal->nama}}">
</div>

<div class="mb-3">
    <label for="kelas" class="form-label">Kelas</label>
    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan kelas" value="{{$jurnal->kelas}}">
</div>

<div class="mb-3">
    <label for="uraian_tugas" class="form-label">Uraian Tugas</label>
    <input type="text" class="form-control" id="uraian_tugas" name="uraian_tugas" placeholder="Masukkan Uraian Tugas" value="{{$jurnal->uraian_tugas}}">
</div>

<div class="mb-3">
    <label for="hasil" class="form-label">Hasil</label>
    <input type="text" class="form-control" id="hasil" name="hasil" placeholder="Masukkan Hasil" value="{{$jurnal->hasil}}">
</div>

<div class="mb-3">
    <label for="kendala" class="form-label">Kendala</label>
    <input type="text" class="form-control" id="kendala" name="kendala" placeholder="Masukkan Kendala" value="{{$jurnal->kendala}}">
</div>

<div class="mb-3">
    <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
    <input type="text" class="form-control" id="tindak_lanjut" name="tindak_lanjut" placeholder="Masukkan Tindak Lanjut" value="{{$jurnal->tindak_lanjut}}">
</div>

<div class="mb-3">
    <label class="font-weight-bold" for="foto_kegiatan">Foto Kegiatan *</label>
    <input type="hidden" name="foto_kegiatan_old" value="{{ $jurnal->foto_kegiatan }}">
    <input type="file" name="foto_kegiatan" class="form-control form-control-file" accept="image/*" />
    <small class="text-danger">
        <b>NB*:</b> Kosongi jika tidak mengubah gambar.
    </small>
</div>
<br>
<br>

<div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{route('jurnal.index')}}" class="btn btn-success">Kembali</a>
</div>
@endsection


