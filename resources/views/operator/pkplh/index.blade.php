@extends('template.master')

@section('content')
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
                        <h4><b>Daftar Pernyataan PKPLH</b></h4>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                @include('layouts.navbar')
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
                    <th>Nomor Registrasi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Pemrakarsa</th>
                    <th>Nama Usaha/ Kegiatan</th>
                    <th>Status</th>
                    <th>PIC</th>
                    <th>Nama PJM</th>
                    <th>NIB</th>
                    <th>Verifikasi PTSP</th>
                    <th>Permohonan Dari Pemrakarsa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_pkplh as $pkplh)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pkplh->noreg }}</td>
                    <td>{{ $pkplh->created_at }}</td>
                    <td>
                        @foreach ($pemrakarsa as $user)
                            @if ($pkplh->user_id == $user->id)
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $pkplh->nama_usaha_baru }}</td>
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
                    <td>
                        {{ $pkplh->pic_pemohon }} <br>
                        ({{ $pkplh->no_hp_pic }})
                    </td>
                    <td>
                        @if ($pkplh->nama_operator != null)
                            {{ $pkplh->nama_operator }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $pkplh->nib_baru }}</td>
                    <td>Nomor: {{ $pkplh->nomor_validasi }} <br>
                        Tanggal: {{ $pkplh->tgl_validasi }}</td>
                    <td>{{  $pkplh->perihal }}</td>
                    <td>
                        <div class="btn-group-vertical">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="{{ '#aksiModal' . $pkplh->id }}">
                                Pilih
                            </button>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                data-target="{{ '#rpdModal' . $pkplh->id }}">RPD
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="{{ '#staticBackdrop' . $pkplh->id }}">
                                Upload
                            </button>
                        </div>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @foreach ($data_pkplh as $pkplh)
        <div class="modal fade" id="{{ 'staticBackdrop' . $pkplh->id }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('operator.pkplh.upload') }}" enctype="multipart/form-data" method="post">
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
                                <a type="button"
                                    class="btn btn-sm btn-success @if ($pkplh->file == null) disabled @endif mr-1"
                                    target="_blank" href="{{ asset('storage/files/pkplh/' . $pkplh->file) }}">Lihat</a>
                                <a href="{{ route('operator.pkplh.destroy', $pkplh->id) }}"
                                    class="btn btn-sm btn-danger @if ($pkplh->file == null) disabled @endif"
                                    type="submit">Hapus</a>
                            </div>

                            <span><b>Pilih file:</b></span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                        name="file" id="file" aria-describedby="inputGroupFileAddon01">
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
                                <input class="form-check-input" type="radio" name="status" id="status1"
                                    value="draft" checked>
                                <label class="form-check-label" for="status1">
                                    Draft
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status2"
                                    value="final">
                                <label class="form-check-label" for="status2">
                                    Final
                                </label>
                            </div>
                            <input type="text" name="id_pkplh" id="id_pkplh" value="{{ $pkplh->id }}" hidden>
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

    @foreach ($data_pkplh as $pkplh)
        <div class="modal fade" id="{{ 'aksiModal' . $pkplh->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih aksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a class="btn btn-success btn-block" href="{{ route('printuklupl.download', $pkplh->id) }}">Unduh
                            UKL-UPL</a></button>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ $pkplh->link_drive }}"> Drive</a></button>
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
                            <a class="btn btn-success btn-block" target="_blank"
                                href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_limbah_upload) }}">Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
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
                                            <form action="{{ route('operator.pkplh.rintek', $pkplh->id) }}" method="GET">
                                                <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                                <input type="text" name="nomor" value="{{ $i }}" hidden>
                                                <input type="text" name="jenis" value="{{ $row->surat_pertek }}" hidden>
                                                <button type="submit" class="btn btn-primary btn-block mb-2">Unduh lampiran {{ integerToRoman($i) }}</button>
                                                <?php $i++; ?>
                                            </form>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                <form @if ($pertek == "pertek6") action="{{ route('operator.pkplh.rintek', $pkplh->id) }}" @else action="{{ route('operator.pkplh.pertek', $pkplh->id) }}" @endif method="GET">
                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                    <input type="text" name="nomor" value="{{ $i }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-block mb-2">Unduh lampiran {{ integerToRoman($i) }}</button>
                                    <?php $i++; ?>
                                </form>
                                @endif
                            @endforeach
                        @endif

                        <hr>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ route('pkplh.operator.chat', $pkplh->id) }}">Chat dengan Pemrakarsa</a>
                        <a class="btn btn-success btn-block"
                            href="{{ route('operator.pkplh.download', $pkplh->id) }}">Unduh PKPLH</a></button>
                        <a class="btn btn-primary btn-block"
                            href="{{ route('operator.pkplh.preview', $pkplh->id) }}">Preview PKPLH</a></button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_pkplh as $pkplh)
        <div class="modal fade" id="{{ 'rpdModal' . $pkplh->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Risalah Pengolahan Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('operator.pkplh.rpd', $pkplh->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-box mb-2">
                                <label for="nomor_rpd" class="form-label">Nomor Risalah Pengolahan Data</label>
                                <input type="text" class="form-control" name="nomor_rpd"
                                    @if ($pkplh->nomor_rpd) value="{{ $pkplh->nomor_rpd }}" @endif required>
                            </div>
                            <div class="input-box mb-2">
                                <label for="tgl_rpd" class="form-label">Tanggal Risalah Pengolahan Data</label>
                                <input type="date" class="form-control" name="tgl_rpd"
                                    @if ($pkplh->tgl_rpd) value="{{ $pkplh->tgl_rpd }}" @endif required>
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
