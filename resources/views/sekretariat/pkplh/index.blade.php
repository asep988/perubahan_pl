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
                        <h4><b>Penugasan pada Pernyataan PKPLH</b></h4>
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
        <form action="{{ route('sekre.pkplh.update') }}" method="POST">
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
                    @foreach ($data_pkplh as $pkplh)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pkplh->noreg }}</td>
                            <td>{{ $pkplh->created_at }}</td>
                            <td>
                                <!-- Pemrakarsa -->
                                @foreach ($pemrakarsa as $user)
                                    @if ($pkplh->user_id == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $pkplh->nama_usaha_baru }}</td> <!-- nama usaha/kegiatan -->
                            <td class="text-center">
                                <!-- status -->
                                @if ($pkplh->status == 'Belum')
                                    <span class="badge badge-secondary">Belum diproses</span>
                                @elseif ($pkplh->status == 'Proses')
                                    <span class="badge badge-warning">Proses Validasi</span>
                                @elseif ($pkplh->status == 'Draft')
                                    <span class="badge badge-primary">Selesai Drafting</span>
                                @elseif ($pkplh->status == 'Final')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif ($pkplh->status == 'Batal')
                                    <span class="badge badge-danger" title="{{ $pkplh->note }}">Dibatalkan</span>
                                @else
                                    <span class="badge badge-danger" title="{{ $pkplh->note }}">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <!-- pic -->
                                {{ $pkplh->pic_pemohon }} <br>
                                ({{ $pkplh->no_hp_pic }})
                            </td>
                            <td>
                                <!-- nama pjm -->
                                @if ($pkplh->nama_operator != null)
                                    {{ $pkplh->nama_operator }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <!-- jenis permohonan -->
                                @if ($pkplh->jenis_perubahan == 'perkep1')
                                    Perubahan Kepemilikkan
                                @elseif ($pkplh->jenis_perubahan == 'perkep2')
                                    Perubahan Kepemilikkan dan Integrasi Pertek/Rintek
                                @elseif ($pkplh->jenis_perubahan == 'perkep3')
                                    Integrasi Pertek/Rintek
                                @endif
                            </td>
                            <td>{{ $pkplh->nomor_validasi }}</td> <!-- nomor verif ptsp -->
                            <td>{{ $pkplh->tgl_validasi }}</td> <!-- tgl verif ptsp-->
                            <td>{{ $pkplh->perihal }}</td> <!-- permohonan dari pemrakarsa -->
                            <td>
                                <div class="btn-group-vertical">
                                    {{-- <a href="{{ route('sekre.pkplh.reject', $pkplh->id) }}"
                                    class="btn btn-sm btn-danger @if ($pkplh->status == 'Ditolak') disabled @endif"
                                    onclick="return confirm('Yakin ingin menolak pengajuan ini?')">Tolak</a> --}}
                                    <button type="button" class="btn btn-sm btn-danger"
                                        @if ($pkplh->status == 'Ditolak') disabled @endif data-toggle="modal"
                                        data-target="{{ '#tolak' . $pkplh->id }}">
                                        Tolak
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="{{ '#aksiModal' . $pkplh->id }}">
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
                                <input type="text" name="id[]" value="{{ $pkplh->id }}" hidden>
                                {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#aksiModal'.$pkplh->id }}">
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
    @foreach ($data_pkplh as $pkplh)
        <div class="modal fade" id="{{ 'tolak' . $pkplh->id }}" tabindex="-1" aria-labelledby="batalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalLabel">Yakin ingin menolak permohonan?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sekre.pkplh.reject', $pkplh->id) }}" method="POST">
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

    @foreach ($data_pkplh as $pkplh)
        <div class="modal fade operator-modal" id="{{ 'aksiModal' . $pkplh->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            href="{{ route('sekretariat.printuklupl.download', $pkplh->id) }}">Unduh
                            UKL-UPL</a></button>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ $pkplh->link_drive }}"> Drive</a></button>
                        @if ($pkplh->rintek_upload)
                            <a class="btn btn-success btn-block" target="_blank"
                                href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_upload) }}">Unduh Dokumen
                                Rincian Teknis</a></button>
                        @endif
                        @if ($pkplh->rintek_limbah_upload)
                            <a class="btn btn-success btn-block" target="_blank"
                                href="{{ asset('storage/files/pkplh/rintek/' . $pkplh->rintek_limbah_upload) }}">Unduh
                                Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
                        @endif

                        <hr>

                        <?php $i = 2; ?>
                        @if ($pkplh->jenis_perubahan != 'perkep1' && $pkplh->pertek[0] != null)
                            @foreach ($pkplh->pertek as $pertek)
                                <form
                                    @if ($pertek != 'pertek6') action="{{ route('sekretariat.pkplh.pertek', $pkplh->id) }}" @else action="{{ route('sekretariat.pkplh.rintek', $pkplh->id) }}" @endif
                                    method="GET">
                                    @csrf
                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-block mb-2">Unduh lampiran
                                        {{ integerToRoman($i) }}</button>
                                </form>
                                <?php $i++; ?>
                            @endforeach
                        @endif

                        <hr>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ route('skkl.sekretariat.chat', $skkl->id) }}">Chat dengan Pemrakarsa</a>
                        <a class="btn btn-success btn-block"
                            href="{{ route('sekretariat.pkplh.download', $pkplh->id) }}">Unduh PKPLH</a></button>
                        <a class="btn btn-primary btn-block" href="{{ route('pkplh.review', $pkplh->id) }}">Preview
                            PKPLH</a></button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sekretariat-list').select2();
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
