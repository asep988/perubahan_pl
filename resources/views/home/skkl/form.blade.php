@extends('template.master')

@section('content')
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <div class="card">
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
                            <h4><b>Form Input Permohonan Perubahan SKKL</b></h4>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    @include('layouts.navbar')
                </div>

            </nav>
        </div>

        <div class="card-body">
            @if (session()->has('pesan'))
                <div class="alert alert-success" role="alert">
                    {{ session('pesan') }}
                </div>
            @endif
            @error('rintek_upload')
                <div class="alert alert-danger" role="alert">
                    File belum terupload!
                </div>
            @enderror
            @error('rintek_limbah_upload')
                <div class="alert alert-danger" role="alert">
                    File belum terupload!
                </div>
            @enderror
            <form action="{{ route('skkl.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h5><b>Pilih Jenis Perubahan:</b></h5>

                <div class="btn-group btn-group-toggle mb-3 btn-block" data-toggle="buttons">
                    <label class="btn btn-success">
                        <input type="radio" name="jenis_perubahan" id="jenis_perubahan1" value="perkep1"> Perubahan
                        Kepemilikkan
                    </label>
                    <label class="btn btn-success">
                        <input type="radio" name="jenis_perubahan" id="jenis_perubahan2" value="perkep2" checked>
                        Perubahan Kepemilikkan dan Integrasi Pertek/Rintek
                    </label>
                    <label class="btn btn-success">
                        <input type="radio" name="jenis_perubahan" id="jenis_perubahan3" value="perkep3"> Integrasi
                        Pertek/Rintek
                    </label>
                </div>

                <table border="1" width="100%" class="mb-3">
                    <tr>
                        <!-- dari -->
                        <td style="padding: 20px;" class="align-top" id="dari">
                            <div class="">
                                <span>Dari :</span>
                                <div class="input-box">
                                    <br>
                                    <label for="pelaku_usaha" class="form-label">Nama Pelaku Usaha/Kegiatan</label>
                                    <div>
                                        <input type="text" class="form-control" name="pelaku_usaha"
                                            value="{{ $initiator[0]->name }}">
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="penanggung" class="form-label">Penanggung Jawab Usaha/Kegiatan</label>
                                    <input type="text" class="form-control" name="penanggung"
                                        value="{{ $initiator[0]->pic }}">
                                </div>
                                <div class="input-box">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan"
                                        value="{{ $initiator[0]->pic_role }}">
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
                                        <input type="text" class="form-control" name="pelaku_usaha_baru" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="nama_usaha_baru" class="form-label">Nama Usaha/Kegiatan</label>
                                    <div>
                                        <textarea class="form-control" id="nama_usaha_baru" name="nama_usaha_baru" rows="3"
                                            placeholder="Tuliskan judul nama usaha/kegiatan lengkap beserta alamat lokasi kegiatannya" required></textarea>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="penanggung_baru" class="form-label">Penanggung Jawab
                                        Usaha/Kegiatan</label>
                                    <input type="text" class="form-control" name="penanggung_baru" required>
                                </div>
                                <div class="input-box">
                                    <label for="nib_baru" class="form-label">NIB</label>
                                    <input type="text" class="form-control" name="nib_baru" required>
                                </div>
                                <div class="input-box">
                                    <label for="jabatan_baru" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_baru" required>
                                </div>
                                <div class="input-box">
                                    <label for="alamat_baru" class="form-label">Alamat Kantor/Kegiatan</label>
                                    <textarea class="form-control" id="alamat_baru" name="alamat_baru" rows="3" required></textarea>
                                </div>
                                <div class="input-box">
                                    <label for="lokasi_baru" class="form-label">Lokasi Usaha/Kegiatan</label>
                                    <textarea class="form-control" id="lokasi_baru" name="lokasi_baru" rows="3" required></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="mb-3">
                    <!-- Provinsi, Kabupaten & Kota, Bukti Perubahan -->
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
                                        <tr id="kbli-claster1">
                                            <td>1</td>
                                            <td>
                                                <input type="text" name="nama_kbli[]" class="form-control"
                                                    placeholder="Ketik jenis usaha/kegiatan">
                                            </td>
                                            <td>
                                                <input type="text" name="nomor_kbli[]" class="form-control"
                                                    placeholder="Ketik kode KBLI">
                                            </td>
                                        </tr>
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
                            <select class="js-provinsi-multiple" multiple="multiple" style="width: 100%"
                                name="provinsi[]" id="provinsi" required>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province }}">{{ $province->province }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kabupaten_kota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                        <div class="col-sm-8">
                            <select class="js-kabkota-multiple" multiple="multiple" style="width: 100%"
                                name="kabupaten_kota[]" id="kabupaten_kota" required>
                                @foreach ($regencies as $regency)
                                    <option value="{{ $regency->regency }}">{{ $regency->regency }}</option>
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
                                <span><br> 4. NIB beserta lampirannya (KBLI dan lokasi usaha kegiatan sesuai dengan usaha/kegiatan yg diajukan
                                    perubahan PL-nya harus termuat di dalam dokumen NIB)</span>
                                <span><br> 5. Akta Notaris Perubahan Kepemikan</span>
                                <span><br> 6. RKL-RPL dalam Bentuk Word</span>
                                <span><br> 7. Izin PPLH atau Persetujuan Teknis (Pembuangan Air Limbah, Emisi, Persetujuan
                                    Andalalin) yang telah dimiliki</span>
                                <span><br> 8. Rincian Teknis Penyimpanan Limbah B3 dalam bentuk Word</span>
                                <span><br> 9. Rincian Teknis Penyimpanan Limbah Non B3 (optional bila melakukan penyimpanan
                                    limbah non B3)</span>
                                <span><br> 10. Pastikan Link Google Drive anda Bisa diakses Oleh Publik</span>
                            </div>
                            <input type="text" style="width: 100%" class="form-control" id="link_drive"
                                name="link_drive" placeholder="Link Google Drive" required>
                        </div>
                        <div class="col-sm-2 ml-0">
                            <button type="button" class="btn btn-warning" id="btn-detail"><i class="fa fa-info fa-sm"></i>&nbsp; Detail</button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="region" class="col-sm-2 col-form-label">Region Lokasi Usaha/Kegiatan</label>
                        <div class="col-sm-8">
                            <select class="regional-multiple" multiple="multiple" style="width: 100%" name="region"
                                id="region" required>
                                <option value="Sumatera">Sumatera</option>
                                <option value="Jawa">Jawa</option>
                                <option value="Kalimantan">Kalimantan</option>
                                <option value="Bali Nusa Tenggara">Bali Nusa Tenggara</option>
                                <option value="Sulawesi Maluku">Sulawesi Maluku</option>
                                <option value="Papua">Papua</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pic_pemohon" class="col-sm-2 col-form-label">Nama PIC</label>
                        <div class="col-sm-8">
                            <input type="text" style="width: 100%" class="form-control" id="pic_pemohon"
                                name="pic_pemohon" placeholder="Nama Lengkap PIC" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_hp_pic" class="col-sm-2 col-form-label">Nomor PIC (Nomor WA aktif)</label>
                        <div class="col-sm-8">
                            <input type="text" style="width: 100%" class="form-control" id="no_hp_pic"
                                name="no_hp_pic" placeholder="Nomor Telepon PIC" required>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="mb-3">
                    <!-- Surat Permohonan Perubahan PL & Peraturan Pemerintah Daerah -->
                    <label><b>Surat Permohonan Perubahan PL :</b></label>

                    <div class="form-group row">
                        <label for="nomor_pl" class="col-sm-2 col-form-label">Nomor</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="nomor_pl" name="nomor_pl"
                                placeholder="Masukkan Nomor PL" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_pl" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="date" id="tgl_pl" name="tgl_pl" placeholder="yyyy/mm/dd" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="perihal_surat" class="col-sm-2 col-form-label">Perihal</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="perihal_surat" id="perihal_surat"
                                name="perihal_surat">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pejabat" class="col-sm-2 col-form-label">Pejabat yang menandatangani</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="pejabat" id="pejabat"
                                name="pejabat_pl">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_validasi" class="col-sm-2 col-form-label">Nomor Bukti Validasi Administrasi
                            PTSP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" aria-label="nomor_validasi" id="nomor_validasi" name="nomor_validasi" required>
                            <small class="text-muted">Silakan isi dengan tanda "<b>-</b>" jika belum ada, dan perbarui kembali data jika sudah diproses di PTSP</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_validasi" class="col-sm-2 col-form-label">Tanggal Validasi</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="date" id="tgl_validasi" name="tgl_validasi" placeholder="yyyy/mm/dd" required>
                            <small class="text-muted">Jika belum ada, silakan isi dengan tanggal hari ini dan perbarui kembali data jika sudah diproses di PTSP</small>
                        </div>
                    </div>

                    <div id="dasar_perubahan">
                        <hr>
                        <span><b>Dasar Perubahan Kepemilikan</b></span><br>
                        <label><b>Contoh : </b>
                            <ol>
                                <li>Jenis Dasar Perubahan : Surat/Akta Notaris/SK</li>
                                <li>Pejabat Yang Mengesahkan : Gubernur Jawa Timur</li>
                                <li>Nomor Surat: 40 Tahun 2021</li>
                                <li>Perihal/Tentang : Penugasan Kepada PT Jatim Grha Utama sebagai Pengelola Pusat
                                    Pengelolaan Sampah dan Limbah Bahan Berbahaya dan Beracun Jawa Timur.</li>
                            </ol>
                        </label>

                        <div class="form-group row">
                            <table border="1" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Jenis Dasar Perubahan</th>
                                        <th>Pejabat yang mengesahkan</th>
                                        <th>Nomor Surat</th>
                                        <th>Perihal/Tentang</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody class="table-input1">
                                    <tr id="1Claster1">
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
                                        <td class="text-center">
                                            <button type="button" id="1" class="btn remove-btn1 btn-sm btn-danger">
                                                <i class="fas fa-minus fa-sm"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-1">
                                <button type="button" id="add1" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <!-- IL SKKL -->
                    <span><b>Sebutkan IL, SKKL, Persetujuan UKL-UPL, Persetujuan DELH, Persetujuan DPLH yang telah
                            dimiliki</b></span><br>
                    <label><b>Contoh : </b>
                        <ol>
                            <li>Jenis Izin Persetujuan : Surat/Keputusan/Ketetapan</li>
                            <li>Pejabat Yang Mengesahkan : Kepala Dinas Pertambangan dan Lingkungan Hidup Kabupaten Sorong
                            </li>
                            <li>Nomor SK : 660.1/113/2012</li>
                            <li>Tanggal Surat : 16/05/2012</li>
                            <li>Perihal/Tentang : UKL dan UPL Kegiatan Pemrduksian Sumur Walio Ext-1 (POP) di Blok Kepala
                                Burung Kabupaten Sorong Provinsi Papua Barat.</li>
                        </ol>
                    </label>

                    <div class="form-group row">
                        <table border="1" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>Jenis Izin Persetujuan</th>
                                    <th>Pejabat yang mengesahkan</th>
                                    <th>Nomor SK</th>
                                    <th>Tanggal Surat</th>
                                    <th>Perihal/Tentang</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="table-input2">
                                <tr id="2Claster1">
                                    <td>
                                        <input type="text" name="jenis_izin[]" class="form-control"
                                            placeholder="Surat/Keputusan/Ketetapan">
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
                                    <td class="text-center">
                                        <button type="button" id="1" class="btn remove-btn2 btn-sm btn-danger">
                                            <i class="fas fa-minus fa-sm"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-1">
                            <button type="button" id="add2" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <hr>
                <label>
                    <b>Sebutkan Ruang Lingkup (sebutkan ruang lingkup usaha dan/kegiatan yang akan di muat di dalam SK)</b>
                    <button type="button" class="ml-2 btn btn-sm btn-warning" id="btn-detail-rl"><i class="fa fa-info fa-sm"></i>&nbsp; Detail</button>
                </label>
                <div class="form-group row">
                    <div style="display: none" class="alert alert-warning ml-2" role="alert" id="detail-rl">
                        <span>Muatan Ruang Lingkup antara lain mencakup:</span>
                    <span><br> 1. Informasi Skala/besaran, seperti: luas / panjang</span>
                    <span><br> 2. Data / tabel koordinat</span>
                    <span><br> 3. Kapasitas / jenis usaha / kegiatan</span>
                    <span><br> 4. Sumber energi listrik dan air (jika ada)</span>
                    <span><br> 5. Limbah yang dihasilkan serta jenis pengelolaan (Jika ada)</span>
                    <span><br> 6. Masukkan Tabel Koordinat Lokasi</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="ruang_lingkup"></textarea>
                    </div>
                </div>

                <hr>

                <div>
                    <!-- Lampiran I Pendekatan Pengelolaan Lingkungan -->
                    <label><b>Lampiran II Pendekatan Pengelolaan Lingkungan</b></label>

                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Teknologi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_tek"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Sosial & Ekonomi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_sos"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Pendekatan Institusi</label>
                            <textarea class="form-control" id="mytextarea" aria-label="editor" name="pend_institut"></textarea>
                        </div>
                    </div>
                </div>
                <hr>

                <div id="lampiran">
                    <!-- Lampiran Persetujuan Teknis -->
                    <label><b>Lampiran Persetujuan Teknis</b></label>
                    {{-- pertek 1 --}}
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pertek1">
                        <label class="custom-control-label" for="pertek1">Air Limbah</label>
                    </div>

                    <div class="mb-3" id="air_limbah" style="display: none">
                        <div class="form-group row">
                            <table border="1" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Surat Persetujuan Teknis</th>
                                        <th>Nomor Persetujuan Teknis</th>
                                        <th>Tanggal Persetujuan Teknis</th>
                                        <th>Perihal Persetujuan Teknis</th>
                                    </tr>
                                </thead>
                                <tbody class="table-pertek1">
                                    <tr id="prt1-1">
                                        <td>1
                                            <input type="text" id="name_pertek1" value="pertek1" hidden>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="surat_pertek1" placeholder="Surat Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="nomor_pertek1" placeholder="Nomor Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="tgl_pertek1" placeholder="Tanggal Persetujuan Teknis">
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
                    </div>
                    {{-- pertek 2 --}}
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pertek2">
                        <label class="custom-control-label" for="pertek2">Emisi</label>
                    </div>

                    <div class="mb-3" id="emisi" style="display: none">
                        <div class="form-group row">
                            <table border="1" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Surat Persetujuan Teknis</th>
                                        <th>Nomor Persetujuan Teknis</th>
                                        <th>Tanggal Persetujuan Teknis</th>
                                        <th>Perihal Persetujuan Teknis</th>
                                    </tr>
                                </thead>
                                <tbody class="table-pertek2">
                                    <tr id="prt2-1">
                                        <td>1
                                            <input type="text" id="name_pertek2" value="pertek2" hidden>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="surat_pertek2" placeholder="Surat Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="nomor_pertek2" placeholder="Nomor Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="tgl_pertek2" placeholder="Tanggal Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="perihal_pertek2" rows="2"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-1">
                                <button type="button" id="remove-pertek2" class="btn remove-pertek2 btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                                <button type="button" id="add-pertek2" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- pertek 3 --}}
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pertek3">
                        <label class="custom-control-label" for="pertek3">Pengelolaan Limbah B3</label>
                    </div>

                    <div class="mb-3" id="limbah_b3" style="display: none">
                        <div class="form-group row">
                            <table border="1" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Surat Persetujuan Teknis</th>
                                        <th>Nomor Persetujuan Teknis</th>
                                        <th>Tanggal Persetujuan Teknis</th>
                                        <th>Perihal Persetujuan Teknis</th>
                                    </tr>
                                </thead>
                                <tbody class="table-pertek3">
                                    <tr id="prt3-1">
                                        <td>1
                                            <input type="text" id="name_pertek3" value="pertek3" hidden>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="surat_pertek3" placeholder="Surat Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="nomor_pertek3" placeholder="Nomor Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="tgl_pertek3" placeholder="Tanggal Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="perihal_pertek3" rows="2"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-1">
                                <button type="button" id="remove-pertek3" class="btn remove-pertek3 btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                                <button type="button" id="add-pertek3" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- pertek 4 --}}
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pertek4">
                        <label class="custom-control-label" for="pertek4">Andalalin</label>
                    </div>

                    <div class="mb-3" id="andalalin" style="display: none">
                        <div class="form-group row">
                            <table border="1" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Surat Persetujuan Teknis</th>
                                        <th>Nomor Persetujuan Teknis</th>
                                        <th>Tanggal Persetujuan Teknis</th>
                                        <th>Perihal Persetujuan Teknis</th>
                                    </tr>
                                </thead>
                                <tbody class="table-pertek4">
                                    <tr id="prt4-1">
                                        <td>1
                                            <input type="text" id="name_pertek4" value="pertek4" hidden>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="surat_pertek4" placeholder="Surat Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="nomor_pertek4" placeholder="Nomor Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="tgl_pertek4" placeholder="Tanggal Persetujuan Teknis">
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="perihal_pertek4" rows="2"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-1">
                                <button type="button" id="remove-pertek4" class="btn remove-pertek4 btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                                <button type="button" id="add-pertek4" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <label><b>Lampiran Rincian Teknis</b></label>
                    {{-- pertek 5 --}}
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pertek5">
                        <label class="custom-control-label" for="pertek5">Dokumen Rincian Teknis Pengelolaan Limbah Non B3</label>
                    </div>

                    <div class="mb-3" id="rintek" style="display: none">
                        <div class="form-group row">

                            <div class="custom-control custom-checkbox ml-5">
                                <input type="checkbox" class="custom-control-input" id="rintek1" name="surat_pertek[]" value="Penyimpanan">
                                <label class="custom-control-label" for="rintek1">Dokumen Rincian Teknis Pengelolaan Limbah Non-B3 untuk Kegiatan Penyimpanan</label>
                            </div>

                            <div class="input-group mt-1 ml-5">
                                <div id="rintek1_form" style="display: none">
                                    <input type="text" id="rintek1_data" value="pertek5" hidden>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="rintek_upload1">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('rintek_upload1') is-invalid @enderror" id="rintek_upload1" name="rintek_upload1" aria-describedby="rintek_upload1">
                                            <label class="custom-file-label" for="rintek_upload1">Choose file</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 15 mb </small>
                                </div>
                            </div>

                            <div class="custom-control custom-checkbox ml-5 mt-3">
                                <input type="checkbox" class="custom-control-input" id="rintek2" name="surat_pertek[]" value="Pemanfaatan">
                                <label class="custom-control-label" for="rintek2">Dokumen Rincian Teknis Pengelolaan Limbah Non-B3 untuk Kegiatan Pemanfaatan</label>
                            </div>
                            <div class="input-group mt-1 ml-5">
                                <div id="rintek2_form" style="display: none;">
                                    <input type="text" id="rintek2_data" value="pertek5" hidden>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="rintek_upload2">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('rintek_upload2') is-invalid @enderror" id="rintek_upload2" name="rintek_upload2" aria-describedby="rintek_upload2">
                                            <label class="custom-file-label" for="rintek_upload2">Choose file</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 15 mb </small>
                                </div>
                            </div>

                            <div class="custom-control custom-checkbox ml-5 mt-3">
                                <input type="checkbox" class="custom-control-input" id="rintek3" name="surat_pertek[]" value="Penimbunan">
                                <label class="custom-control-label" for="rintek3">Dokumen Rincian Teknis Pengelolaan Limbah Non-B3 untuk Kegiatan Penimbunan</label>
                            </div>
                            <div class="input-group mt-1 ml-5">
                                <div id="rintek3_form" style="display: none">
                                    <input type="text" id="rintek3_data" value="pertek5" hidden>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="rintek_upload3">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('rintek_upload3') is-invalid @enderror" id="rintek_upload3" name="rintek_upload3" aria-describedby="rintek_upload3">
                                            <label class="custom-file-label" for="rintek_upload3">Choose file</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 15 mb </small>
                                </div>
                            </div>

                            <div class="custom-control custom-checkbox ml-5 mt-3">
                                <input type="checkbox" class="custom-control-input" id="rintek4" name="surat_pertek[]" value="Pengurangan">
                                <label class="custom-control-label" for="rintek4">Dokumen Rincian Teknis Pengelolaan Limbah Non-B3 untuk Kegiatan Pengurangan</label>
                            </div>
                            <div class="input-group mt-1 ml-5">
                                <div id="rintek4_form" style="display: none">
                                    <input type="text" id="rintek4_data" value="pertek5" hidden>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="rintek_upload4">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('rintek_upload4') is-invalid @enderror" id="rintek_upload4" name="rintek_upload4" aria-describedby="rintek_upload4">
                                            <label class="custom-file-label" for="rintek_upload4">Choose file</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 15 mb </small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="pertek[]" value="pertek6" id="pertek6">
                        <label class="custom-control-label" for="pertek6">Rincian Teknis Penyimpanan Limbah B3</label>
                    </div>

                    <div class="mb-3" id="rintek_limbah" style="display: none">
                        <div class="input-group mt-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="rintek_limbah_upload">Upload dokumen yang
                                    diperlukan</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('rintek_limbah_upload') is-invalid @enderror" id="rintek_limbah_upload" name="rintek_limbah_upload" aria-describedby="rintek_limbah_upload">
                                <label class="custom-file-label" for="rintek_limbah_upload">Choose file</label>
                            </div>
                        </div>
                        <small class="text-muted">Format: DOCX, DOC | Ukuran Maksimal: 10 mb </small>
                    </div>
                    <hr>
                </div>

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

        $('.regional-multiple').select2({
            dropdownCssClass: "select2--small",
        });

        $(document).ready(function() {
            var i = 1;
            var j = 1;
            var k = 1;

            $("#btn-detail").click(function() {
                $("#detail").fadeToggle("slow");
            });

            $("#btn-detail-rl").click(function() {
                $("#detail-rl").fadeToggle("slow");
            });

            $(document).on('change', '#jenis_perubahan1', function() {
                if ($('#jenis_perubahan1').prop('checked', true)) {
                    $('#lampiran').hide();
                    $('#dari').show();
                    $('#dasar_perubahan').show();
                }
            });

            $(document).on('change', '#jenis_perubahan2', function() {
                if ($('#jenis_perubahan2').prop('checked', true)) {
                    $('#lampiran').show();
                    $('#dari').show();
                    $('#dasar_perubahan').show();
                }
            });

            $(document).on('change', '#jenis_perubahan3', function() {
                if ($('#jenis_perubahan3').prop('checked', true)) {
                    $('#dari').hide();
                    $('#dasar_perubahan').hide();
                    $('#lampiran').show();
                }
            });

            $(document).on('change', '#pertek1', function() {
                if ($('#pertek1').is(":checked")) {
                    $('#air_limbah').show();
                    $('#name_pertek1').attr('name', 'pertek[]')
                    $('#surat_pertek1').attr('name', 'surat_pertek[]')
                    $('#nomor_pertek1').attr('name', 'nomor_pertek[]')
                    $('#tgl_pertek1').attr('name', 'tgl_pertek[]')
                    $('#perihal_pertek1').attr('name', 'perihal_pertek[]')
                    $('#surat_pertek1').prop('required', true)
                    $('#nomor_pertek1').prop('required', true)
                    $('#tgl_pertek1').prop('required', true)
                    $('#perihal_pertek1').prop('required', true)
                } else {
                    $('#air_limbah').hide();
                    $('#name_pertek1').removeAttr('name')
                    $('#surat_pertek1').removeAttr('name')
                    $('#nomor_pertek1').removeAttr('name')
                    $('#tgl_pertek1').removeAttr('name')
                    $('#perihal_pertek1').removeAttr('name')
                    $('#surat_pertek1').prop('required', false)
                    $('#nomor_pertek1').prop('required', false)
                    $('#tgl_pertek1').prop('required', false)
                    $('#perihal_pertek1').prop('required', false)
                }
            });

            $(document).on('change', '#pertek2', function() {
                if ($('#pertek2').is(":checked")) {
                    $('#emisi').show();
                    $('#name_pertek2').attr('name', 'pertek[]')
                    $('#surat_pertek2').attr('name', 'surat_pertek[]')
                    $('#nomor_pertek2').attr('name', 'nomor_pertek[]')
                    $('#tgl_pertek2').attr('name', 'tgl_pertek[]')
                    $('#perihal_pertek2').attr('name', 'perihal_pertek[]')
                    $('#surat_pertek2').prop('required', true)
                    $('#nomor_pertek2').prop('required', true)
                    $('#tgl_pertek2').prop('required', true)
                    $('#perihal_pertek2').prop('required', true)
                } else {
                    $('#emisi').hide();
                    $('#name_pertek2').removeAttr('name')
                    $('#surat_pertek2').removeAttr('name')
                    $('#nomor_pertek2').removeAttr('name')
                    $('#tgl_pertek2').removeAttr('name')
                    $('#perihal_pertek2').removeAttr('name')
                    $('#surat_pertek2').prop('required', false)
                    $('#nomor_pertek2').prop('required', false)
                    $('#tgl_pertek2').prop('required', false)
                    $('#perihal_pertek2').prop('required', false)
                }
            });

            $(document).on('change', '#pertek3', function() {
                if ($('#pertek3').is(":checked")) {
                    $('#limbah_b3').show();
                    $('#name_pertek3').attr('name', 'pertek[]')
                    $('#surat_pertek3').attr('name', 'surat_pertek[]')
                    $('#nomor_pertek3').attr('name', 'nomor_pertek[]')
                    $('#tgl_pertek3').attr('name', 'tgl_pertek[]')
                    $('#perihal_pertek3').attr('name', 'perihal_pertek[]')
                    $('#surat_pertek3').prop('required', true)
                    $('#nomor_pertek3').prop('required', true)
                    $('#tgl_pertek3').prop('required', true)
                    $('#perihal_pertek3').prop('required', true)
                } else {
                    $('#limbah_b3').hide();
                    $('#name_pertek3').removeAttr('name')
                    $('#surat_pertek3').removeAttr('name')
                    $('#nomor_pertek3').removeAttr('name')
                    $('#tgl_pertek3').removeAttr('name')
                    $('#perihal_pertek3').removeAttr('name')
                    $('#surat_pertek3').prop('required', false)
                    $('#nomor_pertek3').prop('required', false)
                    $('#tgl_pertek3').prop('required', false)
                    $('#perihal_pertek3').prop('required', false)
                }
            });

            $(document).on('change', '#pertek4', function() {
                if ($('#pertek4').is(":checked")) {
                    $('#andalalin').show();
                    $('#name_pertek4').attr('name', 'pertek[]')
                    $('#surat_pertek4').attr('name', 'surat_pertek[]')
                    $('#nomor_pertek4').attr('name', 'nomor_pertek[]')
                    $('#tgl_pertek4').attr('name', 'tgl_pertek[]')
                    $('#perihal_pertek4').attr('name', 'perihal_pertek[]')
                    $('#surat_pertek4').prop('required', true)
                    $('#nomor_pertek4').prop('required', true)
                    $('#tgl_pertek4').prop('required', true)
                    $('#perihal_pertek4').prop('required', true)
                } else {
                    $('#andalalin').hide();
                    $('#name_pertek4').removeAttr('name')
                    $('#surat_pertek4').removeAttr('name')
                    $('#nomor_pertek4').removeAttr('name')
                    $('#tgl_pertek4').removeAttr('name')
                    $('#perihal_pertek4').removeAttr('name')
                    $('#surat_pertek4').prop('required', false)
                    $('#nomor_pertek4').prop('required', false)
                    $('#tgl_pertek4').prop('required', false)
                    $('#perihal_pertek4').prop('required', false)
                }
            });

            $(document).on('change', '#pertek5', function() {
                if ($('#pertek5').is(":checked")) {
                    $('#rintek').show();
                } else {
                    $('#rintek').hide();
                }
            });

            $(document).on('change', '#pertek6', function() {
                if ($('#pertek6').is(":checked")) {
                    $('#rintek_limbah').show();
                } else {
                    $('#rintek_limbah').hide();
                }
            });

            $(document).on('change', '#rintek1', function() {
                if ($('#rintek1').is(":checked")) {
                    $('#rintek1_form').show();
                    $('#rintek1_data').attr('name', 'pertek[]')
                } else {
                    $('#rintek1_form').hide();
                    $('#rintek1_data').removeAttr('name')
                }
            });
            $(document).on('change', '#rintek2', function() {
                if ($('#rintek2').is(":checked")) {
                    $('#rintek2_form').show();
                    $('#rintek2_data').attr('name', 'pertek[]')
                } else {
                    $('#rintek2_form').hide();
                    $('#rintek2_data').removeAttr('name')
                }
            });
            $(document).on('change', '#rintek3', function() {
                if ($('#rintek3').is(":checked")) {
                    $('#rintek3_form').show();
                    $('#rintek3_data').attr('name', 'pertek[]')
                } else {
                    $('#rintek3_form').hide();
                    $('#rintek3_data').removeAttr('name')
                }
            });
            $(document).on('change', '#rintek4', function() {
                if ($('#rintek4').is(":checked")) {
                    $('#rintek4_form').show();
                    $('#rintek4_data').attr('name', 'pertek[]')
                } else {
                    $('#rintek4_form').hide();
                    $('#rintek4_data').removeAttr('name')
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
                            <td class="text-center">
                                <button type="button" id="${j}" class="btn remove-btn1 btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                            </td>
                        </tr>`)
            });

            $(document).on('click', '.remove-btn1', function() {
                var button_id = $(this).attr('id');
                $('#1Claster' + button_id + '').remove();
                j--
            });

            $('#add2').click(function() {
                i++
                $('.table-input2').append(`<tr id="2Claster${i}">
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
                            <td class="text-center">
                                <button type="button" id="${i}" class="btn remove-btn2 btn-sm btn-danger">
                                    <i class="fas fa-minus fa-sm"></i>
                                </button>
                            </td>
                        </tr>`)
            });

            $(document).on('click', '.remove-btn2', function() {
                var button_id = $(this).attr('id');
                $('#2Claster' + button_id + '').remove();
                i--
            });
            // jquery pertek 1
            var prt1 = 1;

            $('#add-pertek1').click(function() {
                prt1++
                $('.table-pertek1').append(`
                    <tr id="prt1-${prt1}">
                        <td>${prt1}
                            <input type="text" name="pertek[]" id="name_pertek1" value="pertek1" hidden>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek1" name="surat_pertek[]" required placeholder="Surat Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek1" name="nomor_pertek[]" required placeholder="Nomor Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek1" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan Teknis">
                        </td>
                        <td>
                            <textarea class="form-control" name="perihal_pertek[]" id="perihal_pertek1" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek1', function() {
                var button_id = prt1;
                $('#prt1-' + button_id + '').remove();
                prt1--
            });

            // jquery pertek 2
            var prt2 = 1;

            $('#add-pertek2').click(function() {
                prt2++
                $('.table-pertek2').append(`
                    <tr id="prt2-${prt2}">
                        <td>${prt2}
                            <input type="text" name="pertek[]" id="name_pertek2" value="pertek2" hidden>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek2" name="surat_pertek[]" required placeholder="Surat Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek2" name="nomor_pertek[]" required placeholder="Nomor Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek2" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan Teknis">
                        </td>
                        <td>
                            <textarea class="form-control" name="perihal_pertek[]" id="perihal_pertek2" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek2', function() {
                var button_id = prt2;
                $('#prt2-' + button_id + '').remove();
                prt2--
            });

            // jquery pertek 3
            var prt3 = 1;

            $('#add-pertek3').click(function() {
                prt3++
                $('.table-pertek3').append(`
                    <tr id="prt3-${prt3}">
                        <td>${prt3}
                            <input type="text" name="pertek[]" id="name_pertek3" value="pertek3" hidden>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek3" name="surat_pertek[]" required placeholder="Surat Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek3" name="nomor_pertek[]" required placeholder="Nomor Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek3" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan Teknis">
                        </td>
                        <td>
                            <textarea class="form-control" name="perihal_pertek[]" id="perihal_pertek3" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek3', function() {
                var button_id = prt3;
                $('#prt3-' + button_id + '').remove();
                prt3--
            });
            // jquery pertek 4
            var prt4 = 1;

            $('#add-pertek4').click(function() {
                prt4++
                $('.table-pertek4').append(`
                    <tr id="prt4-${prt4}">
                        <td>${prt4}
                            <input type="text" name="pertek[]" id="name_pertek4" value="pertek4" hidden>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="surat_pertek4" name="surat_pertek[]" required placeholder="Surat Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="nomor_pertek4" name="nomor_pertek[]" required placeholder="Nomor Persetujuan Teknis">
                        </td>
                        <td>
                            <input type="date" class="form-control" id="tgl_pertek4" name="tgl_pertek[]" required placeholder="Tanggal Persetujuan Teknis">
                        </td>
                        <td>
                            <textarea class="form-control" name="perihal_pertek[]" id="perihal_pertek4" rows="2"></textarea>
                        </td>
                    </tr>`)
            });

            $(document).on('click', '#remove-pertek4', function() {
                var button_id = prt4;
                $('#prt4-' + button_id + '').remove();
                prt4--
            });
        });
    </script>
@endsection
