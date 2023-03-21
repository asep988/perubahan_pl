@extends('template.master')

@section('content')
    <div class="card-header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <h4><b>Daftar Permohonan Perubahan Kepemilikan SKKL</b></h4>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="nav-link" href="{{ route('ptsp') }}">Logout</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                {{-- <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('PTSP') }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('ptsp') }}">{{ __('Logout') }}</a>
                    </div>
                </li> --}}
                <!-- End of Right Side Of Navbar -->
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
                    <th>Pemrakarsa</th>
                    <th>Nama Usaha/ Kegiatan</th>
                    <th>Status</th>
                    <th>Jumlah RKL</th>
                    <th>Jumlah RPL</th>
                    <th>Jenis Permohonan</th>
                    <th>Nomor Verif PTSP</th>
                    <th>Tanggal Verif PTSP</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($data_skkl); $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data_skkl[$i]->noreg }}</td>
                        <td>{{ $data_skkl[$i]->pelaku_usaha_baru }}</td>
                        <td>{{ $data_skkl[$i]->nama_usaha_baru }}</td> <!-- nama usaha/kegiatan -->
                        <td>
                            {{-- status --}}
                            @if ($data_skkl[$i]->status == 'Belum')
                                <span class="badge badge-secondary">Belum diproses</span>
                            @elseif ($data_skkl[$i]->status == 'Submit')
                                <span class="badge badge-info">Sudah Submit</span>
                            @elseif ($data_skkl[$i]->status == 'Proses')
                                <span class="badge badge-warning">Proses Validasi</span>
                            @elseif ($data_skkl[$i]->status == 'Draft')
                                <span class="badge badge-primary">Selesai Drafting</span>
                            @elseif ($data_skkl[$i]->status == 'Final')
                                <span class="badge badge-success">Selesai</span>
                            @elseif ($data_skkl[$i]->status == 'Batal')
                                <span class="badge badge-danger" title="{{ $data_skkl[$i]->note }}">Dibatalkan</span>
                            @else
                                <span class="badge badge-danger" title="{{ $data_skkl[$i]->note }}">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $jum_rkl[$i] }}</td>
                        <td>{{ $jum_rpl[$i] }}</td>
                        <td>
                            <!-- jenis permohonan -->
                            @if ($data_skkl[$i]->jenis_perubahan == 'perkep1')
                                Perubahan Kepemilikkan
                            @elseif ($data_skkl[$i]->jenis_perubahan == 'perkep2')
                                Perubahan Kepemilikkan dan Integrasi Pertek/Rintek
                            @elseif ($data_skkl[$i]->jenis_perubahan == 'perkep3')
                                Integrasi Pertek/Rintek
                            @endif
                        </td>
                        <td>{{ $data_skkl[$i]->nomor_validasi }}</td> <!-- nomor verif ptsp -->
                        <td>{{ $data_skkl[$i]->tgl_validasi }}</td> <!-- tgl verif ptsp-->
                        {{-- <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="{{ '#aksiModal' . $data_skkl[$i]->id }}"> Pilih
                            </button>
                        </td> --}}
                    </tr>
                @endfor
            </tbody>
        </table>
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
                        <a class="btn btn-success btn-block"
                            href="{{ route('preview.rkl', [$skkl->id]) }}">
                            Preview Lampiran 1 RKL</a></button>
                        <a class="btn btn-success btn-block"
                            href="{{ route('preview.rpl', [$skkl->id]) }}">
                            Preview Lampiran 1 RPL</a></button>
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
