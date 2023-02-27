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
                        <h4><b>Penugasan pada Permohonan Perubahan Kepemilikan SKKL</b></h4>
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
        <form action="{{ route('sekre.skkl.update') }}" method="POST">
            @csrf
            @method('PUT')
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
                        <th>Jenis Permohonan</th>
                        <th>Nomor Verif PTSP</th>
                        <th>Tanggal Verif PTSP</th>
                        <th>Permohonan Dari Pemrakarsa</th>
                        <th>Aksi</th>
                        <th width="120px">Penugasan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="12"></th>
                        <th>
                            <button type="submit" class="btn btn-sm btn-success btn-block">Tugaskan</button>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data_skkl as $skkl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $skkl->noreg }}</td>
                            <td>{{ $skkl->created_at }}</td>
                            <td>
                                <!-- Pemrakarsa -->
                                @foreach ($pemrakarsa as $user)
                                    @if ($skkl->user_id == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $skkl->nama_usaha_baru }}</td> <!-- nama usaha/kegiatan -->
                            <td class="text-center">
                                <!-- status -->
                                @if ($skkl->status == 'Belum')
                                    <span class="badge badge-secondary">Belum diproses</span>
                                @elseif ($skkl->status == "Submit")
                                    <span class="badge badge-info">Sudah Submit</span>
                                @elseif ($skkl->status == 'Proses')
                                    <span class="badge badge-warning">Proses Validasi</span>
                                @elseif ($skkl->status == 'Draft')
                                    <span class="badge badge-primary">Selesai Drafting</span>
                                @elseif ($skkl->status == 'Final')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif ($skkl->status == "Batal")
                                    <span class="badge badge-danger" title="{{ $skkl->note }}">Dibatalkan</span>
                                @else
                                    <span class="badge badge-danger" title="{{ $skkl->note }}">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <!-- pic -->
                                {{ $skkl->pic_pemohon }} <br>
                                ({{ $skkl->no_hp_pic }})
                            </td>
                            <td>
                                <!-- nama pjm -->
                                @if ($skkl->nama_operator != null)
                                    {{ $skkl->nama_operator }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <!-- jenis permohonan -->
                                @if ($skkl->jenis_perubahan == 'perkep1')
                                    Perubahan Kepemilikkan
                                @elseif ($skkl->jenis_perubahan == 'perkep2')
                                    Perubahan Kepemilikkan dan Integrasi Pertek/Rintek
                                @elseif ($skkl->jenis_perubahan == 'perkep3')
                                    Integrasi Pertek/Rintek
                                @endif
                            </td>
                            <td>{{ $skkl->nomor_validasi }}</td> <!-- nomor verif ptsp -->
                            <td>{{ $skkl->tgl_validasi }}</td> <!-- tgl verif ptsp-->
                            <td>{{ $skkl->perihal }}</td> <!-- permohonan dari pemrakarsa -->
                            <td>
                                <div class="btn-group-vertical">
                                    {{-- <a href="{{ route('sekre.skkl.reject', $skkl->id) }}" class="btn btn-sm btn-danger @if ($skkl->status == 'Ditolak') disabled @endif" onclick="return confirm('Yakin ingin menolak pengajuan ini?')">Tolak</a> --}}
                                    <button type="button" class="btn btn-sm btn-danger" @if ($skkl->status == 'Ditolak') disabled @endif data-toggle="modal"
                                        data-target="{{ '#tolak' . $skkl->id }}">
                                        Tolak
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="{{ '#aksiModal' . $skkl->id }}">
                                        Pilih
                                    </button>
                                </div>
                            </td>
                            <td>
                                <select class="operator-list" style="width: 100%" name="operator_name[]">
                                    <option value="-">Pilih</option>
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->name }}">{{ $operator->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="id[]" value="{{ $skkl->id }}" hidden>
                                {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#aksiModal'.$skkl->id }}">
                                Tugaskan
                            </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </form>
    </div>

    <!-- Modal -->

    @foreach ($data_skkl as $skkl)
        <div class="modal fade" id="{{ 'tolak' . $skkl->id }}" tabindex="-1" aria-labelledby="batalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalLabel">Yakin ingin menolak permohonan?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sekre.skkl.reject', $skkl->id) }}" method="POST">
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
                            <button type="submit" class="btn btn-danger">Tolak</button>
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
                        <a class="btn btn-success btn-block"
                            href="{{ route('sekretariat.skkl.download', [$skkl->id]) }}">
                            Unduh PL</a></button>
                        <a class="btn btn-success btn-block"
                            href="{{ route('sekretariat.printrkl.download', [$skkl->id]) }}">
                            Unduh Lampiran 1 RKL</a></button>
                        <a class="btn btn-success btn-block"
                            href="{{ route('sekretariat.printrpl.download', [$skkl->id]) }}">
                            Unduh Lampiran 1 RPL</a></button>
                        <a class="btn btn-success btn-block" target="_blank"
                            href="{{ $skkl->link_drive }}"> Drive</a></button>

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
                            href="{{ route('sekretariat.download.lampiran1', $skkl->id) }}">Unduh lampiran II</a>
                        <?php $i = 3; ?>
                        @if ($skkl->jenis_perubahan != 'perkep1' && $skkl->pertek[0] != null)
                            @foreach ($skkl->pertek as $pertek)
                            @csrf
                                @if ($pertek == "pertek5")
                                    @foreach ($pertek_skkl as $row)
                                        @if ($row->id_skkl == $skkl->id)
                                            @if ($row->pertek == "pertek5")
                                                <form action="{{ route('sekretariat.download.rintek', $skkl->id) }}" method="GET">
                                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                                    <input type="text" name="nomor" value="{{ $i }}" hidden>
                                                    <input type="text" name="jenis" value="{{ $row->surat_pertek }}" hidden>
                                                    <button type="submit" class="btn btn-primary btn-block mb-2">Preview lampiran {{ integerToRoman($i) }}</button>
                                                    <?php $i++; ?>
                                                </form>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                <form @if ($pertek == "pertek6") action="{{ route('sekretariat.download.rintek', $skkl->id) }}" @else action="{{ route('sekretariat.download.pertek', $skkl->id) }}" @endif method="GET">
                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                    <input type="text" name="nomor" value="{{ $i }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-block mb-2">Preview lampiran {{ integerToRoman($i) }}</button>
                                    <?php $i++; ?>
                                </form>
                                @endif
                            @endforeach
                        @endif

                        <hr>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ route('skkl.sekretariat.chat', $skkl->id) }}">Chat dengan Pemrakarsa</a>
                        <a class="btn btn-warning btn-block"
                            href="{{ route('sekretariat.skkl.preview', [$skkl->id]) }}">Preview
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
            $('.operator-list').select2();
            $("#datatable").DataTable({
                "scrollX": true,
                "autoWidth": true,
                "responsive": false,
                "lengthChange": true,
                "lengthmenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All']
                ]
            });
        });
    </script>
@endpush
