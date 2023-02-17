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
            @error('file')
                <div class="alert alert-danger" role="alert">
                    File yang diupload salah!
                </div>
            @enderror
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-striped" style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Tahap Kegiatan</th>
                            <th rowspan="2" class="align-middle">Jenis DPH</th>
                            <th colspan="3" class="align-middle">Dampak Lingkungan Yang Dipantau</th>
                            <th colspan="3" class="align-middle">Bentuk Pemantauan Lingkungan Hidup</th>
                            <th colspan="3" class="align-middle">Institusi Pemantauan Lingkungan Hidup</th>
                            <th width="60px" rowspan="2" class="align-middle text-center">Aksi</th>
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
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $rpl->tahap_kegiatan }}</td>
                                <td>{{ $rpl->jenis_dph }}</td>
                                <td>{{ $rpl->jenis_dampak }}</td>
                                <td>{!! $rpl->indikator !!}</td>
                                <td>{{ $rpl->sumber_dampak }}</td>
                                <td>{!! $rpl->metode !!}</td>
                                <td>{!! $rpl->lokasi !!}</td>
                                <td>{{ $rpl->waktu }}</td>
                                <td>{!! $rpl->pelaksana !!}</td>
                                <td>{!! $rpl->pengawas !!}</td>
                                <td>{!! $rpl->penerima !!}</td>
                                <td class="text-center">
                                    <form action="{{ route('rpl.delete', $rpl->id) }}" method="post">@csrf
                                        <a class="btn btn-sm btn-warning" href="{{ route('rpl.ubah', $rpl->id) }}"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('yakin mau menghapus data ini??')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <form action="{{ route('rpl.store_rpl', $id_skkl) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex">
                    <h5>
                        <b>Tambah Data RPL</b>
                    </h5>
                    <button type="button" class="btn btn-sm btn-primary ml-auto mb-1" data-toggle="modal"
                        data-target="#importModal">
                        Import
                    </button>
                </div>
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
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="indikator"></textarea>
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
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="metode"></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="lokasi"></textarea>
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
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="pelaksana"></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="pengawas" class="form-label">Pengawas</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="pengawas"></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="penerima" class="form-label">Penerima</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="penerima"></textarea>
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
                <form action="{{ route('rpl.import', $id_skkl) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @error('file')
                            <div class="alert alert-danger" role="alert">
                                File yang diupload salah!
                            </div>
                        @enderror
                        <span><b>Download Template</b></span>
                        <div class="input-group mb-3">
                            <a type="button" class="btn btn-sm btn-success mr-1" target="_blank" href="{{ asset('template/RPL Template.xlsx') }}">Download</a>
                            <button type="button" class="btn btn-sm btn-warning" id="importDetail"><i class="fas fa-info fa-sm"></i></button>
                        </div>

                        <div style="display: none" class="alert alert-warning" role="alert" id="detail-import">
                            <span style="font-size: 12px">Syarat upload file untuk import:</span>
                            <span style="font-size: 12px"><br>1. File yang diupload harus menggunakan template yang disediakan</span>
                            <span style="font-size: 12px"><br>2. Isi tabel harus menyesuaikan dengan template</span>
                            <span style="font-size: 12px"><br>3. File yang diupload tidak bisa melebihi dari 5 mb</span>
                            <span style="font-size: 12px"><br>4. Format yang diupload harus berbentuk Excel (xlsx)</span>
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
            $('#importDetail').click(function () {
                $('#detail-import').fadeToggle('slow');
            });

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

    <script>
        tinymce.init({
            selector: 'textarea#myrpl',
            height: 400,
            forced_root_block: "",
            force_br_newlines: true,
            force_p_newlines: true,
            plugins: 'anchor autolink charmap codesample link lists searchreplace visualblocks wordcount',
            toolbar1: 'undo redo | insert | styleselect | bold italic | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ',
            toolbar2: 'forecolor backcolor emoticons | fontselect | fontsizeselect | fullscreen',
            templates: [{
                    title: 'Test template 1',
                    content: ''
                },
                {
                    title: 'Test template 2',
                    content: ''
                }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
        });
    </script>
@endpush
