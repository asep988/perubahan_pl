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
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <table id="datatable" class="table table-bordered table-striped" style="table-layout: fixed;">
        <thead>
            <tr class="text-center">
                <th width="70px">No</th>
                <th>Nama Usaha/Kegiatan</th>
                <th>Perihal Perubahan PL</th>
                <th>NIB</th>
                <th>Nama PJM</th>
                <th>PIC</th>
                <th>No. PIC</th>
                <th>Link Drive Kelengkapan Dokumen</th>
                <th>RPD</th>
                <th width="100px">PDF</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_skkl as $skkl)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $skkl->nama_usaha_baru }}</td>
                <td>{{ $skkl->perihal }}</td>
                <td>{{ $skkl->nib_baru }}</td>
                <td>
                    @if ($skkl->nama_operator != null)
                        {{ $skkl->nama_operator }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $skkl->pic_pemohon }}</td>
                <td>{{ $skkl->no_hp_pic }}</td>
                <td> <button class="btn btn-sm btn-info"><a style="color: white;" target="_blank" href="{{ url($skkl->link_drive) }}">Open</a></button> </td>
                <td>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="{{ '#rpdModal'.$skkl->id }}">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#staticBackdrop' . $skkl->id }}">
                        Upload
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#aksiModal'.$skkl->id }}">
                        Pilih
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
@foreach ($data_skkl as $skkl)
<div class="modal fade" id="{{ 'staticBackdrop'.$skkl->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('operator.upload_file') }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload file PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <span><b>File yang sudah terupload:</b></span>
                <div class="input-group mb-3">
                    <a type="button" class="btn btn-sm btn-success @if ($skkl->file == null) disabled @endif mr-1" target="_blank" href="{{ asset('storage/files/skkl/'.$skkl->file) }}">Lihat</a>
                    <a href="{{ route('operator.destroy.file', $skkl->id) }}" class="btn btn-sm btn-danger @if ($skkl->file == null) disabled @endif" type="submit">Hapus</a>
                </div>

                    <span><b>Pilih file:</b></span>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="file" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>
                    <small class="text-muted mb-3">Max file size: 5mb | Format file: PDF only</small>
                    {{-- @error('file')
                            <div class="invalid-feedback mb-3">
                                Format file salah!
                            </div>
                    @enderror --}}
                    <br class="mb-3">
                    <span class="mt-3"><b>Apakah file yang akan diupload sudah final?</b></span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="draft" checked>
                        <label class="form-check-label" for="status1">
                            Draft
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="final">
                        <label class="form-check-label" for="status2">
                            Final
                        </label>
                    </div>
                    <input type="text" name="id_skkl" id="id_skkl" value="{{ $skkl->id }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($data_skkl as $skkl)
<div class="modal fade" id="{{ 'aksiModal'.$skkl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih aksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <a class="btn btn-success btn-block" href="{{ route('operator.download', [$skkl->id]) }}">Unduh PL</a></button>
            <a class="btn btn-success btn-block" href="{{ route('printrkl.download', [$skkl->id]) }}">Unduh RKL</a></button>
            <a class="btn btn-success btn-block" href="{{ route('printrpl.download', [$skkl->id]) }}">Unduh RPL</a></button>
            @if ($skkl->rintek_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_upload) }}">Unduh Dokumen Rincian Teknis</a></button>
            @endif
            @if ($skkl->rintek_limbah_upload)
                <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_limbah_upload) }}">Unduh Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
            @endif

            <hr>

            <a class="btn btn-primary btn-block mb-2" href="{{ route('operator.download.lampiran1', $skkl->id) }}">Unduh lampiran I</a>
            <?php $i = 3; ?> 
            @if ($skkl->jenis_perubahan != 'perkep1')
                @foreach ($skkl->pertek as $pertek)
                    <form @if ($pertek != "pertek6") action="{{ route('operator.download.pertek', $skkl->id) }}" @else action="{{ route('operator.download.rintek', $skkl->id) }}" @endif method="GET">
                        @csrf
                        <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                        <button type="submit" class="btn btn-primary btn-block mb-2">Unduh lampiran {{ integerToRoman($i) }}</button>
                    </form>
                    <?php $i++; ?>
                @endforeach
            @endif

            <hr>
            <a class="btn btn-warning btn-block" href="{{ route('operator.preview', [$skkl->id]) }}">Preview PL</a></button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach ($data_skkl as $skkl)
<div class="modal fade" id="{{ 'rpdModal'.$skkl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Risalah Pengolahan Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('operator.skkl.rpd', $skkl->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-box mb-2">
                    <label for="nomor_rpd" class="form-label">Nomor Risalah Pengolahan Data</label>
                    <input type="text" class="form-control" name="nomor_rpd" @if ($skkl->nomor_rpd) value="{{ $skkl->nomor_rpd }}" @endif required>
                </div>
                <div class="input-box mb-2">
                    <label for="tgl_rpd" class="form-label">Tanggal Risalah Pengolahan Data</label>
                    <input type="date" class="form-control" name="tgl_rpd" @if ($skkl->tgl_rpd) value="{{ $skkl->tgl_rpd }}" @endif required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
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
            lengthmenu: [
                [5,10,25,50,-1],
                [5,10,25,50,'All']
            ]
        });
    });
</script>
@endpush