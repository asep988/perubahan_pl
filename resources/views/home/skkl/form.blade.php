@extends('template.master')

@section('content')
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="card">
    <div class="card-header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <h4><b>Form Input Permohonan Perubahan Kepemilikan SKKL</b></h4>
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
        @if(Session::has('pesan'))
        <div style="background-color: 7FFF00; font: white;">{{ Session::get('pesan') }}</div>
        @endif
        <form action="{{ route('skkl.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h5><b>Perubahan Penanggung Jawab Usaha atau Kegiatan</b></h5>
            <table border="1" width="100%" class="mb-3">
                <tr>
                    <!-- dari -->
                    <td style="padding: 20px;">
                        <div class="user-detail">
                            <span>Dari :</span>
                            <div class="input-box">
                                <br>
                                <label for="pelaku_usaha" class="form-label">Nama Pelaku Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="pelaku_usaha" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="nama_usaha" class="form-label">Nama Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="nama_usaha" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="jenis_usaha" class="form-label">Jenis Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="jenis_usaha" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="penanggung" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="penanggung" required>
                            </div>
                            <div class="input-box">
                                <label for="nib" class="form-label">NIB</label>
                                <input type="text" class="form-control" name="nib" required>
                            </div>
                            <div class="input-box">
                                <label for="knli" class="form-label">KBLI</label>
                                <input type="text" class="form-control" name="knli" required>
                            </div>
                            <div class="input-box">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" required>
                            </div>
                            <div class="input-box">
                                <label for="alamat" class="form-label">Alamat Kantor/Kegiatan</label>
                                {{-- <input type="text" class="form-control" name="alamat" required> --}}
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                            <div class="input-box">
                                <label for="lokasi" class="form-label">Lokasi Usaha/Kegiatan</label>
                                {{-- <input type="text" class="form-control" name="lokasi" required> --}}
                                <textarea class="form-control" id="lokasi" name="lokasi" rows="3" required></textarea>
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
                                    <input type="text" class="form-control" name="pelaku_usaha_baru" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="nama_usaha_baru" class="form-label">Nama Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="nama_usaha_baru" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="jenis_usaha_baru" class="form-label">Jenis Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="jenis_usaha_baru" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="penanggung_baru" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="penanggung_baru" required>
                            </div>
                            <div class="input-box">
                                <label for="nib_baru" class="form-label">NIB</label>
                                <input type="text" class="form-control" name="nib_baru" required>
                            </div>
                            <div class="input-box">
                                <label for="knli_baru" class="form-label">KBLI</label>
                                <input type="text" class="form-control" name="knli_baru" required>
                            </div>
                            <div class="input-box">
                                <label for="jabatan_baru" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan_baru" required>
                            </div>
                            <div class="input-box">
                                <label for="alamat_baru" class="form-label">Alamat Kantor/Kegiatan</label>
                                {{-- <input type="text" class="form-control" name="alamat_baru" required> --}}
                                <textarea class="form-control" id="alamat_baru" name="alamat_baru" rows="3" required></textarea>
                            </div>
                            <div class="input-box">
                                <label for="lokasi_baru" class="form-label">Lokasi Usaha/Kegiatan</label>
                                {{-- <input type="text" class="form-control" name="lokasi_baru" required> --}}
                                <textarea class="form-control" id="lokasi_baru" name="lokasi_baru" rows="3" required></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="mb-3"> <!-- Provinsi, Kabupaten & Kota, Bukti Perubahan -->
                <div class="form-group row">
                    <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-8">
                        <select class="js-provinsi-multiple" multiple="multiple" style="width: 100%" name="provinsi[]" id="provinsi" required>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->province }}">{{ $province->province }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kabupaten_kota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                    <div class="col-sm-8">
                        <select class="js-kabkota-multiple" multiple="multiple" style="width: 100%" name="kabupaten_kota[]" id="kabupaten_kota" required>
                            @foreach ($regencies as $regency)
                                <option value="{{ $regency->regency }}">{{ $regency->regency }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="link_drive" class="col-sm-2 col-form-label">Upload Lampiran Bukti Perubahan</label>
                    <div class="col-sm-8">
                        <input type="text" style="width: 100%" class="form-control" id="link_drive" name="link_drive" placeholder="Link Google Drive" required>
                        <small class="text-muted">Pastikan Link Google Drive anda Bisa diakses Oleh Publik</small>
                    </div>
                </div>
            </div>

            <hr>

            <div class="mb-3"> <!-- Surat Permohonan Perubahan PL & Peraturan Pemerintah Daerah -->
                <label><b>Surat Permohonan Perubahan PL :</b></label>

                <div class="form-group row">
                    <label for="nomor_pl" class="col-sm-2 col-form-label">Nomor</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="nomor_pl" name="nomor_pl" placeholder="Masukkan Nomor PL" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_pl" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="date" id="tgl_pl" name="tgl_pl" placeholder="yyyy/mm/dd">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="perihal_surat" class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" aria-label="perihal_surat" id="perihal_surat" name="perihal_surat">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pejabat" class="col-sm-2 col-form-label">Pejabat yang menandatangani</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" aria-label="pejabat" id="pejabat" name="pejabat">
                    </div>
                </div>

                <label><b>Peraturan Pemerintah Daerah</b></label>
                <div class="form-group row">
                    <table border="1" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Jenis Peraturan</th>
                                <th>Pejabat yang mengesahkan</th>
                                <th>Nomor SK</th>
                                <th>Perihal/Tentang</th>
                            </tr>
                        </thead>
                        <tbody class="table-input1">
                            <tr id="1claster1">
                                <td>1</td>
                                <td>
                                    <input type="text" name="jenis_peraturan[]" class="form-control" placeholder="Surat/Akta Notaris/SK">
                                </td>
                                <td>
                                    <input type="text" name="pejabat_daerah[]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="nomor_peraturan[]" class="form-control">
                                </td>
                                <td>
                                    <textarea class="form-control" name="perihal_peraturan[]" rows="2"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-1">
                        <button type="button" id="remove" class="btn remove-btn1 btn-sm btn-danger">
                            <i class="fas fa-minus fa-sm"></i>
                        </button>
                        <button type="button" id="add1" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <label><b>Sebutkan IL, SKKL, Persetujuan UKL-UPL, Persetujuan DELH, Persetujuan DPLH yang telah dimiliki</b></label>
                <label><b>Contoh : </b>
                    <ol>
                        <li>Jenis Izin Peraturan : Surat/Keputusan/Ketetapan</li>
                        <li>Pejabat Yang Mengesahkan : Kepala Dinas Pertambangan dan Lingkungan Hidup Kabupaten Sorong</li>
                        <li>Nomor SK : 660.1/113/2012</li>
                        <li>Tanggal Surat : 16/05/2012</li>
                        <li>Perihal/Tentang : UKL dan UPL Kegiatan Pemrduksian Sumur Walio Ext-1 (POP) di Blok Kepala Burung Kabupaten Sorong Provinsi Papua Barat.</li>
                    </ol>
                </label>
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
                        <tbody class="table-input2">
                            <tr id="2claster1">
                                <td>1</td>
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
                                    <textarea class="form-control" name="perihal[]" rows="2"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-1">
                        <button type="button" id="remove" class="btn remove-btn2 btn-sm btn-danger">
                            <i class="fas fa-minus fa-sm"></i>
                        </button>
                        <button type="button" id="add2" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <hr>
            <label><b>Sebutkan Ruang Lingkup (sebutkan ruang lingkup usaha dan/kegiatan yang akan di muat di dalam SK)</b></label>
            <div class="form-group row">
                <div class="col-sm-8">
                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="ruang_lingkup"></textarea>
                </div>
            </div>

            <hr>

            <div> <!-- Lampiran Persetujuan Teknis -->
                <label><b>Lampiran Persetujuan Teknis</b></label>
    
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek1" id="pertek1" onchange="pertek()">
                    <label class="custom-control-label" for="pertek1">Air Limbah</label>
                </div>

                <div class="mb-3" id="air_limbah">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Teknologi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Sosial & Ekonomi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Institusi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut[]"></textarea>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek2" id="pertek2" onchange="pertek()">
                    <label class="custom-control-label" for="pertek2">Emisi</label>
                </div>

                <div class="mb-3" id="emisi">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Teknologi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Sosial & Ekonomi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Institusi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut[]"></textarea>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek3" id="pertek3" onchange="pertek()">
                    <label class="custom-control-label" for="pertek3">Pengelolaan Limbah B3</label>
                </div>

                <div class="mb-3" id="limbah_b3">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Teknologi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Sosial & Ekonomi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Institusi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut[]"></textarea>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek4" id="pertek4" onchange="pertek()">
                    <label class="custom-control-label" for="pertek4">Andalalin</label>
                </div>

                <div class="mb-3" id="andalalin">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Teknologi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Sosial & Ekonomi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Institusi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut[]"></textarea>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek5" id="pertek5" onchange="pertek()">
                    <label class="custom-control-label" for="pertek5">Dokumen Rincian Teknis</label>
                </div>

                <div class="mb-3" id="rintek">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Teknologi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Sosial & Ekonomi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos[]"></textarea>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Institusi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut[]"></textarea>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="rintek_upload">Upload dokumen yang diperlukan</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="rintek_upload" aria-describedby="rintek_upload">
                            <label class="custom-file-label" for="rintek_upload">Choose file</label>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek6" id="pertek6" onchange="pertek()">
                    <label class="custom-control-label" for="pertek6">Rincian Teknis Penyimpanan Limbah B3</label>
                </div>

                <div class="mb-3" id="rintek_limbah">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="rintek_limbah_upload">Upload dokumen yang diperlukan</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="rintek_limbah_upload" aria-describedby="rintek_limbah_upload">
                            <label class="custom-file-label" for="rintek_limbah_upload">Choose file</label>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <hr>

            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('.js-kabkota-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $('.js-provinsi-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $(document).ready(function() {
        var i = 1;
        var j = 1;

        // $('#pertek1').onchange(function() {
        //     $('#pertek1').is(":checked")
        // });

        $('#add1').click(function() {
            j++
            $('.table-input1').append(`<tr id="1Claster${j}">
                            <td>${j}</td>
                            <td>
                                <input type="text" name="jenis_peraturan[]" class="form-control" placeholder="Surat/Akta Notaris/SK">
                            </td>
                            <td>
                                <input type="text" name="pejabat_daerah[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="nomor_peraturan[]" class="form-control">
                            </td>
                            <td>
                                <textarea class="form-control" name="perihal_peraturan[]" rows="2"></textarea>
                            </td>
                        </tr>`)
        });

        $(document).on('click', '.remove-btn1', function() {
            var button_id = j;
            $('#1Claster' + button_id + '').remove();
            j--
        });

        $('#add2').click(function() {
            i++
            $('.table-input2').append(`<tr id="2Claster${i}">
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
                                <textarea class="form-control" name="perihal[]" rows="2"></textarea>
                            </td>
                        </tr>`)
        });

        $(document).on('click', '.remove-btn2', function() {
            var button_id = i;
            $('#2Claster' + button_id + '').remove();
            i--
        });

        
    });
</script>
@endsection