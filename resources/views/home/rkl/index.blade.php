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
                <table id="datatable" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Tahap Kegiatan</th>
                            <th class="align-middle">Jenis DPH</th>
                            <th class="align-middle">Dampak Lingkungan yang Dikelola</th>
                            <th class="align-middle">Sumber Dampak</th>
                            <th class="align-middle">Indikator Keberhasilan Pengelolaan Lingkungan Hidup</th>
                            <th class="align-middle">Bentuk Pengelolaan Lingkungan Hidup</th>
                            <th class="align-middle">Lokasi Pengelolaan Lingkungan Hidup</th>
                            <th class="align-middle">Periode Pengelolaan Lingkungan Hidup</th>
                            <th class="align-middle">Institusi Pengelolaan Lingkungan Hidup</th>
                            <th class="align-middle text-center" width="60px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (count($data_rkl) > 0)
                            <tr>
                                <td colspan="8"><strong>{{ $data_rkl->tahap_kegiatan }} </strong></td>
                            </tr>
                        @endif --}}
                        {{-- <tr id="dampakpenting">
                            <td colspan="8"><b> DAMPAK PENTING YANG DIKELOLA</b></td>
                        </tr>
                        <tr id="dampaklainnya">
                            <td colspan="8"><b> DAMPAK LAINNYA YANG DIKELOLA</b></td>
                        </tr> --}}
                        @foreach ($data_rkl as $rkl)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $rkl->tahap_kegiatan }}</td>
                                <td>{{ $rkl->jenis_dph }}</td>
                                <td>{{ $rkl->dampak_dikelola }}</td>
                                <td>{{ $rkl->sumber_dampak }}</td>
                                <td>{!! $rkl->indikator !!}</td>
                                <td>{!! $rkl->bentuk_pengelolaan !!}</td>
                                <td>{!! $rkl->lokasi !!}</td>
                                <td>{{ $rkl->periode }}</td>
                                <td>{!! $rkl->institusi !!}</td>
                                <td class="text-center">
                                    <form action="{{ route('rkl.delete', $rkl->id) }}" method="post">
                                        @csrf
                                        <a class="btn btn-sm btn-warning" href="{{ route('rkl.ubah', $rkl->id) }}"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('yakin mau menghapus data ini?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

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
                    {{-- <a href="{{ route('rpl.create', $id_skkl) }}" type="button" class="btn btn-sm btn-success ml-1 mb-1">Input Dokumen RPL</a> --}}
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
                                    <label for="indikator" class="form-label">Indikator Keberhasilan Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="indikator"></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="bentuk_pengelolaan" class="form-label">Bentuk Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="bentuk_pengelolaan"></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="lokasi" class="form-label">Lokasi Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="lokasi"></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="periode" class="form-label">Periode Pengelolaan LH</label>
                                    <input type="text" class="form-control" name="periode" required>
                                </div>
                                <div class="input-box">
                                    <label for="institusi" class="form-label">Institusi Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="institusi"></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>

                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('rpl.create', $id_skkl) }}" type="button" class="btn btn-success float-right">Input Dokumen RPL</a>
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
                        @error('file')
                            <div class="alert alert-danger" role="alert">
                                File yang diupload salah!
                            </div>
                        @enderror
                        <span><b>Download Template</b></span>
                        <div class="input-group mb-3">
                            <a type="button" class="btn btn-sm btn-success mr-1" target="_blank" href="{{ asset('template/RKL Template.xlsx') }}">Download</a>
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
            selector: 'textarea#myrkl',
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
