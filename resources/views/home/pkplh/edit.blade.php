@extends('template.master')

@section('content')
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="card">
    @if(Session::has('pesan'))
    <div style="background-color: 7FFF00; font: white;">{{ Session::get('pesan') }}</div>
    @endif
    <div class="card-header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <h4><b>Form Ubah Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup (PKPLH)</b></h4>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        <form action="{{ route('pkplh.update', $pkplh->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h5><b>Perubahan Data Penanggung Jawab Usaha atau Kegiatan</b></h5>
            <table border="1" width="100%">
                <tr>
                    <!-- dari -->
                    <td style="padding: 20px;">
                        <div class="user-detail">
                            <span>Dari :</span>
                            <div class="input-box">
                                <br>
                                <label for="pelaku_usaha" class="form-label">Nama Pelaku Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="pelaku_usaha" value="{{ $pkplh->pelaku_usaha }}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="nama_usaha" class="form-label">Nama Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="nama_usaha" value="{{ $pkplh->nama_usaha }}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="jenis_usaha" class="form-label">Jenis Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="jenis_usaha" value="{{ $pkplh->jenis_usaha }}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="penanggung" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="penanggung" value="{{ $pkplh->penanggung }}" required>
                            </div>
                            <div class="input-box">
                                <label for="nib" class="form-label">NIB</label>
                                <input type="text" class="form-control" name="nib" value="{{ $pkplh->nib }}" required>
                            </div>
                            <div class="input-box">
                                <label for="knli" class="form-label">KBLI</label>
                                <input type="text" class="form-control" name="kbli" value="{{ $pkplh->kbli }}" required>
                            </div>
                            <div class="input-box">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="{{ $pkplh->jabatan }}" required>
                            </div>
                            <div class="input-box">
                                <label for="alamat" class="form-label">Alamat Kantor/Kegiatan</label>
                                <input type="text" class="form-control" name="alamat" value="{{ $pkplh->alamat }}" required>
                            </div>
                            <div class="input-box">
                                <label for="lokasi" class="form-label">Lokasi Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="lokasi" value="{{ $pkplh->lokasi }}" required>
                            </div>
                        </div>
                    </td>
                    <!-- menjadi -->
                    <td style="padding: 20px;">
                        <div class="user-detail">
                            <span>Menjadi :</span>
                            <div class="input-box">
                                <br>
                                <label for="pelaku_usaha_baru" class="form-label">Nama Pelaku Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="pelaku_usaha_baru" value="{{ $pkplh->pelaku_usaha_baru }}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="nama_usaha_baru" class="form-label">Nama Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="nama_usaha_baru" value="{{ $pkplh->nama_usaha_baru }}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="jenis_usaha_baru" class="form-label">Jenis Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="jenis_usaha_baru" value="{{ $pkplh->jenis_usaha_baru }}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="penanggung_baru" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="penanggung_baru" value="{{ $pkplh->penanggung_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="nib_baru" class="form-label">NIB</label>
                                <input type="text" class="form-control" name="nib_baru" value="{{ $pkplh->nib_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="knli_baru" class="form-label">KBLI</label>
                                <input type="text" class="form-control" name="kbli_baru" value="{{ $pkplh->kbli_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="jabatan_baru" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan_baru" value="{{ $pkplh->jabatan_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="alamat_baru" class="form-label">Alamat Kantor/Kegiatan</label>
                                <input type="text" class="form-control" name="alamat_baru" value="{{ $pkplh->alamat_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="lokasi_baru" class="form-label">Lokasi Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="lokasi_baru" value="{{ $pkplh->lokasi_baru }}" required>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <div class="form-group row">
                <label for="kabupaten_kota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                <div class="col-sm-8">
                    <select class="form-control js-kabkota-multiple" multiple="multiple" style="width: 100%" style="width: 85%" name="kabupaten_kota[]" id="kabupaten_kota">
                        <?php $true = 0;?>
                        @foreach ($regencies as $regency)
                            @foreach ($selected_kabupaten_kota as $selected_kab)
                                @if ($regency->regency == $selected_kab)
                                    <option value="{{ $regency->regency }}" selected>{{ $regency->regency }}</option>
                                    <?php $true = $regency->regency ?>
                                @endif
                            @endforeach
                            @if ($regency->regency != $true)
                                <option value="{{ $regency->regency }}">{{ $regency->regency }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                <div class="col-sm-8">
                    <select class="js-provinsi-multiple" multiple="multiple" style="width: 100%" style="width: 85%" name="provinsi[]" id="provinsi">
                        <?php $same = 0;?>
                        @foreach ($provinces as $province)
                            @foreach ($selected_provinces as $selected_province)
                                @if ($province->province == $selected_province)
                                    <option value="{{ $province->province }}" selected>{{ $province->province }}</option>
                                    <?php $same = $province->province?>
                                @endif
                            @endforeach
                            @if ($province->province != $same)
                                <option value="{{ $province->province }}">{{ $province->province }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="link_drive" class="col-sm-2 col-form-label">Upload Lampiran Link Drive</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="link_drive" style="width: 100%" name="link_drive" value="{{ $pkplh->link_drive }}" placeholder="Pastikan Link Google Drive anda Bisa diakses Oleh Publik" required>
                </div>
            </div>
            <br>
            <label><b>Surat Permohonan Perubahan PL :</b></label>
            <div class="form-group row">
                <label for="nomor_pl" class="col-sm-1 col-form-label">Nomor</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nomor_pl" name="nomor_pl" value="{{ $pkplh->nomor_pl }}" placeholder="Masukkan Nomor PL" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_pl" class="col-sm-1 col-form-label">Tanggal</label>
                <div class="col-sm-3">
                    <input class="form-control" type="date" id="tgl_pl" name="tgl_pl" placeholder="yyyy/mm/dd" value="{{ $pkplh->tgl_pl }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="perihal_surat" class="col-sm-1 col-form-label">Perihal</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" aria-label="perihal_surat" id="perihal_surat" name="perihal_surat" value="{{ $pkplh->perihal }}" required>
                </div>
            </div>

            <br>
            <label><b>Sebutkan IL, pkplh, Persetujuan UKL-UPL, Persetujuan DELH, Persetujuan DPLH yang telah dimiliki</b></label>
            <label><b>Contoh : </b><span>1). Surat/Keputusan/Ketetapan Kepala Dinas Pertambangan dan Lingkungan Hidup
                    Kabupaten Sorong Nomor 660.1/113/2012 tanggal 16 Mei 2012 tentang UKL dan UPL
                    Kegiatan Pemrduksian Sumur Walio Ext-1 (POP) di Blok Kepala Burung Kabupaten Sorong
                    Provinsi Papua Barat.
                </span></label>
            <br>
            <div class="form-group row">
                <table border="1" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Jenis Izin Persetujuan</th>
                            <th>Pejabat yang mengesahkan</th>
                            <th>Nomor SK</th>
                            <th>Tanggal Surat</th>
                            <th>Perihal/Tentang</th>
                        </tr>
                    </thead>
                    <tbody class="table-input">
                        <?php $i = 1; ?>
                        @foreach ($il_pkplh as $row)
                            <tr id="{{ 'claster' . $i }}">
                                <td>{{ $i }}</td>
                                <td>
                                    <input type="text" name="jenis_izin[]" class="form-control" value="{{ $row->jenis_sk }}" placeholder="Surat/Keputusan/Ketetapan">
                                </td>
                                <td>
                                    <input type="text" name="pejabat[]" class="form-control" value="{{ $row->menerbitkan }}">
                                </td>
                                <td>
                                    <input type="text" name="nomor_sk[]" class="form-control" value="{{ $row->nomor_surat }}">
                                </td>
                                <td>
                                    <input type="date" name="tgl_surat[]" class="form-control" value="{{ $row->tgl_surat }}">
                                </td>
                                <td>
                                    <input type="text" name="perihal[]" class="form-control" value="{{ $row->perihal_surat }}">
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="col-sm-8">
                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="il_dkk"></textarea>
                </div> --}}
                <div class="mt-1">
                    <button type="button" id="remove" class="btn remove-btn btn-sm btn-danger">
                        <i class="fas fa-minus fa-sm"></i>
                    </button>
                    <button type="button" id="add" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus fa-sm"></i>
                    </button>
                </div>
            </div>
            
            <br>
            <label><b>Sebutkan Ruang Lingkup (sebutkan ruang lingkup usaha dan/kegiatan yang akan di muat di dalam SK).</b></label>
            <br>
            <div class="form-group row">
                <div class="col-sm-8">
                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="ruang_lingkup">{!! htmlspecialchars($pkplh->ruang_lingkup) !!}</textarea>
                </div>
            </div>
            
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<input type="text" value="{{ $jum }}" id="sum_il" hidden>
<script>
    $('.js-kabkota-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $('.js-provinsi-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $(document).ready(function() {
        var i = $('#sum_il').val();
        $('#add').click(function() {
            i++
            $('.table-input').append(`<tr id="claster${i}">
                            <td>${i}</td>
                            <td>
                                <input type="text" name="jenis_izin[]" class="form-control" placeholder="Surat/Keputusan/Ketetapan">
                            </td>
                            <td>
                                <input type="text" name="pejabat[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="nomor_sk[]" class="form-control">
                            </td>
                            <td>
                                <input type="date" name="tgl_surat[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="perihal[]" class="form-control">
                            </td>
                        </tr>`)
        });

        $(document).on('click', '.remove-btn', function() {
            // var button_id = $(this).attr("id");
            var button_id = i;
            $('#claster' + button_id + '').remove();
            i--
        });
    });
</script>
@endsection