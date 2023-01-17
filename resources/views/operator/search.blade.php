@extends('operator.master')


@section('content')
@if(count($data_skkl))
<div class="card">
    <div>Ditemukan {{ count($data_skkl) }} data dengan kata :
        {{ $cari }}
    </div>
    @if(Session::has('pesan'))
    <div class="alert alert-info">{{ Session::get('pesan') }}</div>
    @endif
    <div class="card-header">
        <h4>Data SKKL</h4>
    </div>
    <br>
    <form action="{{ route('operator.search') }}" method="get" style="padding-left: 22cm;" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Ketik NIB Baru" aria-label="Search" aria-describedby="basic-addon1" name="kata">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <br><br>
    <table id="table" class="table table-bordered table-striped" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Usaha/Kegiatan</th>
                <th>Jenis Usaha/Kegiatan</th>
                <th>NIB</th>
                <th>KBLI</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_skkl as $skkl)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $skkl -> nama_usaha_baru }}</td>
                <td>{{ $skkl -> jenis_usaha_baru }}</td>
                <td>{{ $skkl -> nib_baru }}</td>
                <td>{{ $skkl -> knli_baru }}</td>
                <td> <button class=" btn btn-info"><a style="color: white;" href="{{ $skkl->link_drive }}"> Get LINK </a></button> </td>
                <td> <button class=" btn btn-info"><a style="color: white;" href="{{ route('operator.download', $skkl->id) }}"> Download </a></button> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/operator"><button class=" btn btn-info">Kembali</button></a>
    <br>
    {{ $data_skkl->links() }}
    @else
    <div>
        <h4>Data {{ $cari }} tidak ditemukan</h4>
        <a href="/operator"><button class=" btn btn-info">Kembali</button></a>
    </div>
    @endif
    @endsection