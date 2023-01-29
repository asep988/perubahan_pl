@extends('template.master')

@section('content')
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="card">
    @if (Session::has('pesan'))
    <div style="background-color: 7FFF00; font: white;">{{ Session::get('pesan') }}</div>
    @endif
    <div class="card-header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <h4><b>Upaya Pengelolaan/Pemantauan Lingkungan (UKL-UPL)</b></h4>
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
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-striped" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th width="70px" rowspan="2" class="align-middle">No</th>
                        <th colspan="3" class="align-middle"></th>
                        <th colspan="3" class="align-middle">Standar Pengelolaan Lingkungan Hidup</th>
                        <th colspan="3" class="align-middle">Standar Pemantauan Lingkungan Hidup</th>
                        <th rowspan="2">Institusi Pengelola dan Pemantau Lingkungan Hidup</th>
                        <th rowspan="2" class="align-middle">Keterangan</th>
                        <th rowspan="2" class="align-middle">Aksi</th>
                    </tr>
                    <tr>
                        <th>Sumber Dampak</th>
                        <th>Jenis Dampak</th>
                        <th>Besaran Dampak</th>
                        <th>Bentuk</th>
                        <th>Lokasi</th>
                        <th>Periode</th>
                        <th>Bentuk</th>
                        <th>Lokasi</th>
                        <th>Periode</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_uklupl as $uklupl)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $uklupl->sumber_dampak }}</td>
                        <td>{{ $uklupl->jenis_dampak }}</td>
                        <td>{!! $uklupl->besaran_dampak !!}</td>
                        <td>{!! $uklupl->bentuk_pengelolaan !!}</td>
                        <td>{!! $uklupl->lokasi_pengelolaan !!}</td>
                        <td>{{ $uklupl->periode_pengelolaan }}</td>
                        <td>{!! $uklupl->bentuk_pemantauan !!}</td>
                        <td>{!! $uklupl->lokasi_pemantauan !!}</td>
                        <td>{{ $uklupl->periode_pemantauan }}</td>
                        <td>{!! $uklupl->institusi !!}</td>
                        <td>{!! $uklupl->keterangan !!}</td>
                        <td>
                            <form action="{{ route('uklupl.delete', $uklupl->id) }}" method="post">@csrf
                                <a class="btn btn-sm btn-warning" href="{{ route('uklupl.ubah', $uklupl->id) }}">
                                    Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('yakin mau menghapus data ini??')">
                                    Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h5><b>Tambah Data UKL/UPL</b></h5>
        <form action="{{ route('uklupl.store') }}" method="post">
            @csrf
            <input type="hidden" name="id_pkplh" value="{{ $id_pkplh }}">
            <table border="1" width="100%" class="mb-3">
                <tr>
                    <!-- dari -->
                    <td style="padding: 20px;">
                        <div class="input-box">
                            <br>
                            <label for="tahap_kegiatan" class="form-label">Tahap Kegiatan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <select name="tahap_kegiatan" id="tahap_kegiatan" class="form-control">
                                        <option value="Pra Konstruksi">Pra Konstruksi</option>
                                        <option value="Konstruksi">Konstruksi</option>
                                        <option value="Operasi">Operasi</option>
                                        <option value="Pasca Operasi">Pasca Operasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="sumber_dampak" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="jenis_dampak" class="form-label">Jenis Dampak</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="jenis_dampak" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="besaran_dampak" class="form-label">Besaran Dampak</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="besaran_dampak"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="besaran_dampak" class="form-label">Bentuk Pengelolaan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="bentuk_pengelolaan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="lokasi_pengelolaan" class="form-label">Lokasi Pengelolaan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi_pengelolaan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="periode_pengelolaan" class="form-label">Periode Pengelolaan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="periode_pengelolaan" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="bentuk_pemantauan" class="form-label">Bentuk Pemantauan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="bentuk_pemantauan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="lokasi_pemantauan" class="form-label">Lokasi Pemantauan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi_pemantauan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="periode_pemantauan" class="form-label">Periode Pemantauan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="periode_pemantauan" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="institusi" class="form-label">Institusi Pengelola dan Pemantau</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="institusi"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="keterangan"></textarea>
                                </div>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#datatable").DataTable({
            responsive: true,
            "lengthChange": true,
            "autoWidth": false,
            "lengthmenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, 'All']
            ]
        });
    });
</script>
@endpush