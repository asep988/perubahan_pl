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
                    <h4><b>Daftar Permohonan Perubahan Persetujuan Lingkungan (SKKL)</b></h4>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            @include('layouts.navbar')
        </div>

    </nav>
</div>
<div class="card-body">
    @if (session()->has('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <a class=" btn btn-sm btn-success float-left" style="color: white;" href="{{ route('skkl.create') }}">Tambah</a>
    <div class="d-flex justify-content-center">
        <a class=" btn btn-outline-success mb-3" target="_blank" style="margin-left: -30px" href="https://wa.me/6281339990567">Layanan Chat Operator (Jam Kerja  09.00 - 15.00 WIB)&nbsp;&nbsp;<img src="{{ asset('img/whatsapp.png') }}" width="30px" alt=""></a>
    </div>
    <div class="table-responsive">
        <table id="datatable" class="table" style="width: 100%">
            <thead>
                <tr class="text-center">
                    <th style="width: 50px;">No</th>
                    <th style="width: 250px;">Tanggal, Waktu Permohonan</th>
                    <th>Nomor Registrasi</th>
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
                    <td>{{ $skkl->noreg }}</td>
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
                        @elseif ($skkl->status == "Final" && $skkl->file != null)
                            <a href="{{ asset('storage/files/skkl/' . $skkl->file) }}"><span class="badge badge-success">Selesai</span></a>
                        @elseif ($skkl->status == "Batal")
                            <span class="badge badge-danger" title="{{ $skkl->note }}">Dibatalkan</span>
                        @elseif ($skkl->status == "Batal" && $skkl->file != null)
                            <a href=""><span class="badge badge-danger" title="{{ $skkl->note }}">Dibatalkan</span></a>
                        @else
                            <span class="badge badge-danger" title="{{ $skkl->note }}">Ditolak</span>
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

    <div class="d-flex justify-content-center">
        {{-- <a class=" btn btn-outline-success float-right" target="_blank" href="https://wa.me/6281339990567">Jika ingin bertanya lebih lanjut, klik tombol ini&nbsp;&nbsp;<img src="{{ asset('img/whatsapp.png') }}" width="30px" alt=""></a> --}}
        {{-- <a class=" btn btn-outline-success mt-3" target="_blank" href="https://wa.me/6281339990567">Tambah <i class="fas fa-whatsapp"></i> </a> --}}
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
            <a class="btn btn-primary btn-block" href="{{ route('rkl.create', $skkl->id) }}">Input Dokumen RKL (Lampiran I)</a>
            <a class="btn btn-primary btn-block" href="{{ route('rpl.create', $skkl->id) }}">Input Dokumen RPL (Lampiran I)</a>
            <button type="button" class="btn btn-danger btn-block my-2" data-toggle="modal" data-target="{{ '#batal'.$skkl->id }}">Batalkan Permohonan</button>
            <a class="btn btn-success btn-block" target="_blank" href="{{ route('skkl.regist', $skkl->id) }}">Submit Data</a>
            <a class="btn btn-success btn-block" target="_blank" href="{{ route('skkl.chat', $skkl->id) }}">Chat dengan PJM</a>
            <hr>
            @if ($skkl->rintek_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_upload) }}">Unduh Dokumen Rincian Teknis</a></button>
            @endif
            @if ($skkl->rintek_limbah_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_limbah_upload) }}">Unduh Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
            @endif

            <hr>

            <a class="btn btn-primary btn-block mb-2" href="{{ route('pemrakarsa.download.lampiran1', $skkl->id) }}">Preview lampiran II</a>
            <?php $i = 3; ?>
            @if ($skkl->jenis_perubahan != 'perkep1' && $skkl->pertek[0] != null)
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

@foreach ($data_skkl as $skkl)
<div class="modal fade" id="{{ 'batal'.$skkl->id }}" tabindex="-1" aria-labelledby="batalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="batalLabel">Yakin ingin membatalkan permohonan?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('skkl.batal', $skkl->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="input-box mb-2">
                    <label for="note" class="form-label">Catatan</label>
                    <textarea class="form-control" name="note" id="note" required></textarea>
                    {{-- <input type="text" class="form-control" name="note" required> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Batalkan</button>
            </div>
        </form>
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
                "responsive": false,
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
