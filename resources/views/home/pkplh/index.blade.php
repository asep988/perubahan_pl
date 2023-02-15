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
                    <h4><b>PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP (PKPLH)</b></h4>
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
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> --}}
                @endguest
            </ul>
        </div>

    </nav>
</div>
<div class="card-body">
    <button class=" btn btn-sm btn-success"><a style="color: white;" href="{{ route('pkplh.create') }}">Tambah</a></button><br><br>
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
                        @if ($pkplh->status == "Belum")
                            <span class="badge badge-secondary">Belum diproses</span>
                        @elseif ($pkplh->status == "Proses")
                            <span class="badge badge-warning">Proses Validasi</span>
                        @elseif ($pkplh->status == "Draft")
                            <span class="badge badge-primary">Selesai Drafting</span>
                        @elseif ($pkplh->status == "Final")
                            <span class="badge badge-success">Selesai</span>
                        @elseif ($pkplh->status == "Final" && $pkplh->file != null)
                            <a href="{{ asset('storage/files/pkplh/' . $pkplh->file) }}"><span class="badge badge-success">Selesai</span></a>
                        @elseif ($pkplh->status == "Batal")
                            <span class="badge badge-danger" title="{{ $pkplh->note }}">Dibatalkan</span>
                        @elseif ($pkplh->status == "Batal" && $pkplh->file != null)
                            <a href=""><span class="badge badge-danger" title="{{ $pkplh->note }}">Dibatalkan</span></a>
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
            <a class="btn btn-success btn-block" href="{{ route('uklupl.create', $pkplh->id) }}">Dokumen UKL-UPL (Lampiran I)</a>
            <a class="btn btn-success btn-block" target="_blank" href="{{ route('pkplh.regist', $pkplh->id) }}">Bukti Submit</a>
            @if ($pkplh->rintek_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_upload) }}">Unduh Dokumen Rincian Teknis</a></button>
            @endif
            @if ($pkplh->rintek_limbah_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_limbah_upload) }}">Unduh Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
            @endif
            <hr>
            <?php $i = 2; ?>
            @if ($pkplh->jenis_perubahan != 'perkep1')
                @foreach ($pkplh->pertek as $pertek)
                    <form @if ($pertek != "pertek6") action="{{ route('pemrakarsa.pkplh.pertek', $pkplh->id) }}" @else action="{{ route('pemrakarsa.pkplh.rintek', $pkplh->id) }}" @endif method="GET">
                        @csrf
                        <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                        <button type="submit" class="btn btn-primary btn-block mb-2">Preview lampiran {{ integerToRoman($i) }}</button>
                    </form>
                    <?php $i++; ?>
                @endforeach
            @endif
            <a class="btn btn-warning btn-block @if ($pkplh->status == "Final") disabled @endif" href="{{ route('pkplh.edit', $pkplh->id) }}">Ubah Data PKPLH</a>
            <button type="button" class="btn btn-danger btn-block my-2" data-toggle="modal" data-target="{{ '#batal'.$pkplh->id }}">Batalkan Permohonan</button>
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
