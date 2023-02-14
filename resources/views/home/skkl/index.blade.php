@extends('template.master')

@section('content')
<div class="card-header">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li>
                    <h4><b>Daftar Permohonan Perubahan Kepemilikan SKKL</b></h4>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                @endguest
            </ul>
        </div>

    </nav>
</div>
<div class="card-body">
    <button class=" btn btn-sm btn-success"><a style="color: white;" href="{{ route('skkl.create') }}">Tambah</a></button><br><br>
    <div class="table-responsive">
        <table id="datatable" class="table" style="width: 100%">
            <thead>
                <tr class="text-center">
                    <th style="width: 50px;">No</th>
                    <th style="width: 250px;">Tanggal, Waktu Permohonan</th>
                    <th>Perihal Permohonan</th>
                    <th>Tanggal proses</th>
                    <th style="width: 150px;">Status</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_skkl as $skkl)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $skkl->created_at->format('d F Y')}}, {{ $skkl->created_at->format('H:i:s') }}</td>
                    <td>{{ $skkl->perihal }}</td>
                    <td>
                        @if ($skkl->tgl_update)
                            {{ $skkl->tgl_update }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($skkl->status == "Belum")
                            <span class="badge badge-secondary">Belum diproses</span>
                        @elseif ($skkl->status == "Proses")
                            <span class="badge badge-warning">Proses Validasi</span>
                        @elseif ($skkl->status == "Draft")
                            <span class="badge badge-primary">Selesai Drafting</span>
                        @elseif ($skkl->status == "Final")
                            <span class="badge badge-success">Selesai</span>
                        @else
                            <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#exampleModal'.$skkl->id }}">
                            Pilih
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($data_skkl as $skkl)
<div class="modal fade" id="{{ 'exampleModal'.$skkl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih aksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <a class="btn btn-warning btn-block @if ($skkl->status == "Final") disabled @endif" href="{{ route('skkl.edit', $skkl->id) }}">Ubah Data SKKL</a>
            @if ($skkl->rintek_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_upload) }}">Unduh Dokumen Rincian Teknis</a></button>
            @endif
            @if ($skkl->rintek_limbah_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_limbah_upload) }}">Unduh Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
            @endif

            <hr>

            <a class="btn btn-primary btn-block" href="{{ route('rkl.create', $skkl->id) }}">Lampiran I RKL</a>
            <a class="btn btn-primary btn-block" href="{{ route('rpl.create', $skkl->id) }}">Lampiran I RPL</a>
            <a class="btn btn-primary btn-block mb-2" href="{{ route('pemrakarsa.download.lampiran1', $skkl->id) }}">Preview lampiran II</a>
            <?php $i = 3; ?>
            @if ($skkl->jenis_perubahan != 'perkep1')
                @foreach ($skkl->pertek as $pertek)
                    <form @if ($pertek != "pertek6") action="{{ route('pemrakarsa.download.pertek', $skkl->id) }}" @else action="{{ route('pemrakarsa.download.rintek', $skkl->id) }}" @endif method="GET">
                        @csrf
                        <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                        <button type="submit" class="btn btn-primary btn-block mb-2">Preview lampiran {{ integerToRoman($i) }}</button>
                    </form>
                    <?php $i++; ?>
                @endforeach
            @endif
            <a class="btn btn-primary btn-block" href="{{ route('skkl.review', $skkl->id) }}">Preview Dokumen SKKL</a>
        </div>
      </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable({
                "scrollX": true,
                "responsive": true,
                "lengthchange": true,
                "autowidth": true,
                "lengthmenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All']
                ]
            });
        });
    </script>
@endpush