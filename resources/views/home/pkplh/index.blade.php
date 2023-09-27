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
                    <h4><b>Permohonan Persetujuan Lingkungan (PKPLH)</b></h4>
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
    <a class=" btn btn-sm btn-success float-left" style="color: white;" href="{{ route('pkplh.create') }}">Tambah</a>
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
                @foreach ($data_pkplh as $pkplh)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $pkplh->created_at->format('d F Y')}}, {{ $pkplh->created_at->format('H:i:s') }}</td>
                    <td>{{ $pkplh->noreg }}</td>
                    <td>{{ $pkplh->perihal }}</td>
                    <td>
                        @if ($pkplh->tgl_update)
                            {{ $pkplh->tgl_update }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($pkplh->status == 'Belum')
                            <span class="badge badge-secondary">Belum diproses</span>
                        @elseif ($pkplh->status == "Submit")
                            <span class="badge badge-info">Sudah Submit</span>
                        @elseif ($pkplh->status == 'Proses')
                            <span class="badge badge-warning">Proses Validasi</span>
                        @elseif ($pkplh->status == 'Draft')
                            <span class="badge badge-primary">Drafting</span>
                        @elseif ($pkplh->status == 'Final')
                            <span class="badge badge-success">Selesai</span>
                        @elseif ($pkplh->status == "Batal")
                            <span class="badge badge-danger" title="{{ $pkplh->note }}">Dibatalkan</span>
                        @else
                            <span class="badge badge-danger" title="{{ $pkplh->note }}">Ditolak</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#exampleModal'.$pkplh->id }}">Pilih</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($data_pkplh as $pkplh)
<div class="modal fade" id="{{ 'exampleModal'.$pkplh->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih aksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <a class="btn btn-warning btn-block @if ($pkplh->status == "Final") disabled @endif" href="{{ route('pkplh.edit', $pkplh->id) }}">Ubah Data PKPLH</a>
            <a class="btn btn-success btn-block" href="{{ route('uklupl.create', $pkplh->id) }}">Input Dokumen UKL-UPL (Lampiran I)</a>
            <button type="button" class="btn btn-danger btn-block my-2" data-toggle="modal" data-target="{{ '#batal'.$pkplh->id }}">Batalkan Permohonan</button>
            <a class="btn btn-success btn-block" target="_blank" href="{{ route('pkplh.regist', $pkplh->id) }}">Submit Data</a>
            <a class="btn btn-success btn-block" target="_blank" href="{{ route('pkplh.chat', $pkplh->id) }}">Chat dengan PJM</a>
            <hr>
            @if ($pkplh->rintek_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_upload) }}">Dokumen Rincian Teknis Penyimpanan Limbah Non-B3</a></button>
            @endif
            @if ($pkplh->rintek2_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek2_upload) }}">Dokumen Rincian Teknis Pemanfaatan Limbah Non-B3</a></button>
            @endif
            @if ($pkplh->rintek3_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek3_upload) }}">Dokumen Rincian Teknis Penimbunan Limbah Non-B3</a></button>
            @endif
            @if ($pkplh->rintek4_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek4_upload) }}">Dokumen Rincian Teknis Pengurangan Limbah Non-B3</a></button>
            @endif
            @if ($pkplh->rintek_limbah_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_limbah_upload) }}">Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
            @endif
            <hr>
            <?php $i = 2; ?>
            @if ($pkplh->jenis_perubahan != 'perkep1' && $pkplh->pertek[0] != null)
                @foreach ($pkplh->pertek as $pertek)
                @csrf
                    @if ($pertek == "pertek5")
                        @foreach ($pertek_pkplh as $row)
                            @if ($row->id_pkplh == $pkplh->id)
                                @if ($row->pertek == "pertek5")
                                <form action="{{ route('pemrakarsa.pkplh.rintek', $pkplh->id) }}" method="GET">
                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                    <input type="text" name="nomor" value="{{ $i }}" hidden>
                                    <input type="text" name="jenis" value="{{ $row->surat_pertek }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-block mb-2">Preview lampiran {{ integerToRoman($i) }}</button>
                                    <?php $i++; ?>
                                </form>
                                @endif
                            @endif
                        @endforeach
                    @else
                    <form @if ($pertek == "pertek6") action="{{ route('pemrakarsa.pkplh.rintek', $pkplh->id) }}" @else action="{{ route('pemrakarsa.pkplh.pertek', $pkplh->id) }}" @endif method="GET">
                        <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                        <input type="text" name="nomor" value="{{ $i }}" hidden>
                        <button type="submit" class="btn btn-primary btn-block mb-2">Preview lampiran {{ integerToRoman($i) }}</button>
                        <?php $i++; ?>
                    </form>
                    @endif
                @endforeach
            @endif
            <a class="btn btn-primary btn-block" href="{{ route('pkplh.review', $pkplh->id) }}">Preview Dokumen PKPLH</a>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach ($data_pkplh as $pkplh)
<div class="modal fade" id="{{ 'batal'.$pkplh->id }}" tabindex="-1" aria-labelledby="batalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="batalLabel">Yakin ingin membatalkan permohonan?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('pkplh.batal', $pkplh->id) }}" method="POST">
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

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });
    </script>
@endpush
