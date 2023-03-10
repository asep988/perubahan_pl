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
                            <h4><b>Upaya Pengelolaan/Pemantauan Lingkungan (UKL-UPL)</b></h4>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    @include('layouts.navbar')
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
                            <th colspan="3" class="align-middle"></th>
                            <th colspan="3" class="align-middle">Standar Pengelolaan Lingkungan Hidup</th>
                            <th colspan="3" class="align-middle">Standar Pemantauan Lingkungan Hidup</th>
                            <th rowspan="2">Institusi Pengelola dan Pemantau Lingkungan Hidup</th>
                            <th rowspan="2" class="align-middle">Keterangan</th>
                            <th width="60px" rowspan="2" class="align-middle text-center">Aksi</th>
                        </tr>
                        <tr>
                            <th class="align-middle">Sumber Dampak</th>
                            <th class="align-middle">Jenis Dampak</th>
                            <th class="align-middle">Besaran Dampak</th>
                            <th class="align-middle">Bentuk</th>
                            <th class="align-middle">Lokasi</th>
                            <th class="align-middle">Periode</th>
                            <th class="align-middle">Bentuk</th>
                            <th class="align-middle">Lokasi</th>
                            <th class="align-middle">Periode</th>
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
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('yakin mau menghapus data ini??')">
                                            Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <form action="{{ route('uklupl.store') }}" method="post">
                @csrf
                <div class="d-flex">
                    <h5>
                        <b>Tambah Data UKL/UPL</b>
                    </h5>
                    <button type="button" class="btn btn-sm btn-primary ml-auto mb-1" data-toggle="modal"
                        data-target="#importModal">
                        Import
                    </button>
                    <a target="_blank" href="{{ route('preview.uklupl', $id_pkplh) }}" type="button" class="btn btn-sm btn-success ml-1 mb-1">Preview UKL-UPL</a>
                </div>
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
                                <textarea class="form-control" id="myuklupl" aria-label="editor" name="besaran_dampak"></textarea>
                            </div>

                            <div class="input-box">
                                <label for="besaran_dampak" class="form-label">Bentuk Pengelolaan</label>
                                <textarea class="form-control" id="myuklupl" aria-label="editor" name="bentuk_pengelolaan"></textarea>
                            </div>

                            <div class="input-box">
                                <label for="lokasi_pengelolaan" class="form-label">Lokasi Pengelolaan</label>
                                <textarea class="form-control" id="myuklupl" aria-label="editor" name="lokasi_pengelolaan"></textarea>
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
                                <textarea class="form-control" id="myuklupl" aria-label="editor" name="bentuk_pemantauan"></textarea>
                            </div>

                            <div class="input-box">
                                <label for="lokasi_pemantauan" class="form-label">Lokasi Pemantauan</label>
                                <textarea class="form-control" id="myuklupl" aria-label="editor" name="lokasi_pemantauan"></textarea>
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
                                <textarea class="form-control" id="myuklup" aria-label="editor" name="institusi"></textarea>
                            </div>

                            <div class="input-box">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="myuklup" aria-label="editor" name="keterangan"></textarea>
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
                <form action="{{ route('uklupl.import', $id_pkplh) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @error('file')
                            <div class="alert alert-danger" role="alert">
                                File yang diupload salah!
                            </div>
                        @enderror
                        <span><b>Download Template</b></span>
                        <div class="input-group mb-3">
                            <a type="button" class="btn btn-sm btn-success mr-1" target="_blank" href="{{ asset('template/UKLUPL Template.xlsx') }}">Download</a>
                            <button type="button" class="btn btn-sm btn-warning" id="importDetail"><i class="fas fa-info fa-sm"></i></button>
                        </div>

                        <div style="display: none" class="alert alert-warning" role="alert" id="detail-import">
                            <span style="font-size: 12px">Syarat upload file untuk import:</span>
                            <span style="font-size: 12px"><br>1. File yang diupload harus menggunakan template yang disediakan</span>
                            <span style="font-size: 12px"><br>2. Isi tabel harus menyesuaikan dengan template</span>
                            <span style="font-size: 12px"><br>3. File yang diupload tidak bisa melebihi dari 5 mb</span>
                            <span style="font-size: 12px"><br>4. Pengisian data tidak boleh ada cell yang dimerge </span>
                            <span style="font-size: 12px"><br>5. Format yang diupload harus berbentuk Excel (xlsx)</span>
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
            selector: 'textarea#myuklupl',
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
