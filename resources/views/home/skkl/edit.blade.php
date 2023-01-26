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
                        <h4><b>Form Ubah Permohonan Perubahan Kepemilikan SKKL</b></h4>
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
        <form action="{{ route('skkl.update', $skkl->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h5><b>Perubahan Penanggung Jawab Usaha atau Kegiatan</b></h5>

            <div class="btn-group btn-group-toggle mb-3 btn-block" data-toggle="buttons">
                <label class="btn btn-success">
                  <input type="radio" name="jenis_perubahan" id="jenis_perubahan1" value="perkep1" @if ($skkl->jenis_perubahan == "perkep1") checked @endif> Perubahan Kepemilikkan
                </label>
                <label class="btn btn-success">
                  <input type="radio" name="jenis_perubahan" id="jenis_perubahan2" value="perkep2" @if ($skkl->jenis_perubahan == "perkep2") checked @endif> Perubahan Kepemilikkan dan Integrasi Pertek/Rintek
                </label>
                <label class="btn btn-success">
                  <input type="radio" name="jenis_perubahan" id="jenis_perubahan3" value="perkep3" @if ($skkl->jenis_perubahan == "perkep3") checked @endif> Integrasi Pertek/Rintek
                </label>
            </div>

            <table border="1" width="100%" class="mb-3">
                <tr>
                    <!-- dari -->
                    <td style="padding: 20px;" class="align-top" id="dari" @if ($skkl->jenis_perubahan == "perkep3") style="display: none;" @endif>
                        <div class="">
                            <span>Dari :</span>
                            <div class="input-box">
                                <br>
                                <label for="pelaku_usaha" class="form-label">Nama Pelaku Usaha/Kegiatan</label>
                                <div>
                                    <input type="text" class="form-control" name="pelaku_usaha" value="{{ $initiator[0]->name }}">
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="penanggung" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="penanggung" value="{{ $initiator[0]->pic }}">
                            </div>
                            <div class="input-box">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="{{ $initiator[0]->pic_role }}">
                            </div>
                            <div class="input-box">
                                <label for="alamat" class="form-label">Alamat Kantor/Kegiatan</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $initiator[0]->address }}</textarea>
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
                                    <input type="text" class="form-control" name="pelaku_usaha_baru" value="{{ $skkl->pelaku_usaha_baru }}"required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="nama_usaha_baru" class="form-label">Nama Usaha/Kegiatan</label>
                                <div>
                                    <textarea class="form-control" id="nama_usaha_baru" name="nama_usaha_baru" rows="3" placeholder="Tuliskan judul nama usaha/kegiatan lengkap beserta alamat lokasi kegiatannya" required>{{ $skkl->nama_usaha_baru }}</textarea>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="penanggung_baru" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                <input type="text" class="form-control" name="penanggung_baru" value="{{ $skkl->penanggung_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="nib_baru" class="form-label">NIB</label>
                                <input type="text" class="form-control" name="nib_baru" value="{{ $skkl->nib_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="jabatan_baru" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan_baru" value="{{ $skkl->jabatan_baru }}" required>
                            </div>
                            <div class="input-box">
                                <label for="alamat_baru" class="form-label">Alamat Kantor/Kegiatan</label>
                                <textarea class="form-control" id="alamat_baru" name="alamat_baru" rows="3" required>{{ $skkl->alamat_baru }}</textarea>
                            </div>
                            <div class="input-box">
                                <label for="lokasi_baru" class="form-label">Lokasi Usaha/Kegiatan</label>
                                <textarea class="form-control" id="lokasi_baru" name="lokasi_baru" rows="3" required>{{ $skkl->lokasi_baru }}</textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="mb-3"> <!-- Provinsi, Kabupaten & Kota, Bukti Perubahan -->
                <div class="form-group row">
                    <label for="nomor_pl" class="col-sm-2 col-form-label">Jenis Usaha/Kegiatan & KBLI</label>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <table border="1">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Jenis Usaha/Kegiatan</th>
                                        <th>KBLI</th>
                                    </tr>
                                </thead>
                                <tbody class="table-kbli">
                                    <?php $no = 1 ?>
                                    @for ($i = 0; $i < count($skkl->kbli_baru); $i++)
                                        <tr id="{{ 'kbli-claster' . $no }}">
                                            <td>{{ $no }}</td>
                                            <td>
                                                <input type="text" name="nama_kbli[]" class="form-control" value="{{ $skkl->nama_kbli[$i] }}" placeholder="Ketik jenis usaha/kegiatan">
                                            </td>
                                            <td>
                                                <input type="text" name="nomor_kbli[]" class="form-control" value="{{ $skkl->kbli_baru[$i] }}" placeholder="Ketik kode KBLI">
                                            </td>
                                        </tr>
                                        <?php $no++ ?>
                                    @endfor
                                </tbody>
                            </table>
                            <div class="mt-1">
                                <button type="button" id="remove" class="btn remove-kbli btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                                <button type="button" id="add-kbli" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-8">
                        <select class="js-provinsi-multiple" multiple="multiple" style="width: 100%" name="provinsi[]" id="provinsi" required>
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
                    <label for="kabupaten_kota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                    <div class="col-sm-8">
                        <select class="js-kabkota-multiple" multiple="multiple" style="width: 100%" name="kabupaten_kota[]" id="kabupaten_kota" required>
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
                    <label for="link_drive" class="col-sm-2 col-form-label">Upload Lampiran Bukti Perubahan</label>
                    <div class="col-sm-8">
                        <div style="display: none;" class="alert alert-warning" role="alert" id="detail">
                            <span>Lampiran Dokumen yang diupload dalam Google Drive:</span>
                            <span><br> 1. Izin Lingkungan, SKKL, PKPLH, Persetujuan DELH, Persetujuan DELH</span>
                            <span><br> 2. Dokumen Amdal, UKL-UPL, DELH, atau DPLH yang dimiliki</span>
                            <span><br> 3. Berita Acara Validasi dari PTSP</span>
                            <span><br> 4. NIB (KBLI dan lokasi usaha kegiatan sesuai dengan usaha/kegiatan yg diajukan perubahan PL-nya harus termuat di dalam dokumen NIB)</span>
                            <span><br> 5. Akta Notaris Perubahan Kepemikan</span>
                            <span><br> 6. RKL-RPL dalam Bentuk Word</span>
                            <span><br> 7. Izin PPLH atau Persetujuan Teknis (Pembuangan Air Limbah, Emisi, Persetujuan Andalalin) yang telah dimiliki</span>
                            <span><br> 8. Rincian Teknis Penyimpanan Limbah B3 dalam bentuk Word</span>
                            <span><br> 9. Rincian Teknis Penyimpanan Limbah Non B3 (optional bila melakukan penyimpanan limbah non B3)</span>
                            <span><br> 10. Pastikan Link Google Drive anda Bisa diakses Oleh Publik</span>
                        </div>
                        <input type="text" style="width: 100%" class="form-control" id="link_drive" name="link_drive" placeholder="Link Google Drive" value="{{ $skkl->link_drive }}" required>
                    </div>
                    <div class="col-sm-2 ml-0">
                        <button type="button" class="btn btn-warning" id="btn-detail"><i class="fa fa-info fa-sm"></i>&nbsp; Detail</button>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="region" class="col-sm-2 col-form-label">Region Lokasi Usaha/Kegiatan</label>
                    <div class="col-sm-8">
                        <select class="regional-multiple" multiple="multiple" style="width: 100%" name="region" id="region" required>
                            <?php
                                $region1 = 0;
                                $region2 = 0;
                                $region3 = 0;
                                $region4 = 0;
                                $region5 = 0;
                                $region6 = 0;
                                if (is_string($skkl->region)) {
                                    if ($skkl->region == "Sumatera") {
                                        $region1 = 1;
                                    }
                                    if ($skkl->region == "Jawa") {
                                        $region2 = 1;
                                    }
                                    if ($skkl->region == "Kalimantan") {
                                        $region3 = 1;
                                    }
                                    if ($skkl->region == "Bali Nusa Tenggara") {
                                        $region4 = 1;
                                    }
                                    if ($skkl->region == "Sulawesi Maluku") {
                                        $region5 = 1;
                                    }
                                    if ($skkl->region == "Papua") {
                                        $region6 = 1;
                                    }
                                } else {
                                    foreach ($skkl->region as $region) {
                                        if ($region == "Sumatera") {
                                            $region1 = 1;
                                        }
                                        if ($region == "Jawa") {
                                            $region2 = 1;
                                        }
                                        if ($region == "Kalimantan") {
                                            $region3 = 1;
                                        }
                                        if ($region == "Bali Nusa Tenggara") {
                                            $region4 = 1;
                                        }
                                        if ($region == "Sulawesi Maluku") {
                                            $region5 = 1;
                                        }
                                        if ($region == "Papua") {
                                            $region6 = 1;
                                        }
                                    }
                                }
                            ?>
                            <option value="Sumatera" @if ($region1 == 1) selected @endif>Sumatera</option>
                            <option value="Jawa" @if ($region2 == 1) selected @endif>Jawa</option>
                            <option value="Kalimantan" @if ($region3 == 1) selected @endif>Kalimantan</option>
                            <option value="Bali Nusa Tenggara" @if ($region4 == 1) selected @endif>Bali Nusa Tenggara</option>
                            <option value="Sulawesi Maluku" @if ($region5 == 1) selected @endif>Sulawesi Maluku</option>
                            <option value="Papua" @if ($region6 == 1) selected @endif>Papua</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pic_pemohon" class="col-sm-2 col-form-label">Nama PIC</label>
                    <div class="col-sm-8">
                        <input type="text" style="width: 100%" class="form-control" id="pic_pemohon" name="pic_pemohon" value="{{ $skkl->pic_pemohon }}" placeholder="Nama Lengkap PIC" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_hp_pic" class="col-sm-2 col-form-label">Nomor PIC yang bisa dihubungi</label>
                    <div class="col-sm-8">
                        <input type="text" style="width: 100%" class="form-control" id="no_hp_pic" name="no_hp_pic" value="{{ $skkl->no_hp_pic }}" placeholder="Nomor Telepon PIC" required>
                    </div>
                </div>

            </div>

            <hr>

            <div class="mb-3"> <!-- Surat Permohonan Perubahan PL & Peraturan Pemerintah Daerah -->
                <label><b>Surat Permohonan Perubahan PL :</b></label>

                <div class="form-group row">
                    <label for="nomor_pl" class="col-sm-2 col-form-label">Nomor</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="nomor_pl" name="nomor_pl" value="{{ $skkl->nomor_pl }}" placeholder="Masukkan Nomor PL" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_pl" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="date" id="tgl_pl" name="tgl_pl" {{ $skkl->tgl_pl }} placeholder="yyyy/mm/dd">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="perihal_surat" class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" aria-label="perihal_surat" id="perihal_surat" value="{{ $skkl->perihal }}" name="perihal_surat">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pejabat" class="col-sm-2 col-form-label">Pejabat yang menandatangani</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" aria-label="pejabat" id="pejabat" value="{{ $skkl->pejabat_pl }}" name="pejabat_pl">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nomor_validasi" class="col-sm-2 col-form-label">Nomor Bukti Validasi Administrasi PTSP</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" aria-label="nomor_validasi" id="nomor_validasi" value="{{ $skkl->nomor_validasi }}" name="nomor_validasi">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_validasi" class="col-sm-2 col-form-label">Tanggal Validasi</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="date" id="tgl_validasi" name="tgl_validasi" value="{{ $skkl->tgl_validasi }}" placeholder="yyyy/mm/dd">
                    </div>
                </div>

                <div id="dasar_perubahan" @if ($skkl->jenis_perubahan == "perkep3") style="display: none;" @endif>
                    <hr>
                    <span><b>Dasar Perubahan Kepemilikan</b></span><br>
                    <label><b>Contoh : </b>
                        <ol>
                            <li>Jenis Dasar Perubahan : Surat/Akta Notaris/SK</li>
                            <li>Pejabat Yang Mengesahkan : Gubernur Jawa Timur</li>
                            <li>Nomor Surat: 40 Tahun 2021</li>
                            <li>Perihal/Tentang : Penugasan Kepada PT Jatim Grha Utama sebagai Pengelola Pusat Pengelolaan Sampah dan Limbah Bahan Berbahaya dan Beracun Jawa Timur.</li>
                        </ol>
                    </label>

                    <div class="form-group row">
                        <table border="1" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Jenis Dasar Perubahan</th>
                                    <th>Pejabat yang mengesahkan</th>
                                    <th>Nomor Surat</th>
                                    <th>Perihal/Tentang</th>
                                </tr>
                            </thead>
                            <tbody class="table-input1">
                                <?php $no = 1 ?>
                                @for ($i = 0; $i < count($skkl->jenis_peraturan); $i++)
                                    <tr id="{{ '1claster' . $no }}">
                                        <td>{{ $no }}</td>
                                        <td>
                                            <input type="text" name="jenis_peraturan[]" class="form-control" value="{{ $skkl->jenis_peraturan[$i] }}" placeholder="Surat/Akta Notaris/SK">
                                        </td>
                                        <td>
                                            <input type="text" name="pejabat_daerah[]" value="{{ $skkl->pejabat_daerah[$i] }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="nomor_peraturan[]" value="{{ $skkl->nomor_peraturan[$i] }}" class="form-control">
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="perihal_peraturan[]" rows="2">{{ $skkl->perihal_peraturan[$i] }}</textarea>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                @endfor
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
            </div>

            <hr>

            <div class="mb-3"> <!-- IL SKKL -->
                <span><b>Sebutkan IL, SKKL, Persetujuan UKL-UPL, Persetujuan DELH, Persetujuan DPLH yang telah dimiliki</b></span><br>
                <label><b>Contoh : </b>
                    <ol>
                        <li>Jenis Izin Persetujuan : Surat/Keputusan/Ketetapan</li>
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
                            <?php $i = 1; ?>
                            @foreach ($il_skkl as $row)
                                <tr id="{{ '2claster' . $i }}">
                                    <td>{{ $i }}</td>
                                    <td>
                                        <input type="text" name="jenis_izin[]" class="form-control" value="{{ $row->jenis_sk }}" placeholder="Surat/Keputusan/Ketetapan">
                                    </td>
                                    <td>
                                        <input type="text" name="pejabat[]" value="{{ $row->menerbitkan }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="nomor_sk[]" value="{{ $row->nomor_surat }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="date" name="tgl_surat[]" value="{{ $row->tgl_surat }}" class="form-control">
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="perihal[]" rows="2">{{ $row->perihal_surat }}</textarea>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
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
                    <textarea class="form-control" id="mytextarea" aria-label="editor" name="ruang_lingkup">{!! $skkl->ruang_lingkup !!}</textarea>
                </div>
            </div>

            <hr>

            <div> <!-- Lampiran I Pendekatan Pengelolaan Lingkungan -->
                <label><b>Lampiran I Pendekatan Pengelolaan Lingkungan</b></label>

                <div class="form-group row">
                    <div class="col-sm-8">
                        <label>Pendekatan Teknologi</label>
                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek">{!! $skkl->pend_tek !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-8">
                        <label>Pendekatan Sosial & Ekonomi</label>
                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos">{!! $skkl->pend_sos !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-8">
                        <label>Pendekatan Institusi</label>
                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut">{!! $skkl->pend_institut !!}</textarea>
                    </div>
                </div>
                <hr>
            </div>
            <hr>

            <div id="lampiran" @if ($skkl->jenis_perubahan == "perkep1") style="display: none;" @endif> <!-- Lampiran Persetujuan Teknis -->
                <label><b>Lampiran Persetujuan Teknis</b></label>
                <?php
                    $pertek1 = 0;
                    $pertek2 = 0;
                    $pertek3 = 0;
                    $pertek4 = 0;
                    $pertek5 = 0;
                    $pertek6 = 0;
                    $surat_pertek1 = null;
                    $surat_pertek2 = null;
                    $surat_pertek3 = null;
                    $surat_pertek4 = null;
                    $surat_pertek5 = null;
                    $nomor_pertek1 = null;
                    $nomor_pertek2 = null;
                    $nomor_pertek3 = null;
                    $nomor_pertek4 = null;
                    $nomor_pertek5 = null;
                    $tgl_pertek1 = null;
                    $tgl_pertek2 = null;
                    $tgl_pertek3 = null;
                    $tgl_pertek4 = null;
                    $tgl_pertek5 = null;
                    $perihal_pertek1 = null;
                    $perihal_pertek2 = null;
                    $perihal_pertek3 = null;
                    $perihal_pertek4 = null;
                    $perihal_pertek5 = null;
                    $judul_pertek1 = null;
                    $judul_pertek2 = null;
                    $judul_pertek3 = null;
                    $judul_pertek4 = null;
                    $judul_pertek5 = null;
                    if (is_string($skkl->pertek)) {
                        if ($skkl->pertek == "pertek1") {
                            $pertek1 = 1;
                        }
                        if ($skkl->pertek == "pertek2") {
                            $pertek2 = 1;
                        }
                        if ($skkl->pertek == "pertek3") {
                            $pertek3 = 1;
                        }
                        if ($skkl->pertek == "pertek4") {
                            $pertek4 = 1;
                        }
                        if ($skkl->pertek == "pertek5") {
                            $pertek5 = 1;
                        }
                        if ($skkl->pertek == "pertek6") {
                            $pertek6 = 1;
                        }
                    } else {
                        foreach ($skkl->pertek as $pertek) {
                            if ($pertek == "pertek1") {
                                $pertek1 = 1;
                                $index = array_search('pertek1', $skkl->pertek);
                                $judul_pertek1 = $pertek_skkl[$index]->judul_pertek;
                                $surat_pertek1 = $pertek_skkl[$index]->surat_pertek;
                                $nomor_pertek1 = $pertek_skkl[$index]->nomor_pertek;
                                $tgl_pertek1 = $pertek_skkl[$index]->tgl_pertek;
                                $perihal_pertek1 = $pertek_skkl[$index]->perihal_pertek;
                            }
                            if ($pertek == "pertek2") {
                                $pertek2 = 1;
                                $index = array_search('pertek2', $skkl->pertek);
                                $judul_pertek2 = $pertek_skkl[$index]->judul_pertek;
                                $surat_pertek2 = $pertek_skkl[$index]->surat_pertek;
                                $nomor_pertek2 = $pertek_skkl[$index]->nomor_pertek;
                                $tgl_pertek2 = $pertek_skkl[$index]->tgl_pertek;
                                $perihal_pertek2 = $pertek_skkl[$index]->perihal_pertek;
                            }
                            if ($pertek == "pertek3") {
                                $pertek3 = 1;
                                $index = array_search('pertek3', $skkl->pertek);
                                $judul_pertek3 = $pertek_skkl[$index]->judul_pertek;
                                $surat_pertek3 = $pertek_skkl[$index]->surat_pertek;
                                $nomor_pertek3 = $pertek_skkl[$index]->nomor_pertek;
                                $tgl_pertek3 = $pertek_skkl[$index]->tgl_pertek;
                                $perihal_pertek3 = $pertek_skkl[$index]->perihal_pertek;
                            }
                            if ($pertek == "pertek4") {
                                $pertek4 = 1;
                                $index = array_search('pertek4', $skkl->pertek);
                                $judul_pertek4 = $pertek_skkl[$index]->judul_pertek;
                                $surat_pertek4 = $pertek_skkl[$index]->surat_pertek;
                                $nomor_pertek4 = $pertek_skkl[$index]->nomor_pertek;
                                $tgl_pertek4 = $pertek_skkl[$index]->tgl_pertek;
                                $perihal_pertek4 = $pertek_skkl[$index]->perihal_pertek;
                            }
                            if ($pertek == "pertek5") {
                                $pertek5 = 1;
                                $index = array_search('pertek5', $skkl->pertek);
                                $judul_pertek5 = $pertek_skkl[$index]->judul_pertek;
                                $surat_pertek5 = $pertek_skkl[$index]->surat_pertek;
                                $nomor_pertek5 = $pertek_skkl[$index]->nomor_pertek;
                                $tgl_pertek5 = $pertek_skkl[$index]->tgl_pertek;
                                $perihal_pertek5 = $pertek_skkl[$index]->perihal_pertek;
                            }
                            if ($pertek == "pertek6") {
                                $pertek6 = 1;
                            }
                        }
                    }
                ?>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek1" id="pertek1" @if ($pertek1 == 1) checked @endif>
                    <label class="custom-control-label" for="pertek1">Air Limbah</label>
                </div>

                <div class="mb-3" id="air_limbah" @if ($pertek1 == 0) style="display: none" @endif>
                    <div class="form-group row">
                        <table border="1" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Judul Persetujuan Teknis</th>
                                    <th>Surat Persetujuan Teknis</th>
                                    <th>Nomor Persetujuan Teknis</th>
                                    <th>Tanggal Persetujuan Teknis</th>
                                    <th>Perihal Persetujuan Teknis</th>
                                </tr>
                            </thead>
                            <tbody class="table-pertek1">
                                <tr id="prt1-1">
                                    <input type="text" name="pertek[]" value="pertek1" hidden>
                                    <td>1</td>
                                    <td>
                                        <input type="text" class="form-control" id="judul_pertek1" placeholder="Judul Persetujuan" @if ($pertek1 == 1) name="judul_pertek[]" required value="{{ $judul_pertek1 }}" @endif>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="surat_pertek1" placeholder="Surat Persetujuan">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="nomor_pertek1" placeholder="nomor Persetujuan">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="tgl_pertek1" placeholder="Tanggal Persetujuan">
                                    </td>
                                    <td>
                                        <textarea class="form-control" id="perihal_pertek1" rows="2"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-1">
                            <button type="button" id="remove-pertek1" class="btn remove-pertek1 btn-sm btn-danger">
                                <i class="fas fa-minus fa-sm"></i>
                            </button>
                            <button type="button" id="add-pertek1" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus fa-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul_pertek" class="col-sm-2 col-form-label">Judul Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="judul_pertek" id="judul_pertek1" @if ($pertek1 == 1) name="judul_pertek[]" required value="{{ $judul_pertek1 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surat_pertek" class="col-sm-2 col-form-label">Surat Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="surat_pertek" id="surat_pertek1" @if ($pertek1 == 1) name="surat_pertek[]" required value="{{ $surat_pertek1 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pertek" class="col-sm-2 col-form-label">Nomor Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="nomor_pertek" id="nomor_pertek1" @if ($pertek1 == 1) name="nomor_pertek[]" required value="{{ $nomor_pertek1 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pertek" class="col-sm-2 col-form-label">Tanggal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" aria-label="tgl_pertek" id="tgl_pertek1" @if ($pertek1 == 1) name="tgl_pertek[]" required value="{{ $tgl_pertek1 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="perihal_pertek" class="col-sm-2 col-form-label">Perihal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="perihal_pertek" id="perihal_pertek1" @if ($pertek1 == 1) name="perihal_pertek[]" required value="{{ $perihal_pertek1 }}" @endif>
                        </div>
                    </div>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek2" id="pertek2" @if ($pertek2 == 1) checked @endif>
                    <label class="custom-control-label" for="pertek2">Emisi</label>
                </div>

                <div class="mb-3" id="emisi" @if ($pertek2 == 0) style="display: none" @endif>
                    <div class="form-group row">
                        <label for="judul_pertek" class="col-sm-2 col-form-label">Judul Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="judul_pertek" id="judul_pertek2" @if ($pertek2 == 1) name="judul_pertek[]" required value="{{ $judul_pertek2 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surat_pertek" class="col-sm-2 col-form-label">Surat Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="surat_pertek" id="surat_pertek2" @if ($pertek2 == 1) name="surat_pertek[]" required value="{{ $surat_pertek2 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pertek" class="col-sm-2 col-form-label">Nomor Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="nomor_pertek" id="nomor_pertek2" @if ($pertek2 == 1) name="nomor_pertek[]" required value="{{ $nomor_pertek2 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pertek" class="col-sm-2 col-form-label">Tanggal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" aria-label="tgl_pertek" id="tgl_pertek2" @if ($pertek2 == 1) name="tgl_pertek[]" required value="{{ $tgl_pertek2 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="perihal_pertek" class="col-sm-2 col-form-label">Perihal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="perihal_pertek" id="perihal_pertek2" @if ($pertek2 == 1) name="perihal_pertek[]" required value="{{ $perihal_pertek2 }}" @endif>
                        </div>
                    </div>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek3" id="pertek3" @if ($pertek3 == 1) checked @endif>
                    <label class="custom-control-label" for="pertek3">Pengelolaan Limbah B3</label>
                </div>

                <div class="mb-3" id="limbah_b3" @if ($pertek3 == 0) style="display: none" @endif>
                    <div class="form-group row">
                        <label for="judul_pertek" class="col-sm-2 col-form-label">Judul Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="judul_pertek" id="judul_pertek3" @if ($pertek3 == 1) name="judul_pertek[]" required value="{{ $judul_pertek3 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surat_pertek" class="col-sm-2 col-form-label">Surat Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="surat_pertek" id="surat_pertek3" @if ($pertek3 == 1) name="surat_pertek[]" required value="{{ $surat_pertek3 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pertek" class="col-sm-2 col-form-label">Nomor Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="nomor_pertek" id="nomor_pertek3" @if ($pertek3 == 1) name="nomor_pertek[]" required value="{{ $nomor_pertek3 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pertek" class="col-sm-2 col-form-label">Tanggal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" aria-label="tgl_pertek" id="tgl_pertek3" @if ($pertek3 == 1) name="tgl_pertek[]" required value="{{ $tgl_pertek3 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="perihal_pertek" class="col-sm-2 col-form-label">Perihal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="perihal_pertek" id="perihal_pertek3" @if ($pertek3 == 1) name="perihal_pertek[]" required value="{{ $perihal_pertek3 }}" @endif>
                        </div>
                    </div>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek4" id="pertek4" @if ($pertek4 == 1) checked @endif>
                    <label class="custom-control-label" for="pertek4">Andalalin</label>
                </div>

                <div class="mb-3" id="andalalin" @if ($pertek4 == 0) style="display: none" @endif>
                    <div class="form-group row">
                        <label for="judul_pertek" class="col-sm-2 col-form-label">Judul Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="judul_pertek" id="judul_pertek4" @if ($pertek4 == 1) name="judul_pertek[]" required value="{{ $judul_pertek4 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surat_pertek" class="col-sm-2 col-form-label">Surat Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="surat_pertek" id="surat_pertek4" @if ($pertek4 == 1) name="surat_pertek[]" required value="{{ $surat_pertek4 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pertek" class="col-sm-2 col-form-label">Nomor Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="nomor_pertek" id="nomor_pertek4" @if ($pertek4 == 1) name="nomor_pertek[]" required value="{{ $nomor_pertek4 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pertek" class="col-sm-2 col-form-label">Tanggal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" aria-label="tgl_pertek" id="tgl_pertek4" @if ($pertek4 == 1) name="tgl_pertek[]" required value="{{ $tgl_pertek4 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="perihal_pertek" class="col-sm-2 col-form-label">Perihal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="perihal_pertek" id="perihal_pertek4" @if ($pertek4 == 1) name="perihal_pertek[]" required value="{{ $perihal_pertek4 }}" @endif>
                        </div>
                    </div>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek5" id="pertek5" @if ($pertek5 == 1) checked @endif>
                    <label class="custom-control-label" for="pertek5">Dokumen Rincian Teknis</label>
                </div>

                <div class="mb-3" id="rintek" @if ($pertek5 == 0) style="display: none" @endif>
                    <div class="form-group row">
                        <label for="judul_pertek" class="col-sm-2 col-form-label">Judul Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="judul_pertek" id="judul_pertek5" @if ($pertek5 == 1) name="judul_pertek[]" required value="{{ $judul_pertek5 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surat_pertek" class="col-sm-2 col-form-label">Surat Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="surat_pertek" id="surat_pertek5" @if ($pertek5 == 1) name="surat_pertek[]" required value="{{ $surat_pertek5 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_pertek" class="col-sm-2 col-form-label">Nomor Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="nomor_pertek" id="nomor_pertek5" @if ($pertek5 == 1) name="nomor_pertek[]" required value="{{ $nomor_pertek5 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pertek" class="col-sm-2 col-form-label">Tanggal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" aria-label="tgl_pertek" id="tgl_pertek5" @if ($pertek5 == 1) name="tgl_pertek[]" required value="{{ $tgl_pertek5 }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="perihal_pertek" class="col-sm-2 col-form-label">Perihal Persetujuan Teknis</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="perihal_pertek" id="perihal_pertek5" @if ($pertek5 == 1) name="perihal_pertek[]" required value="{{ $perihal_pertek5 }}" @endif>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="rintek_upload">Upload dokumen yang diperlukan</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="rintek_upload" name="rintek_upload" aria-describedby="rintek_upload">
                            <label class="custom-file-label" for="rintek_upload">Choose file</label>
                        </div>
                    </div>
                    <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 5 mb </small>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek6" id="pertek6" @if ($pertek6 == 1) checked @endif>
                    <label class="custom-control-label" for="pertek6">Rincian Teknis Penyimpanan Limbah B3</label>
                </div>

                <div class="mb-3" id="rintek_limbah" @if ($pertek6 == 0) style="display: none" @endif>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="rintek_limbah_upload">Upload dokumen yang diperlukan</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="rintek_limbah_upload" name="rintek_limbah_upload" aria-describedby="rintek_limbah_upload">
                            <label class="custom-file-label" for="rintek_limbah_upload">Choose file</label>
                        </div>
                    </div>
                    <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 5 mb </small>
                </div>
                <hr>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<input type="text" value="{{ $jum }}" id="sum_il" hidden>
<input type="text" value="{{ count($skkl->kbli_baru) }}" id="sum_kbli" hidden>
<input type="text" value="{{ count($skkl->jenis_peraturan) }}" id="sum_perubahan" hidden>

<?php
    $prk1 = 0;
    $prk2 = 0;
    $prk3 = 0;
    $prk4 = 0;
    $prk5 = 0;
    foreach ($pertek_skkl as $row) {
        if ($row->pertek == "pertek1") {
            $prk1++;
        } elseif ($row->pertek == "pertek2") {
            $prk2++;
        } elseif ($row->pertek == "pertek3") {
            $prk3++;
        } elseif ($row->pertek == "pertek4") {
            $prk4++;
        } elseif ($row->pertek == "pertek5") {
            $prk5++;
        }
    }
?>
<input type="text" value="{{ $prk1 }}" id="jum_prk1" hidden>
<input type="text" value="{{ $prk2 }}" id="jum_prk2" hidden>
<input type="text" value="{{ $prk3 }}" id="jum_prk3" hidden>
<input type="text" value="{{ $prk4 }}" id="jum_prk4" hidden>
<input type="text" value="{{ $prk5 }}" id="jum_prk5" hidden>

<script>
    $('.js-kabkota-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $('.js-provinsi-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $('.regional-multiple').select2({
        dropdownCssClass: "select2--small",
    });

    $(document).ready(function() {
        var i = $('#sum_il').val();
        var j = $('#sum_perubahan').val();
        var k = $('#sum_kbli').val();

        $("#btn-detail").click(function() {
            $("#detail").fadeToggle("slow");
        });

        $(document).on('change', '#jenis_perubahan1', function () {
            if ($('#jenis_perubahan1').prop('checked', true)) {
                $('#lampiran').hide();
                $('#dari').show();
                $('#dasar_perubahan').show();
            }
        });

        $(document).on('change', '#jenis_perubahan2', function () {
            if ($('#jenis_perubahan2').prop('checked', true)) {
                $('#lampiran').show();
                $('#dari').show();
                $('#dasar_perubahan').show();
            }
        });

        $(document).on('change', '#jenis_perubahan3', function () {
            if ($('#jenis_perubahan3').prop('checked', true)) {
                $('#dari').hide();
                $('#dasar_perubahan').hide();
                $('#lampiran').show();
            }
        });

        $(document).on('change', '#pertek1', function() {
            if ($('#pertek1').is(":checked")) {
                $('#air_limbah').show();
                $('#judul_pertek1').attr('name', 'judul_pertek[]')
                $('#surat_pertek1').attr('name', 'surat_pertek[]')
                $('#nomor_pertek1').attr('name', 'nomor_pertek[]')
                $('#tgl_pertek1').attr('name', 'tgl_pertek[]')
                $('#perihal_pertek1').attr('name', 'perihal_pertek[]')
                $('#judul_pertek1').prop('required', true)
                $('#surat_pertek1').prop('required', true)
                $('#nomor_pertek1').prop('required', true)
                $('#tgl_pertek1').prop('required', true)
                $('#perihal_pertek1').prop('required', true)
            } else {
                $('#air_limbah').hide();
                $('#judul_pertek1').removeAttr('name')
                $('#surat_pertek1').removeAttr('name')
                $('#nomor_pertek1').removeAttr('name')
                $('#tgl_pertek1').removeAttr('name')
                $('#perihal_pertek1').removeAttr('name')
                $('#judul_pertek1').prop('required', false)
                $('#surat_pertek1').prop('required', false)
                $('#nomor_pertek1').prop('required', false)
                $('#tgl_pertek1').prop('required', false)
                $('#perihal_pertek1').prop('required', false)
            }
        });

        $(document).on('change', '#pertek2', function() {
            if ($('#pertek2').is(":checked")) {
                $('#emisi').show();
                $('#judul_pertek2').attr('name', 'judul_pertek[]')
                $('#surat_pertek2').attr('name', 'surat_pertek[]')
                $('#nomor_pertek2').attr('name', 'nomor_pertek[]')
                $('#tgl_pertek2').attr('name', 'tgl_pertek[]')
                $('#perihal_pertek2').attr('name', 'perihal_pertek[]')
                $('#judul_pertek2').prop('required', true)
                $('#surat_pertek2').prop('required', true)
                $('#nomor_pertek2').prop('required', true)
                $('#tgl_pertek2').prop('required', true)
                $('#perihal_pertek2').prop('required', true)
            } else {
                $('#emisi').hide();
                $('#judul_pertek2').removeAttr('name')
                $('#surat_pertek2').removeAttr('name')
                $('#nomor_pertek2').removeAttr('name')
                $('#tgl_pertek2').removeAttr('name')
                $('#perihal_pertek2').removeAttr('name')
                $('#judul_pertek2').prop('required', false)
                $('#surat_pertek2').prop('required', false)
                $('#nomor_pertek2').prop('required', false)
                $('#tgl_pertek2').prop('required', false)
                $('#perihal_pertek2').prop('required', false)
            }
        });

        $(document).on('change', '#pertek3', function() {
            if ($('#pertek3').is(":checked")) {
                $('#limbah_b3').show();
                $('#judul_pertek3').attr('name', 'judul_pertek[]')
                $('#surat_pertek3').attr('name', 'surat_pertek[]')
                $('#nomor_pertek3').attr('name', 'nomor_pertek[]')
                $('#tgl_pertek3').attr('name', 'tgl_pertek[]')
                $('#perihal_pertek3').attr('name', 'perihal_pertek[]')
                $('#judul_pertek3').prop('required', true)
                $('#surat_pertek3').prop('required', true)
                $('#nomor_pertek3').prop('required', true)
                $('#tgl_pertek3').prop('required', true)
                $('#perihal_pertek3').prop('required', true)
            } else {
                $('#limbah_b3').hide();
                $('#judul_pertek3').removeAttr('name')
                $('#surat_pertek3').removeAttr('name')
                $('#nomor_pertek3').removeAttr('name')
                $('#tgl_pertek3').removeAttr('name')
                $('#perihal_pertek3').removeAttr('name')
                $('#judul_pertek3').prop('required', false)
                $('#surat_pertek3').prop('required', false)
                $('#nomor_pertek3').prop('required', false)
                $('#tgl_pertek3').prop('required', false)
                $('#perihal_pertek3').prop('required', false)
            }
        });

        $(document).on('change', '#pertek4', function() {
            if ($('#pertek4').is(":checked")) {
                $('#andalalin').show();
                $('#judul_pertek4').attr('name', 'judul_pertek[]')
                $('#surat_pertek4').attr('name', 'surat_pertek[]')
                $('#nomor_pertek4').attr('name', 'nomor_pertek[]')
                $('#tgl_pertek4').attr('name', 'tgl_pertek[]')
                $('#perihal_pertek4').attr('name', 'perihal_pertek[]')
                $('#judul_pertek4').prop('required', true)
                $('#surat_pertek4').prop('required', true)
                $('#nomor_pertek4').prop('required', true)
                $('#tgl_pertek4').prop('required', true)
                $('#perihal_pertek4').prop('required', true)
            } else {
                $('#andalalin').hide();
                $('#judul_pertek4').removeAttr('name')
                $('#surat_pertek4').removeAttr('name')
                $('#nomor_pertek4').removeAttr('name')
                $('#tgl_pertek4').removeAttr('name')
                $('#perihal_pertek4').removeAttr('name')
                $('#judul_pertek4').prop('required', false)
                $('#surat_pertek4').prop('required', false)
                $('#nomor_pertek4').prop('required', false)
                $('#tgl_pertek4').prop('required', false)
                $('#perihal_pertek4').prop('required', false)
            }
        });

        $(document).on('change', '#pertek5', function() {
            if ($('#pertek5').is(":checked")) {
                $('#rintek').show();
                $('#judul_pertek5').attr('name', 'judul_pertek[]')
                $('#surat_pertek5').attr('name', 'surat_pertek[]')
                $('#nomor_pertek5').attr('name', 'nomor_pertek[]')
                $('#tgl_pertek5').attr('name', 'tgl_pertek[]')
                $('#perihal_pertek5').attr('name', 'perihal_pertek[]')
                $('#judul_pertek5').prop('required', true)
                $('#surat_pertek5').prop('required', true)
                $('#nomor_pertek5').prop('required', true)
                $('#tgl_pertek5').prop('required', true)
                $('#perihal_pertek5').prop('required', true)
            } else {
                $('#rintek').hide();
                $('#judul_pertek5').removeAttr('name')
                $('#surat_pertek5').removeAttr('name')
                $('#nomor_pertek5').removeAttr('name')
                $('#tgl_pertek5').removeAttr('name')
                $('#perihal_pertek5').removeAttr('name')
                $('#judul_pertek5').prop('required', false)
                $('#surat_pertek5').prop('required', false)
                $('#nomor_pertek5').prop('required', false)
                $('#tgl_pertek5').prop('required', false)
                $('#perihal_pertek5').prop('required', false)
            }
        });

        $(document).on('change', '#pertek6', function() {
            if ($('#pertek6').is(":checked")) {
                $('#rintek_limbah').show();
            } else {
                $('#rintek_limbah').hide();
            }
        });

        $('#add-kbli').click(function() {
            k++
            $('.table-kbli').append(`<tr id="kbli-claster${k}">
                                        <td>${k}</td>
                                        <td>
                                            <input type="text" name="nama_kbli[]" class="form-control" placeholder="Ketik jenis usaha/kegiatan">
                                        </td>
                                        <td>
                                            <input type="text" name="nomor_kbli[]" class="form-control" placeholder="Nomor KBLI">
                                        </td>
                                    </tr>
            `)
        });

        $(document).on('click', '.remove-kbli', function() {
            var button_id = k;
            $('#kbli-claster' + button_id + '').remove();
            k--
        });

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

        var prt1 = $('#jum_prk1').val();

            $('#add-pertek1').click(function() {
                prt1++
                $('.table-pertek1').append(`
                    <tr id="prt1-${prt1}">
                        <input type="text" name="pertek[]" value="pertek1" hidden>
                        <td>${prt1}</td>
                        <td>
                            <input type="text" class="form-control" id="judul_pertek1" name="judul_pertek[]" required placeholder="Judul Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek1" name="surat_pertek[]" required placeholder="Surat Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek1" name="nomor_pertek[]" required placeholder="nomor Persetujuan">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek1" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan">
                        </td>
                        <td>
                            <textarea class="form-control" id="perihal_pertek1" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek1', function() {
                var button_id = prt1;
                $('#prt1-' + button_id + '').remove();
                prt1--
            });

            // jquery pertek 2
            var prt2 = $('#jum_prk2').val();

            $('#add-pertek2').click(function() {
                prt2++
                $('.table-pertek2').append(`
                    <tr id="prt2-${prt2}">
                        <input type="text" name="pertek[]" value="pertek2" hidden>
                        <td>${prt2}</td>
                        <td>
                            <input type="text" class="form-control" id="judul_pertek2" name="judul_pertek[]" required placeholder="Judul Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek2" name="surat_pertek[]" required placeholder="Surat Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek2" name="nomor_pertek[]" required placeholder="nomor Persetujuan">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek2" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan">
                        </td>
                        <td>
                            <textarea class="form-control" id="perihal_pertek2" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek2', function() {
                var button_id = prt2;
                $('#prt2-' + button_id + '').remove();
                prt2--
            });

            // jquery pertek 3
            var prt3 = $('#jum_prk3').val();

            $('#add-pertek3').click(function() {
                prt3++
                $('.table-pertek3').append(`
                    <tr id="prt3-${prt3}">
                        <input type="text" name="pertek[]" value="pertek3" hidden>
                        <td>${prt3}</td>
                        <td>
                            <input type="text" class="form-control" id="judul_pertek3" name="judul_pertek[]" required placeholder="Judul Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek3" name="surat_pertek[]" required placeholder="Surat Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek3" name="nomor_pertek[]" required placeholder="nomor Persetujuan">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek3" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan">
                        </td>
                        <td>
                            <textarea class="form-control" id="perihal_pertek3" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek3', function() {
                var button_id = prt3;
                $('#prt3-' + button_id + '').remove();
                prt3--
            });
            // jquery pertek 4
            var prt4 = $('#jum_prk4').val();

            $('#add-pertek4').click(function() {
                prt4++
                $('.table-pertek4').append(`
                    <tr id="prt4-${prt4}">
                        <input type="text" name="pertek[]" value="pertek4" hidden>
                        <td>${prt4}</td>
                        <td>
                            <input type="text" class="form-control" id="judul_pertek4" name="judul_pertek[]" required placeholder="Judul Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek4" name="surat_pertek[]" required placeholder="Surat Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek4" name="nomor_pertek[]" required placeholder="nomor Persetujuan">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek4" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan">
                        </td>
                        <td>
                            <textarea class="form-control" id="perihal_pertek4" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek4', function() {
                var button_id = prt4;
                $('#prt4-' + button_id + '').remove();
                prt4--
            });

            // jquery pertek 5
            var prt5 = $('#jum_prk5').val();

            $('#add-pertek5').click(function() {
                prt5++
                $('.table-pertek5').append(`
                    <tr id="prt5-${prt5}">
                        <input type="text" name="pertek[]" value="pertek5" hidden>
                        <td>${prt5}</td>
                        <td>
                            <input type="text" class="form-control" id="judul_pertek5" name="judul_pertek[]" required placeholder="Judul Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek5" name="surat_pertek[]" required placeholder="Surat Persetujuan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek5" name="nomor_pertek[]" required placeholder="nomor Persetujuan">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek5" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan">
                        </td>
                        <td>
                            <textarea class="form-control" id="perihal_pertek5" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek5', function() {
                var button_id = prt5;
                $('#prt5-' + button_id + '').remove();
                prt5--
            });
    });
</script>
@endsection
