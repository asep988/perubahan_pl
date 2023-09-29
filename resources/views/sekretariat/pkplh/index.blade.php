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

        {{-- <a href="{{ route('sekre.export.pkplh') }}" class="btn btn-success mb-3"><i class="fas fa-file-excel">&nbsp;Export</i></a> --}}
        <form action="{{ route('sekre.export.pkplh') }}" method="GET">
            @csrf
            <input type="text" name="status" value="{{ $reqStat ?? '' }}" hidden>
            <input type="text" name="param" value="{{ $param ?? '' }}" hidden>
            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-file-excel">&nbsp;Export</i></button>
        </form>

        <!-- Card -->
        <div class="row">
            <div class="col-2">
                <form action="{{ route('sekre.pkplh.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="1" hidden>
                    <button type="submit" class="btn btn-secondary btn-lg btn-block mb-3 {{ $reqStat == '1' ? 'active' : '' }}">
                        <span>Belum Diproses</span>
                        <h3>{{ $status['Belum'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col-2">
                <form action="{{ route('sekre.pkplh.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="2" hidden>
                    <button type="submit" class="btn btn-info btn-lg btn-block mb-3 {{ $reqStat == '2' ? 'active' : '' }}">
                        <span>Sudah Submit</span>
                        <h3>{{ $status['Submit'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col-2">
                <form action="{{ route('sekre.pkplh.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="3" hidden>
                    <button type="submit" class="btn btn-warning btn-lg btn-block mb-3 {{ $reqStat == '3' ? 'active' : '' }}">
                        <span>Proses Validasi</span>
                        <h3>{{ $status['Proses'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col-2">
                <form action="{{ route('sekre.pkplh.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="4" hidden>
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-3 {{ $reqStat == '4' ? 'active' : '' }}">
                        <span>Drafting</span>
                        <h3>{{ $status['Draft'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col-2">
                <form action="{{ route('sekre.pkplh.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="5" hidden>
                    <button type="submit" class="btn btn-success btn-lg btn-block mb-3 {{ $reqStat == '5' ? 'active' : '' }}">
                        <span>Selesai</span>
                        <h3>{{ $status['Final'] }}</h3>
                    </button>
                </form>
            </div>
            <div class="col-2">
                <form action="{{ route('sekre.pkplh.index') }}" method='GET'>
                    @csrf
                    <input type="text" name="status" value="6" hidden>
                    <button type="submit" class="btn btn-danger btn-lg btn-block mb-3 {{ $reqStat == '6' ? 'active' : '' }}">
                        <span>Ditolak/Batal</span>
                        <h3>{{ $status['Batal'] }}</h3>
                    </button>
                </form>
            </div>
        </div>

        <table id="example" class="table table-bordered table-striped" style="table-layout: fixed;">
            <thead>
                <tr class="text-center">
                    <th width="70px">No</th>
                    <th>Nomor Registrasi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Pemrakarsa</th>
                    <th width="120px">Nama Usaha/ Kegiatan</th>
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
            <tbody>
                {{-- @foreach ($data_pkplh as $pkplh)
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
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    <!-- Modal -->

    <hr>

    <form action="{{ route('sekre.pkplh.update') }}" method="POST">
        @csrf
        @method('PUT')
        <table id="example" class="table table-bordered table-striped px-3" style="table-layout: fixed;">
            <thead>
                <tr class="text-center">
                    <th width="50px">No</th>
                    <th>Nomor Registrasi</th>
                    <th>Pemrakarsa</th>
                    <th>Nama Usaha</th>
                    <th>Penanggung Jawab Materi</th>
                    <th width="50px">#</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2">
                        <button type="submit" class="btn btn-sm btn-success btn-block">Tugaskan</button>
                    </th>
                </tr>
            </tfoot>
            <tbody class="table-penugasan">
                {{-- <tr id="claster1">
                    <td>
                        0
                    </td>
                    <td>
                        <input type="text" name="noreg[]" value="value" class="form-control" disabled>
                    </td>
                    <td>
                        <input type="text" value="pemrakarsa" class="form-control" disabled>
                    </td>
                    <td>
                        <select class="operator-list" style="width: 100%" name="operator_name[]">
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->name }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center">
                        <button type="button" id="1" class="btn remove-btn btn-sm btn-danger">
                            <i class="fas fa-minus fa-sm"></i>
                        </button>
                    </td>
                </tr> --}}
            </tbody>
        </table>
    </form>

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
                                            <form action="{{ route('sekretariat.pkplh.rintek', $pkplh->id) }}" method="GET">
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
                                <form @if ($pertek == "pertek6") action="{{ route('sekretariat.pkplh.rintek', $pkplh->id) }}" @else action="{{ route('sekretariat.pkplh.pertek', $pkplh->id) }}" @endif method="GET">
                                    <input type="text" name="pertek" value="{{ $pertek }}" hidden>
                                    <input type="text" name="nomor" value="{{ $i }}" hidden>
                                    <button type="submit" class="btn btn-primary btn-block mb-2">Unduh lampiran {{ integerToRoman($i) }}</button>
                                    <?php $i++; ?>
                                </form>
                                @endif
                            @endforeach
                        @endif

                        <hr>
                        <a class="btn btn-success btn-block" target="_blank" href="{{ route('pkplh.sekretariat.chat', $pkplh->id) }}">Chat dengan Pemrakarsa <span class="badge badge-danger">{{ $pkplh->total_chat }}</span></a>
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
            var table = $('#example').DataTable({
                autoWidth: true,
                lengthChange: true,
                scrollX: true,
                lengthmenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.pkplh', [$reqStat, $param]) }}",
                columns: [
                    {data: 'count', name: 'count'},
                    {data: 'noreg', name: 'noreg'},
                    {data: 'tgl_rpd', name: 'tgl_rpd'},
                    {data: 'pelaku_usaha', name: 'pelaku_usaha'},
                    {data: 'nama_usaha_baru', name: 'nama_usaha_baru'},
                    {data: 'status', name: 'status'},
                    {data: 'pic_pemohon', name: 'pic_pemohon'},
                    {data: 'nama_operator', name: 'nama_operator'},
                    {data: 'jenis_perubahan', name: 'jenis_perubahan'},
                    {data: 'nomor_validasi', name: 'nomor_validasi'},
                    {data: 'tgl_validasi', name: 'tgl_validasi'},
                    {data: 'perihal', name: 'perihal'},
                    {data: 'note', name: 'note'},
                    {data: 'pertek', name: 'pertek'},
                ],
                buttons: ['excel', 'colvis'],
            });

            new $.fn.dataTable.FixedHeader( table );
            table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

            var j = 0;
            $(document).on('click', '.penugasan-btn', function() {
                var noreg = $(this).attr('id');
                var pemrakarsa = $(`#pu_${noreg}`).val();
                var nama_usaha = $(`#nu_${noreg}`).val();
                var id = $(`#id_${noreg}`).val();
                j++
                $('.table-penugasan').append(`<tr id="claster${j}">
                            <td>
                                ${j}
                            </td>
                            <td>
                                <input type="text" name="noreg[]" value="${noreg}" class="form-control" disabled>
                                <input type="text" name="id[]" value="${id}" class="form-control" hidden>
                            </td>
                            <td>
                                <input type="text" value="${pemrakarsa}" class="form-control" disabled>
                            </td>
                            <td>
                                <textarea class="form-control" disabled>${nama_usaha}</textarea>
                            </td>
                            <td class="select${j}">
                                <select class="operator-list" style="width: 100%" name="operator_name[]">
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->name }}">{{ $operator->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <button type="button" id="${j}" class="btn remove-btn btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                            </td>
                        </tr>`);
                // $('.operator-list').select2('destroy');
                // var selectList = $('.selector').html();
                // $(`.select${j}`).append(selectList);
                // $('.operator-list').select2();
            });

            $(document).on('click', '.remove-btn', function() {
                var button_id = $(this).attr('id');
                $('#claster' + button_id + '').remove();
                j--
            });
        });
    </script>
@endpush
