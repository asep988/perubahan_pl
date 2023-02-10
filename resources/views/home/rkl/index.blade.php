@extends('template.master')

@section('content')
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <div class="card">
        <div class="card-header">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <h4><b>Form Input Lampiran Rencana Pengelolaan Lingkungan (RKL)</b></h4>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
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
            @if (session()->has('pesan'))
                <div class="alert alert-success" role="alert">
                    {{ session('pesan') }}
                </div>
            @endif
            <div class="table-responsive">
                <table id="datatable" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="70px">No</th>
                            <th>Tahap Kegiatan</th>
                            <th>Jenis DPH</th>
                            <th>Dampak Lingkungan yang Dikelola</th>
                            <th>Sumber Dampak</th>
                            <th>Indikator Keberhasilan Pengelolaan Lingkungan Hidup</th>
                            <th>Bentuk Pengelolaan Lingkungan Hidup</th>
                            <th>Lokasi Pengelolaan Lingkungan Hidup</th>
                            <th>Periode Pengelolaan Lingkungan Hidup</th>
                            <th>Institusi Pengelolaan Lingkungan Hidup</th>
                            <th width="200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_rkl as $rkl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rkl->tahap_kegiatan }}</td>
                                <td>{{ $rkl->jenis_dph }}</td>
                                <td>{{ $rkl->dampak_dikelola }}</td>
                                <td>{{ $rkl->sumber_dampak }}</td>
                                <td>{!! $rkl->indikator !!}</td>
                                <td>{!! $rkl->bentuk_pengelolaan !!}</td>
                                <td>{!! $rkl->lokasi !!}</td>
                                <td>{{ $rkl->periode }}</td>
                                <td>{!! $rkl->institusi !!}</td>
                                <td>
                                    <form action="{{ route('rkl.delete', $rkl->id) }}" method="post">
                                        @csrf
                                        <a class="btn btn-sm btn-warning" href="{{ route('rkl.ubah', $rkl->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('yakin mau menghapus data ini?')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <form action="{{ route('rkl.store_rkl') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex">
                    <h5>
                        <b>Tambah Data RKL</b>
                    </h5>
                    <button type="button" class="btn btn-sm btn-primary ml-auto mb-1" data-toggle="modal"
                        data-target="#importModal">
                        Import
                    </button>
                </div>
                <input type="hidden" name="id_skkl" value="{{ $id_skkl }}">
                <table border="1" width="100%">
                    <tr>
                        <td style="padding: 20px;">
                            <div class="user-detail">
                                <div class="input-box">
                                    <br>
                                    <label for="tahap_kegiatan" class="form-label">Tahap Kegiatan</label>
                                    <div>
                                        <select name="tahap_kegiatan" id="tahap_kegiatan" class="form-control">
                                            <option value="Pra Konstruksi">Pra Konstruksi</option>
                                            <option value="Konstruksi">Konstruksi</option>
                                            <option value="Operasi">Operasi</option>
                                            <option value="Pasca Operasi">Pasca Operasi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <br>
                                    <label for="jenis_dph" class="form-label">Jenis Dampak Penting</label>
                                    <div>
                                        <select name="jenis_dph" id="jenis_dph" class="form-control">
                                            <option value="Penting">Dampak Penting yang Dikelola</option>
                                            <option value="Lainnya">Dampak Lainnya yang Dikelola</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <br>
                                    <label for="dampak_dikelola" class="form-label">Dampak Lingkungan yang dikelola</label>
                                    <div>
                                        <input type="text" class="form-control" name="dampak_dikelola" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                                    <div>
                                        <input type="text" class="form-control" name="sumber_dampak" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="indikator" class="form-label">Indikator Keberhasilan Pengelolaan
                                        LH</label>
                                    <div>
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="indikator"></textarea>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="bentuk_pengelolaan" class="form-label">Bentuk Pengelolaan LH</label>
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="bentuk_pengelolaan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="lokasi" class="form-label">Lokasi Pengelolaan LH</label>
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="periode" class="form-label">Periode Pengelolaan LH</label>
                                    <input type="text" class="form-control" name="periode" required>
                                </div>
                                <div class="input-box">
                                    <label for="institusi" class="form-label">Institusi Pengelolaan LH</label>
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="institusi"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>

                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('rkl.import', $id_skkl) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <span><b>Download Template</b></span>
                        <div class="input-group mb-3">
                            <a type="button" class="btn btn-sm btn-success mr-1" target="_blank"
                                href="{{ asset('template/RKL Template.xlsx') }}">Download</a>
                        </div>

                        <span><b>Pilih file:</b></span>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                    name="file" id="file" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <small class="text-muted mb-3">Max file size: 5mb | Format file: Excel only</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "lengthchange": true,
                "autowidth": false,
                "lengthmenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All']
                ]
            });
        });
    </script>
@endpush
