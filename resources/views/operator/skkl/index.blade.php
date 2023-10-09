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
                        <h4><b>Daftar Permohonan Perubahan Kepemilikan SKKL</b></h4>
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

        <div class="row">
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="1" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '1' ? 'btn-outline-secondary' : 'btn-secondary' }}">
                        <span>Belum Diproses</span>
                        <h3>{{ $status['Belum'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="2" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '2' ? 'btn-outline-info' : 'btn-info' }}">
                        <span>Sudah Submit</span>
                        <h3>{{ $status['Submit'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="3" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '3' ? 'btn-outline-warning' : 'btn-warning' }}">
                        <span>Proses Validasi</span>
                        <h3>{{ $status['Proses'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="4" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '4' ? 'btn-outline-primary' : 'btn-primary' }}">
                        <span>Drafting</span>
                        <h3>{{ $status['Draft'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="5" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '5' ? 'btn-outline-success' : 'btn-success' }}">
                        <span>Selesai</span>
                        <h3>{{ $status['Final'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="6" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '6' ? 'btn-outline-danger' : 'btn-danger' }}">
                        <span>Ditolak/Batal</span>
                        <h3>{{ $status['Batal'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('operator.skkl.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="0" hidden>
                    <button type="submit" class="btn btn-lg btn-block mb-3 {{ $reqStat == '0' ? 'btn-outline-dark' : 'btn-dark' }}">
                        <span>Total</span>
                        <h3>{{ $status['Total'] }}</h3>
                    </button>
                </form>
            </div>
        </div>

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
                @foreach ($data_skkl as $skkl)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $skkl->noreg }}</td>
                        <td>{{ $skkl->created_at }}</td>
                        <td>
                            @foreach ($pemrakarsa as $user)
                                @if ($skkl->user_id == $user->id)
                                    {{ $user->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $skkl->nama_usaha_baru }}</td>
                        <td class="text-center">
                            @if ($skkl->status == 'Belum')
                                <span class="badge badge-secondary">Belum diproses</span>
                            @elseif ($skkl->status == "Submit")
                                <span class="badge badge-info">Sudah Submit</span>
                            @elseif ($skkl->status == 'Proses')
                                <span class="badge badge-warning">Proses Validasi</span>
                            @elseif ($skkl->status == 'Draft')
                                <span class="badge badge-primary">Drafting</span>
                            @elseif ($skkl->status == 'Final')
                                <span class="badge badge-success">Selesai</span>
                            @elseif ($skkl->status == "Batal")
                                <span class="badge badge-danger" title="{{ $skkl->note }}">Dibatalkan</span>
                            @else
                                <span class="badge badge-danger" title="{{ $skkl->note }}">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            {{ $skkl->pic_pemohon }} <br>
                            ({{ $skkl->no_hp_pic }})
                        </td>
                        <td>
                            @if ($skkl->nama_operator != null)
                                {{ $skkl->nama_operator }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $skkl->nib_baru }}</td>
                        <td>Nomor: {{ $skkl->nomor_validasi }} <br>
                            Tanggal: {{ $skkl->tgl_validasi }}</td>
                        <td>{{  $skkl->perihal }}</td>
                        <td>
                            <div class="btn-group-vertical">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="{{ '#aksiModal' . $skkl->id }}">
                                    Pilih
                                </button>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="{{ '#rpdModal' . $skkl->id }}">RPD
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="{{ '#staticBackdrop' . $skkl->id }}">
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
    @foreach ($data_skkl as $skkl)
        <div class="modal fade" id="{{ 'rpdModal' . $skkl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        <form action="{{ route('operator.skkl.rpd', $skkl->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-box mb-2">
                                <label for="nomor_rpd" class="form-label">Nomor Risalah Pengolahan Data</label>
                                <input type="text" class="form-control" name="nomor_rpd"
                                    @if ($skkl->nomor_rpd) value="{{ $skkl->nomor_rpd }}" @endif required>
                            </div>
                            <div class="input-box mb-2">
                                <label for="tgl_rpd" class="form-label">Tanggal Risalah Pengolahan Data</label>
                                <input type="date" class="form-control" name="tgl_rpd"
                                    @if ($skkl->tgl_rpd) value="{{ $skkl->tgl_rpd }}" @endif required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_skkl as $skkl)
        <div class="modal fade" id="{{ 'staticBackdrop' . $skkl->id }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <a type="button"
                                    class="btn btn-sm btn-success @if ($skkl->file == null) disabled @endif mr-1"
                                    target="_blank" href="{{ asset('storage/files/skkl/' . $skkl->file) }}">Lihat</a>
                                <a href="{{ route('operator.destroy.file', $skkl->id) }}"
                                    class="btn btn-sm btn-danger @if ($skkl->file == null) disabled @endif"
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
        <div class="modal fade" id="{{ 'aksiModal' . $skkl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        <a class="btn btn-success btn-block" href="{{ route('operator.download', [$skkl->id]) }}">Unduh
                            PL</a></button>
                        <a class="btn btn-success btn-block" href="{{ route('printrkl.download', [$skkl->id]) }}">
                        Unduh Lampiran I RKL</a></button>
                        <a class="btn btn-success btn-block" href="{{ route('printrpl.download', [$skkl->id]) }}">
                        Unduh Lampiran I RPL</a></button>
                        <button class="btn btn-success btn-block"><a style="color: white;" target="_blank"
                                href="{{ $skkl->link_drive }}">Drive</a></button>

                        <hr>
                        @if ($skkl->rintek_upload)
                            <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_upload) }}">Dokumen Rincian Teknis Penyimpanan Limbah Non-B3</a></button>
                        @endif
                        @if ($skkl->rintek2_upload)
                            <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek2_upload) }}">Dokumen Rincian Teknis Pemanfaatan Limbah Non-B3</a></button>
                        @endif
                        @if ($skkl->rintek3_upload)
                            <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek3_upload) }}">Dokumen Rincian Teknis Penimbunan Limbah Non-B3</a></button>
                        @endif
                        @if ($skkl->rintek4_upload)
                            <a class="btn btn-success btn-block" target="_blank" href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek4_upload) }}">Dokumen Rincian Teknis Pengurangan Limbah Non-B3</a></button>
                        @endif
                        @if ($skkl->rintek_limbah_upload)
                            <a class="btn btn-success btn-block" target="_blank"
                                href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_limbah_upload) }}">Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
                        @endif

                        <hr>

                        <a class="btn btn-primary btn-block mb-2"
                            href="{{ route('operator.download.lampiran1', $skkl->id) }}">Unduh lampiran II</a>
                        <?php $i = 3; ?>

                        @if ($skkl->jenis_perubahan != 'perkep1' && $skkl->pertek[0] != null)
                            @foreach ($skkl->pertek as $pertek)
                            @csrf
                                @if ($pertek == "pertek5")
                                    @foreach ($pertek_skkl as $row)
                                        @if ($row->id_skkl == $skkl->id)
                                            @if ($row->pertek == "pertek5")
                                                <form action="{{ route('operator.download.rintek', $skkl->id) }}" method="GET">
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
                                <form @if ($pertek == "pertek6") action="{{ route('operator.download.rintek', $skkl->id) }}" @else action="{{ route('operator.download.pertek', $skkl->id) }}" @endif method="GET">
                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                    <input type="text" name="nomor" value="{{ $i }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-block mb-2">Unduh lampiran {{ integerToRoman($i) }}</button>
                                    <?php $i++; ?>
                                </form>
                                @endif
                            @endforeach
                        @endif

                        <hr>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ route('operator.skkl.chat', $skkl->id) }}">Chat dengan Pemrakarsa <span class="badge badge-danger">{{ $skkl->total_chat }}</span></a>
                        <a class="btn btn-warning btn-block" href="{{ route('operator.preview', [$skkl->id]) }}">Preview
                            PL</a></button>
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
