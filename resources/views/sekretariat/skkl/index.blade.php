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
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
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
                </ul>
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
                        <th>Pemrakarsa</th>
                        <th>Nama Usaha/ Kegiatan</th>
                        <th>Nomor Verif PTSP</th>
                        <th>Tanggal Verif PTSP</th>
                        <th>Permohonan Dari Pemrakarsa</th>
                        <th>Nama PJM</th>
                        <th>PIC</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th width="120px">Penugasan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="10"></th>
                        <th>
                            <button type="submit" class="btn btn-sm btn-success btn-block">Tugaskan</button>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data_skkl as $skkl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @foreach ($pemrakarsa as $user)
                                    @if ($skkl->user_id == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $skkl->nama_usaha_baru }}</td>
                            <td>{{ $skkl->nomor_validasi }}</td>
                            <td>{{ $skkl->tgl_validasi }}</td>
                            <td>Nomor: {{ $skkl->nomor_pl }} <br>
                                Tanggal: {{ $skkl->tgl_pl }}</td>
                            <td>
                                @if ($skkl->nama_operator != null)
                                    {{ $skkl->nama_operator }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{ $skkl->pic_pemohon }} <br>
                                ({{ $skkl->no_hp_pic }})
                            </td>
                            <td class="text-center">
                                @if ($skkl->status == 'Belum')
                                    <span class="badge badge-secondary">Belum diproses</span>
                                @elseif ($skkl->status == 'Proses')
                                    <span class="badge badge-warning">Proses Validasi</span>
                                @elseif ($skkl->status == 'Draft')
                                    <span class="badge badge-primary">Selesai Drafting</span>
                                @elseif ($skkl->status == 'Final')
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <a href="{{ route('sekre.skkl.reject', $skkl->id) }}"
                                        class="btn btn-sm btn-danger @if ($skkl->status == 'Ditolak') disabled @endif"
                                        onclick="return confirm('Yakin ingin menolak pengajuan ini?')">Tolak</a>
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
                        <a class="btn btn-success btn-block" href="{{ route('sekretariat.skkl.download', [$skkl->id]) }}">Unduh
                            PL</a></button>
                        <a class="btn btn-success btn-block" href="{{ route('sekretariat.printrkl.download', [$skkl->id]) }}">Unduh
                            RKL</a></button>
                        <a class="btn btn-success btn-block" href="{{ route('sekretariat.printrpl.download', [$skkl->id]) }}">Unduh
                            RPL</a></button>
                        <button class="btn btn-success btn-block"><a style="color: white;" target="_blank"
                                href="{{ url($skkl->link_drive) }}">Drive</a></button>

                        @if ($skkl->rintek_upload)
                            <a class="btn btn-success btn-block" target="_blank"
                                href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_upload) }}">Unduh Dokumen
                                Rincian Teknis</a></button>
                        @endif
                        @if ($skkl->rintek_limbah_upload)
                            <a class="btn btn-success btn-block" target="_blank"
                                href="{{ asset('storage/files/skkl/rintek/' . $skkl->rintek_limbah_upload) }}">Unduh
                                Dokumen Rincian Teknis Penyimpanan Limbah B3</a></button>
                        @endif

                        <hr>

                        <a class="btn btn-primary btn-block mb-2"
                            href="{{ route('sekretariat.download.lampiran1', $skkl->id) }}">Unduh lampiran I</a>
                        <?php $i = 3; ?>
                        @if ($skkl->jenis_perubahan != 'perkep1')
                            @foreach ($skkl->pertek as $pertek)
                                <form
                                    @if ($pertek != 'pertek6') action="{{ route('sekretariat.download.pertek', $skkl->id) }}" @else action="{{ route('sekretariat.download.rintek', $skkl->id) }}" @endif
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
                        <a class="btn btn-warning btn-block" href="{{ route('sekretariat.skkl.preview', [$skkl->id]) }}">Preview
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
                "responsive": false,
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
