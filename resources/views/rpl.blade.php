@extends('template.master')

@section('content')
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="card">
    @if(Session::has('pesan'))
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
                        <h4><b>Form Input Lampiran Rencana Pemantauan Lingkungan (RPL)</b></h4>
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

        <br><br>
        <table id="table" class="table table-bordered table-striped" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th width="70px" rowspan="2" class="align-middle">No</th>
                    <th colspan="3">Dampak Lingkungan Yang Dipantau</th>
                    <th colspan="3">Bentuk Pemantauan Lingkungan Hidup</th>
                    <th colspan="3">Institusi Pemantauan Lingkungan Hidup</th>
                    <th width="145px" rowspan="2" class="align-middle">Aksi</th>
                </tr>
                <tr>
                    <td>Jenis Dampak Yang Timbul(dapat di ambien dan dapat di sumbernya)</td>
                    <td>Indikator/Parameter</td>
                    <td>Sumber Dampak</td>
                    <td>Metode Pengumpulan dan Analisis Data</td>
                    <td>Lokasi Pemantauan Lingkungan Hidup</td>
                    <td>Waktu dan Frekuensi Pemantauan</td>
                    <td>Pelaksana</td>
                    <td>Pengawas</td>
                    <td>Penerima Laporan</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_rpl as $rpl)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $rpl -> jenis_dampak }}</td>
                    <td>{!! $rpl -> indikator !!}</td>
                    <td>{{ $rpl -> sumber_dampak }}</td>
                    <td>{!! $rpl -> metode !!}</td>
                    <td>{!! $rpl -> lokasi !!}</td>
                    <td>{{  $rpl -> waktu  }}</td>
                    <td>{{  $rpl -> pelaksana  }}</td>
                    <td>{{ $rpl -> pengawas }}</td>
                    <td>{{ $rpl -> penerima }}</td>
                    <td>
                        <form action="{{route('rpl.delete', $rpl->id)}}" method="post">@csrf
                            <a class="btn btn-sm btn-warning" href="{{route('rpl.ubah', $rpl->id)}}">
                                Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('yakin mau menghapus data ini??')">
                                Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <b> Jumlah rpl : {{ $jumlah_rpl }} </b>
        <br>
        <div>{{ $data_rpl->links() }}</div>

        <form action="{{ route('rpl.store_rpl') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h5><b>Tambah Data RPL</b></h5>
            <input type="hidden" name="id_skkl" value="{{ $id_skkl }}">
            <table border="1" width="100%">
                <tr>
                    <!-- dari -->
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
                                <label for="jenis_dampak" class="form-label">Jenis Dampak Yang Timbul</label>
                                <div>
                                    <input type="text" class="form-control" name="jenis_dampak" require>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="indikator" class="form-label">Indikator</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="indikator"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <br>
                                <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                                <div>
                                    <input type="text" class="form-control" name="sumber_dampak" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="metode" class="form-label">Metode</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="metode"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <br>
                                <label for="waktu" class="form-label">Waktu</label>
                                <div>
                                    <input type="text" class="form-control" name="waktu" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <br>
                                <label for="pelaksana" class="form-label">Pelaksana</label>
                                <div>
                                    <input type="text" class="form-control" name="pelaksana" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="pengawas" class="form-label">Pengawas</label>
                                <input type="text" class="form-control" name="pengawas" required>
                            </div>
                            <div class="input-box">
                                <label for="penerima" class="form-label">Penerima</label>
                                <input type="text" class="form-control" name="penerima" required>
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