<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="generator" content="Aspose.Words for .NET 23.1.0" />
    <title></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(window).on('load', function() {
            $('.modal').modal('show');
        });
    </script>

    <style type="text/css">
        body {
            line-height: 115%;
            font-family: "Bookman Old Style", serif;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt;
        }

        .page {
            width: 21cm;
            min-height: 32.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0pt
        }

        li,
        table {
            margin-top: 0pt;
            margin-bottom: 0pt
        }

        h1 {
            margin-top: 12pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            font-family: Calibri;
            font-size: 24pt;
            font-weight: bold;
            font-style: normal;
            color: #2f5496
        }

        h2 {
            margin-top: 2pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            font-family: Calibri;
            font-size: 18pt;
            font-weight: bold;
            font-style: normal;
            color: #2f5496
        }

        h3 {
            margin-top: 2pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            font-family: Calibri;
            font-size: 14pt;
            font-weight: bold;
            font-style: normal;
            color: #1f3763
        }

        h4 {
            margin-top: 2pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            font-family: Calibri;
            font-size: 12pt;
            font-weight: bold;
            font-style: normal;
            color: #2f5496
        }

        h5 {
            margin-top: 2pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            font-family: Calibri;
            font-size: 10pt;
            font-weight: bold;
            font-style: normal;
            color: #2f5496
        }

        h6 {
            margin-top: 2pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            font-family: Calibri;
            font-size: 8pt;
            font-weight: bold;
            font-style: normal;
            color: #1f3763
        }

        span.Heading1Char {
            font-family: 'Calibri Light';
            font-size: 16pt;
            color: #2f5496
        }

        span.Heading2Char {
            font-family: 'Calibri Light';
            font-size: 13pt;
            color: #2f5496
        }

        span.Heading3Char {
            font-family: 'Calibri Light';
            font-size: 12pt;
            color: #1f3763
        }

        span.Heading4Char {
            font-family: 'Calibri Light';
            font-style: italic;
            color: #2f5496
        }

        span.Heading5Char {
            font-family: 'Calibri Light';
            color: #2f5496
        }

        span.Heading6Char {
            font-family: 'Calibri Light';
            color: #1f3763
        }
    </style>
</head>

<body>
    <?php
    $data_kabkota = implode(', ', $data_pkplh->kabupaten_kota);
    $data_prov = implode(', ', $data_pkplh->provinsi);
    ?>

    <div class="float-left">
        <button><a href="{{ route('pkplh.index') }}">kembali</a></button>
    </div>
    <div class="float-right">
        <button><a href="{{ route('uklupl.create', $data_pkplh->id) }}">Matriks UKL-UPL</a></button>
    </div>

    <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">PERINGATAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        Mohon periksa kembali redaksional data Perubahan PL yang telah diinput melalui Preview PL ini. Jika terdapat kesalahan penulisan redaksional, silakan perbaiki kembali data  melalui tombol Ubah Data.
                        Selanjutnya mohon lengkapi input data form Matriks UKL-UPL (sebagai Lampiran PL) secara lengkap, dan bukti submit digunakan sebagai praysarat administrasi di PTSP.
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page">
        <p><br /><br /><br /><span style="-aw-import:ignore">&#xa0;</span></p>
        <table cellspacing="2" cellpadding="0" style="width:100%; border-spacing:1.5pt">
            <tr>
                <td colspan="3" style="padding:0.75pt; vertical-align:top">
                    <p style="text-align:center; font-size:12pt"><span>KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN
                            KEHUTANAN</span><br /><span>REPUBLIK INDONESIA</span><br /><span>NOMOR
                            .....</span><br /><br /><span>TENTANG</span><br /><br /><span>PERSETUJUAN PERNYATAAN
                            KESANGGUPAN PENGELOLAAN LINGKUNGAN</span><br /><span>HIDUP KEGIATAN
                            {{ strtoupper($data_pkplh->nama_usaha_baru) }} OLEH
                            {{ strtoupper($data_pkplh->pelaku_usaha_baru) }}
                        </span><br /><br /><span>DENGAN RAHMAT TUHAN YANG MAHA ESA</span><br /><br /><span>MENTERI
                            LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA, </span></p>
                </td>
            </tr>
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Menimbang </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <ol type="a" style="margin:0pt; padding-left:0pt">
                        <!-- point a -->
                        <li style="margin-left:35.98pt; text-align:justify; padding-left:0.02pt; font-size:12pt">
                            <span>bahwa berdasarkan ketentuan:</span>
                            <ol type="a" style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                <li style="margin-left:35.98pt; padding-left:0.02pt"><span>Peraturan Pemerintah Nomor 22
                                        Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan
                                        Hidup, ditetapkan:</span>
                                    <ol type="1" style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                        <li style="margin-left:36pt"><span>Pasal 3: </span>
                                            <ol type="1"
                                                style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                                <li style="margin-left:36pt"><span>ayat (1): Persetujuan Lingkungan
                                                        wajib dimiliki oleh setiap Usaha dan/atau Kegiatan yang memiliki
                                                        Dampak Penting atau tidak penting terhadap lingkungan;</span>
                                                </li>
                                                <li style="margin-left:36pt"><span>ayat (2): Persetujuan Lingkungan
                                                        diberikan kepada Pelaku Usaha atau Instansi Pemerintah;</span>
                                                </li>
                                                <li style="margin-left:36pt"><span>ayat (3): Persetujuan Lingkungan
                                                        menjadi prasyarat penerbitan Perizinan Berusaha atau Persetujuan
                                                        Pemerintah;</span></li>
                                                <li style="margin-left:36pt"><span>ayat (4): Persetujuan Lingkungan
                                                        dilakukan melalui penyusunan Amdal dan uji kelayakan
                                                        Amdal;</span></li>
                                            </ol>
                                        </li>
                                        <li style="margin-left:36pt"><span>Pasal 64 ayat (1) : Persetujuan Pernyataan
                                                Kesanggupan Pengelolaan Lingkungan Hidup merupakan: a. bentuk
                                                persetujuan Lingkungan Hidup; dan b. prasyarat penerbitan Perizinan
                                                Berusaha atau Persetujuan Pemerintah</span></li>
                                        <li style="margin-left:36pt"><span>Pasal 89 ayat (1) : Penanggungjawab Usaha
                                                dan/atau Kegiatan wajib melakukan perubahan Persetujuan Lingkungan
                                                apabila Usaha dan/atau Kegiatannya yang telah memperoleh surat Keputusan
                                                Kelayakan Lingkungan Hidup atau persetujuan Pernyataan Kesanggupan
                                                Pengelolaan Lingkungan Hidup direncanakan untuk dilakukan
                                                perubahan;</span></li>
                                        <li style="margin-left:36pt"><span>Pasal 89 ayat (2) : Perubahan Persetujuan
                                                Lingkungan dilakukan melalui: a. perubahan Persetujuan Lingkungan dengan
                                                kewajiban menyusun dokumen lingkungan hidup baru; atau b. perubahan
                                                Persetujuan Lingkungan tanpa disertai kewajiban menyusun dokumen
                                                lingkungan hidup baru;</span></li>
                                    </ol>
                                </li>
                                <li style="margin-left:35.98pt; padding-left:0.02pt"><span>Pasal 5 ayat (1) Peraturan
                                        Menteri Lingkungan Hidup dan Kehutanan Nomor 4 Tahun 2021 tentang Daftar Usaha
                                        dan/atau Kegiatan yang Wajib Memiliki Analisis Mengenai Dampak Lingkungan Hidup,
                                        Upaya Pengelolaan Lingkungan Hidup dan Upaya Pemantauan Lingkungan Hidup atau
                                        Surat Pernyataan Kesanggupan Pengelolaan dan Pemantauan Lingkungan Hidup,
                                        UKL-UPL wajib dimiliki bagi Usaha dan/atau Kegiatan yang tidak memiliki Dampak
                                        Penting terhadap lingkungan hidup;</span></li>
                            </ol>
                        </li>
                        <!-- point b -->
                        <li style="margin-left:35.98pt; text-align:justify; padding-left:0.02pt; font-size:12pt">
                            <span>bahwa usaha dan/atau kegiatan {{ $data_pkplh->nama_usaha_baru }} di Kabupaten/Kota {{ ucwords(strtolower($data_kabkota)) }}
                                Provinsi {{ ucwords(strtolower($data_prov)) }} oleh {{ $data_pkplh->pelaku_usaha_baru }}
                                berdasarkan dokumen lingkungan yang telah disetujui yaitu:
                                <ol type="1" style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                    <ol>
                                        @foreach ($il_pkplh as $data)
                                            <li>{{ $data->jenis_sk }} {{ $data->menerbitkan }} Nomor
                                                {{ $data->nomor_surat }} tanggal {{ tgl_indo($data->tgl_surat) }}
                                                tentang
                                                {{ $data->perihal_surat }}</li>
                                        @endforeach
                                    </ol>
                                </ol>
                            </span>
                        </li>
                        <!-- point c baru-->
                        {{-- <li style="margin-left:35.98pt; text-align:justify; padding-left:0.02pt; font-size:12pt">
                            <span>
                                bahwa {{ $data_pkplh->jabatan_baru }} melalui surat Nomor: {{ $data_pkplh->nomor_pl }}, Tanggal {{ tgl_indo($data_pkplh->tgl_pl) }}, perihal {{ $data_pkplh->perihal }},
                                mengajukan permohonan perubahan persetujuan lingkungan kepada Menteri Lingkungan Hidup;
                            </span>
                        </li> --}}
                        <!-- point c lama -->
                        @if ($data_pkplh->jenis_perubahan == 'perkep1')
                            <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>bahwa terdapat
                                    perubahan kepemilikan kegiatan {{ $data_pkplh->nama_usaha_baru }} oleh
                                    {{ $data_pkplh->pelaku_usaha_baru }} Berdasarkan:
                                    <i> (surat/akta notaris/SK)</i>
                                </span>
                                <ol type="1" style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                    @for ($i = 0; $i < count($data_pkplh->jenis_peraturan); $i++)
                                        <li style="margin-left:36pt">
                                            <span>
                                                {{ $data_pkplh->jenis_peraturan[$i] }}
                                                {{ $data_pkplh->pejabat_daerah[$i] }} Nomor
                                                {{ $data_pkplh->nomor_peraturan[$i] }} tentang
                                                {{ $data_pkplh->perihal_peraturan[$i] }}
                                            </span>
                                        </li>
                                    @endfor
                                </ol>
                            </li>
                        @elseif ($data_pkplh->jenis_perubahan == 'perkep2')
                            <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>bahwa terdapat
                                    perubahan kepemilikan kegiatan {{ $data_pkplh->nama_usaha_baru }} oleh
                                    {{ $data_pkplh->pelaku_usaha_baru }} berdasarkan:
                                </span>
                                <ol type="1" style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                    @for ($i = 0; $i < count($data_pkplh->jenis_peraturan); $i++)
                                        <li style="margin-left:36pt">
                                            <span>
                                                {{ $data_pkplh->jenis_peraturan[$i] }}
                                                {{ $data_pkplh->pejabat_daerah[$i] }} Nomor
                                                {{ $data_pkplh->nomor_peraturan[$i] }} tentang
                                                {{ $data_pkplh->perihal_peraturan[$i] }}
                                            </span>
                                        </li>
                                    @endfor
                                </ol>
                            </li>
                            </ol>
                            <p style="margin-left:36pt; text-align:justify; font-size:12pt"><br /><span>dan perubahan
                                    pengelolaan dan pemantauan oleh {{ $data_pkplh->pelaku_usaha_baru }} akan mengintegrasikan:
                                </span></p>
                            <ol type="1" style="margin:0pt; padding-left:0pt">
                                @for ($i = 0; $i < count(array_values(array_unique($jml_pertek))); $i++)
                                    @if ($pertek_pkplh[$i]->pertek == 'pertek1')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Air Limbah untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek2')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Pemenuhan Baku Mutu Emisi untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek3')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Di Bidang Pengelolaan Limbah B3 untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek4')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Andalalin untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek5')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Dokumen Rincian Teknis untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif
                                @endfor
                            </ol>
                        @else
                            </ol>
                            <p style="margin-left:36pt; text-align:justify; font-size:12pt"><br /><span>bahwa terdapat perubahan
                                    pengelolaan dan pemantauan oleh {{ $data_pkplh->pelaku_usaha_baru }} akan mengintegrasikan:
                                </span></p>
                            <ol type="1" style="margin:0pt; padding-left:0pt">
                                @for ($i = 0; $i < count(array_values(array_unique($jml_pertek))); $i++)
                                    @if ($pertek_pkplh[$i]->pertek == 'pertek1')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Air Limbah untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek2')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Pemenuhan Baku Mutu Emisi untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek3')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Di Bidang Pengelolaan Limbah B3 untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek4')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Andalalin untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif

                                    @if ($pertek_pkplh[$i]->pertek == 'pertek5')
                                        <li style="margin-left:72pt; text-align:justify; font-size:12pt">
                                            <span>
                                                Persetujuan Teknis Dokumen Rincian Teknis untuk Kegiatan
                                                {{ $pertek_pkplh[$i]->judul_pertek }} yang merupakan pengelolaan dan pemantauan
                                                lingkungan hidup ke dalam Persetujuan Lingkungan;
                                            </span>
                                        </li>
                                    @endif
                                @endfor
                            </ol>
                        @endif

                    <ol start="4" type="a" style="margin:0pt; padding-left:0pt">
                        <!-- point d -->
                        <li style="margin-left:35.98pt; text-align:justify; padding-left:0.02pt; font-size:12pt">
                            <span>d. bahwa telah diterbitkan Keputusan Menteri Lingkungan Hidup dan Kehutanan Nomor:
                                SK.1206/Menlhk/Setjen/Kum.1/12/2021 tentang Penunjukan Pejabat Penerbit Persetujuan
                                Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup kepada Direktur Jenderal Planologi
                                Kehutanan dan Tata Lingkungan; </span>
                        </li>
                        <!-- e -->
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>bahwa berdasarkan hasil
                                verifikasi administrasi sesuai Nomor {{ $data_pkplh->nomor_validasi }} tanggal
                                {{ tgl_indo($data_pkplh->tgl_validasi) }}, permohonan
                                sebagaimana
                                dimaksud pada huruf d, dinyatakan lengkap secara administrasi; </span></li>
                        <!-- f -->
                        <li
                            style="margin-left:35.99pt; margin-bottom:12pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a sampai dengan e, perlu
                                menetapkan Keputusan Menteri Lingkungan Hidup dan Kehutanan Republik Indonesia
                                tentang
                                Kelayakan Lingkungan Hidup Kegiatan {{ $data_pkplh->nama_usaha_baru }} di Kota/Kabupaten {{ucwords(strtolower($data_kabkota))}}
                                Provinsi {{ucwords(strtolower($data_prov)) }}; </span>
                        </li>
                    </ol>
                </td>
            </tr>
            <!-- mengingat -->
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Mengingat </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <ol type="1" style="margin:0pt; padding-left:0pt">
                        {{-- 1 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Undang-Undang Nomor 32
                                Tahun 2009 tentang Perlindungan dan Pengelolaan Lingkungan Hidup (Lembaran Negara
                                Republik Indonesia Tahun 2009 Nomor 140, Tambahan Lembaran Negara Republik Indonesia
                                Nomor 5059) sebagaimana telah diubah dengan Peraturan Pemerintah Pengganti Undang-Undang
                                Nomor 2 Tahun 2022 Tentang Cipta Kerja;</span></li>
                        {{-- 2 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Pemerintah
                                Nomor 5 Tahun 2021 tentang Penyelenggaraan Perizinan Berusaha Berbasis Risiko;</span>
                        </li>
                        {{-- 3 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Pemerintah
                                Nomor 22 Tahun 2021 tentang Perlindungan Pengelolaan Lingkungan Hidup;</span>
                        </li>
                        {{-- 4 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Presiden Nomor
                                68 Tahun 2019 tentang Organisasi Kementerian Negara , sebagaimana telah diubah dengan
                                Peraturan Presiden Nomor 32 Tahun
                                2021;</span>
                        </li>
                        {{-- 5 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Presiden Nomor
                                92 Tahun 2020 tentang Kementerian Lingkungan Hidup dan Kehutanan;</span>
                        </li>
                        {{-- 6 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Menteri
                                Lingkungan Hidup dan Kehutanan Nomor 4 Tahun 2021 tentang Daftar Usaha dan/atau Kegiatan
                                yang Wajib Memiliki AMDAL, UKL-UPL atau SPPL;</span>
                        </li>
                        {{-- 7 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Menteri
                                Lingkungan Hidup dan Kehutanan Nomor 5 Tahun 2021 tentang Tata Cara Penerbitan
                                Persetujuan Teknis dan Surat Kelayakan Operasional Bidang Pengendalian Pencemaran
                                Lingkungan;</span>
                        </li>
                        {{-- 8 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Peraturan Menteri
                                Lingkungan Hidup dan Kehutanan Nomor 15 Tahun 2021 tentang Organisasi dan Tata Kerja
                                Kementerian Lingkungan Hidup dan Kehutanan;</span>
                        </li>
                        {{-- 9 --}}
                        <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>Keputusan Menteri Lingkungan Hidup dan Kehutanan Nomor:
                                SK.1206/Menlhk/Setjen/Kum.1/12/2021 tentang Penunjukan Pejabat Penerbit Persetujuan
                                Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup kepada Direktur Jenderal Planologi
                                Kehutanan dan Tata Lingkungan;</span>
                        </li>
                    </ol>
                </td>
            </tr>
            <!-- memperhatikan -->
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Memperhatikan </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Risalah Pengolahan Data (RPD) Penerbitan
                            Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup Kegiatan
                            {{ $data_pkplh->nama_usaha_baru }} di Kota/Kabupaten {{ucwords(strtolower($data_kabkota))}} Provinsi {{ ucwords(strtolower($data_prov)) }}
                            Nomor RPD: {{ $data_pkplh->nomor_rpd }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span style="-aw-import:ignore">&#xa0;</span></p>
                    <p style="text-align:center; font-size:12pt"><span>MEMUTUSKAN:</span></p>
                    <p style="text-align:justify; font-size:12pt"><span style="-aw-import:ignore">&#xa0;</span></p>
                </td>
            </tr>
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Menetapkan </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN
                            KEHUTANAN
                            TENTANG PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP KEGIATAN
                            {{ strtoupper($data_pkplh->nama_usaha_baru) }} DI KOTA/KABUPATEN {{ $data_kabkota }}
                            PROVINSI {{ $data_prov }} OLEH {{ strtoupper($data_pkplh->pelaku_usaha_baru) }} </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KESATU </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Penanggung jawab Usaha dan/atau Kegiatan ini
                            adalah: </span></p>
                    <table cellspacing="2" cellpadding="0" style="border-spacing:1.5pt">
                        <tr>
                            <td style="width:15pt; padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>1.</span></p>
                            </td>
                            <td style="width:40%; padding:0.75pt; vertical-align:top">
                                <p style="font-size:12pt"><span>Nama Usaha dan/atau Kegiatan</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="width:50%; padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt">
                                    <span>{{ strtoupper($data_pkplh->pelaku_usaha_baru) }}</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>2.</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="font-size:12pt"><span>Nomor Induk Berusaha</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span
                                        style="-aw-import:ignore">{{ $data_pkplh->nib_baru }}</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>3.</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="font-size:12pt"><span>Jenis Usaha dan/atau Kegiatan</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <ul type="disc" style="margin:0pt; padding-left:0pt">
                                    @for ($i = 0; $i < count($data_pkplh->nama_kbli); $i++)
                                        <li
                                            style="margin-left:10pt; text-align:justify; -aw-font-family:'Symbol'; -aw-font-weight:normal; -aw-number-format:''">
                                            {{ $data_pkplh->nama_kbli[$i] }} (kode KBLI:
                                            {{ $data_pkplh->kbli_baru[$i] }})
                                        </li>
                                    @endfor
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>4.</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>Penanggung Jawab Usaha dan/atau
                                        Kegiatan</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt">
                                    <span>{{ $data_pkplh->penanggung_baru }}</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>5.</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>Jabatan</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt">
                                    <span>{{ $data_pkplh->jabatan_baru }}</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>6.</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>Alamat Kantor/ Kegiatan</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt">
                                    <span>{{ $data_pkplh->alamat_baru }}</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>7.</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>Lokasi Usaha dan/atau
                                        Kegiatan</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                            </td>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt">
                                    <span>{{ $data_pkplh->lokasi_baru }}</span>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size:12pt"></p>
                </td>
            </tr>
            <!-- kedua -->
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KEDUA </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Ruang lingkup dalam persetujuan Pernyataan
                            Kesanggupan Pengelolaan Lingkungan Hidup ini, meliputi: </span></p>
                    <p style="margin-top:12pt; margin-bottom:12pt; text-align:justify; font-size:12pt"><span>
                            {!! $data_pkplh->ruang_lingkup !!}
                        </span></p>
                </td>
            </tr>
            <!-- ketiga -->
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KETIGA </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Penanggung Jawab Usaha dan/atau Kegiatan wajib
                            memenuhi komitmen Persetujuan Teknis sebelum operasi terkait dengan lingkup Persetujuan
                            Teknis. </span></p>
                </td>
            </tr>
            <!-- keempat -->
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span> KEEMPAT </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Dalam melaksanakan kegiatan sebagaimana
                            dimaksud dalam Diktum KEDUA, Penanggung Jawab Usaha dan/atau Kegiatan wajib: </span></p>
                    <ol type="1" style="margin:0pt; padding-left:0pt">
                        <li style="margin-top:12pt; margin-left:36pt; text-align:justify; font-size:12pt">
                            <span>melakukan pengelolaan dan pemantauan dampak lingkungan hidup sebagaimana tercantum
                                dalam Lampiran I Keputusan ini; </span>
                        </li>
                        <!-- 2 -->
                        @if ($data_pkplh->jenis_perubahan != 'perkep1')
                            <li style="margin-left:36pt; text-al"gn:just"fy; font-size:12pt">
                                <span>
                                    mematuhi dan melaksanakan syarat-syarat teknis sesuai:
                                    <?php $roman = 3; ?>
                                    <ol type="a">
                                        @for ($i = 0; $i < count($pertek_pkplh); $i++)
                                            @if ($pertek_pkplh[$i]->pertek == 'pertek1')
                                                <li style="margin-left:30pt; text-align:justify; font-size:12pt">
                                                    <span>
                                                        Lampiran {{ integerToRoman($roman) }} Persetujuan Teknis Air
                                                        Limbah;
                                                    </span>
                                                </li>
                                            @endif

                                            @if ($pertek_pkplh[$i]->pertek == 'pertek2')
                                                <li style="margin-left:50pt; text-align:justify; font-size:12pt">
                                                    <span>
                                                        Lampiran {{ integerToRoman($roman) }} Persetujuan Teknis
                                                        Pemenuhan Baku Mutu Emisi;
                                                    </span>
                                                </li>
                                            @endif

                                            @if ($pertek_pkplh[$i]->pertek == 'pertek3')
                                                <li style="margin-left:50pt; text-align:justify; font-size:12pt">
                                                    <span>
                                                        Lampiran {{ integerToRoman($roman) }} Persetujuan Teknis Di
                                                        Bidang Pengelolaan Limbah B3;
                                                    </span>
                                                </li>
                                            @endif

                                            @if ($pertek_pkplh[$i]->pertek == 'pertek4')
                                                <li style="margin-left:50pt; text-align:justify; font-size:12pt">
                                                    <span>
                                                        Lampiran {{ integerToRoman($roman) }} Persetujuan Teknis
                                                        Andalalin;
                                                    </span>
                                                </li>
                                            @endif

                                            @if ($pertek_pkplh[$i]->pertek == 'pertek5')
                                                <li style="margin-left:50pt; text-align:justify; font-size:12pt">
                                                    <span>
                                                        Lampiran {{ integerToRoman($roman) }} Persetujuan Teknis
                                                        Dokumen Rincian Teknis;
                                                    </span>
                                                </li>
                                            @endif
                                            <?php $roman++; ?>
                                        @endfor
                                    </ol>
                                </span>
                            </li>
                        @endif
                        <!-- 3 -->
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>mematuhi ketentuan
                                peraturan perundang-undangan di bidang Perlindungan dan Pengelolaan Lingkungan Hidup;
                            </span></li>
                        <!-- 4 -->
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>melakukan koordinasi
                                dengan instansi pusat maupun daerah, berkaitan dengan pelaksanaan kegiatan ini; </span>
                        </li>
                        <!-- 5 -->
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>mengupayakan
                                pengurangan, penggunaan kembali, dan daur ulang terhadap limbah-limbah yang dihasilkan;
                            </span></li>
                    </ol>
                    <ol start="6" type="1" style="margin:0pt; padding-left:0pt">
                        {{-- 6 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>melakukan pengelolaan
                                limbah non B3 sesuai rincian pengelolaan yang termuat dalam matriks UKL-UPL; </span>
                        </li>
                        {{-- 7 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>melaksanakan ketentuan
                                pelaksanaan kegiatan sesuai dengan Standard Operating Procedure (SOP);</span></li>
                        {{-- 8 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>melakukan perbaikan
                                secara terus-menerus terhadap kehandalan teknologi yang digunakan dalam rangka
                                meminimalisasi dampak yang diakibatkan dari rencana kegiatan ini </span></li>
                        {{-- 9 --}}
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>melakukan sosialisasi
                                kegiatan kepada pemerintah daerah, tokoh masyarakat, dan masyarakat setempat sebelum
                                kegiatan pengembangan dilakukan;
                            </span></li>
                        {{-- 10 --}}
                        <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>mendokumentasikan seluruh kegiatan pengelolaan lingkungan yang dilakukan terkait
                                dengan kegiatan tersebut; </span>
                        </li>
                        {{-- 11 --}}
                        <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>memenuhi kewajiban pada Persetujuan Teknis pasca verifikasi pemenuhan baku mutu
                                Lingkungan Hidup, Pengelolaan Limbah B3, dan/atau Analisis Mengenai Dampak Lalu Lintas;
                            </span>
                        </li>
                        {{-- 12 --}}
                        <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>menyiapkan dana penjaminan untuk pemulihan fungsi Lingkungan Hidup sesuai dengan
                                ketentuan peraturan perundang-undangan;
                            </span>
                        </li>
                        {{-- 13 --}}
                        <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>melakukan audit lingkungan pada tahapan pasca operasi untuk memastikan kewajiban
                                telah dilaksanakan dalam rangka pengakhiran kewajiban pengelolaan dan pemantauan
                                lingkungan hidup dan/atau kewajiban lain yang ditetapkan oleh Menteri, Gubernur,
                                Bupati/Walikota sesuai dengan kewenangannya berdasarkan kepentingan perlindungan dan
                                pengelolaan lingkungan hidup;
                            </span>
                        </li>
                        {{-- 14 --}}
                        <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>Menyusun laporan pelaksanaan kewajiban sebagaimana dimaksud pada angka 1 (satu) sampai
                                dengan angka 10 (sepuluh), paling sedikit 1 (satu) kali setiap 6 (enam) bulan selama
                                usaha
                                atau Kegiatan berlangsung dan menyampaikan kepada: </span>
                            <ol type="a" style="margin-right:0pt; margin-left:0pt; padding-left:0pt">
                                <li style="margin-left:35.98pt; padding-left:0.02pt"><span>Menteri Lingkungan Hidup dan
                                        Kehutanan Republik Indonesia melalui Direktorat Jenderal Penegakan Hukum
                                        Lingkungan Hidup dan Kehutanan; </span></li>
                                @foreach ($data_pkplh->provinsi as $prov)
                                    <li style="margin-left:35.98pt; padding-left:0.02pt"><span>Gubernur
                                            {{ ucwords(strtolower($prov)) }} melalui
                                            Kepala Dinas Lingkungan Hidup Provinsi
                                            {{ ucwords(strtolower($prov)) }};</span></li>
                                @endforeach
                                @foreach ($data_pkplh->kabupaten_kota as $kabkota)
                                    <li style="margin-left:35.98pt; padding-left:0.02pt"><span>Bupati/Walikota
                                            {{ ucwords(strtolower($kabkota)) }} melalui Kepala Dinas Lingkungan Hidup
                                            Kabupaten/Kota {{ ucwords(strtolower($kabkota)) }};</span></li>
                                @endforeach
                            </ol>
                        </li>
                    </ol>
                    <p style="margin-left:36pt; margin-bottom:12pt; text-align:justify; font-size:12pt"><span>dengan
                            tembusan kepada kepala instansi yang membidangi selain huruf a sampai huruf e di atas,
                            sebagaimana tercantum dalam kolom institusi pengelolaan lingkungan hidup atau institusi
                            pemantauan lingkungan hidup. </span></p>
                </td>
            </tr>
            {{-- KELIMA --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KELIMA </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Terhadap izin-izin PPLH atau Persetujuan Teknis
                            atau Rincian Teknis sebagaimana tersebut Diktum KEEMPAT angka 2 yang terdapat perubahan di
                            dalamnya, wajib melakukan pembaruan Persetujuan Teknis dan/atau Rincian Teknis, dan
                            melakukan perubahan Persetujuan Lingkungan sesuai dengan ketentuan peraturan
                            perundang-undangan </span></p>
                </td>
            </tr>
            {{-- KEENAM --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KEENAM </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Apabila dalam pelaksanaan usaha dan/atau kegiatan timbul dampak
                        lingkungan hidup di luar dari dampak yang dikelola sebagaimana dimaksud dalam Lampiran Keputusan ini,
                        Penanggung jawab Usaha dan/atau Kegiatan wajib melaporkan kepada instansi sebagaimana dimaksud dalam Diktum KEEMPAT
                        angka 14 paling lama 30 (tiga puluh) hari kerja sejak diketahuinya timbulan dampak lingkungan
                        hidup di luar dampak yang wajib dikelola.</span></p>
                </td>
            </tr>
            {{-- KETUJUH --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KETUJUH </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Dalam pelaksanaan Keputusan ini, Menteri
                            menugaskan Pejabat Pengawas Lingkungan Hidup (PPLH) untuk melakukan pengawasan. </span></p>
                </td>
            </tr>
            {{-- KEDELAPAN --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KEDELAPAN </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Pengawasan sebagaimana dimaksud dalam Diktum
                            KEENAM dilaksanakan sesuai dengan ketentuan peraturan perundang-undangan paling sedikit 2
                            (dua) kali dalam 1 (satu) tahun. </span></p>
                </td>
            </tr>
            {{-- KESEMBILAN --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KESEMBILAN </span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Dalam hal berdasarkan hasil pengawasan
                            sebagaimana dimaksud dalam Diktum KETUJUH ditemukan pelanggaran, Penanggung jawab Usaha
                            dan/atau Kegiatan dikenakan sanksi sesuai dengan ketentuan peraturan perundang-undangan.
                        </span></p>
                </td>
            </tr>
            {{-- KESEPULUH --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KESEPULUH</span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Penanggung Jawab Usaha dan/atau Kegiatan wajib
                            mengajukan permohonan perubahan Persetujuan Lingkungan apabila terjadi perubahan atas
                            rencana Usaha dan/atau Kegiatannya dan/atau oleh sebab lain sesuai dengan kriteria perubahan
                            yang tercantum dalam Pasal 89 Peraturan Pemerintah Nomor 22 Tahun 2021 tentang
                            Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup.
                        </span></p>
                </td>
            </tr>
            {{-- KESEBELAS --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KESEBELAS</span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Segala data dan informasi sebagaimana dimaksud
                            dalam keputusan ini menjadi tanggungjawab penanggungjawab usaha dan/atau kegiatan.
                        </span></p>
                </td>
            </tr>
            {{-- KEDUA BELAS --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KEDUA BELAS</span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Dalam hal berdasarkan hasil pengawasan,
                            ditemukan ketidaksesuaian data dan informasi sebagaimana dimaksud dalam Amar KESEBELAS,
                            penanggungjawab
                        </span></p>
                </td>
            </tr>
            {{-- KETIGA BELAS --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KETIGA BELAS</span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Persetujuan Pernyataan Kesanggupan Pengelolaan
                            Lingkungan Hidup ini merupakan Persetujuan Lingkungan dan prasyarat penerbitan Perizinan
                            Berusaha atau Persetujuan Pemerintah.
                        </span></p>
                </td>
            </tr>
            {{-- KEEMPAT BELAS --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KEEMPAT BELAS</span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Dengan ditetapkannya keputusan ini, maka:
                        </span></p>
                    <ol type="a" style="margin:0pt; padding-left:50px;text-align:justify">
                        @foreach ($il_pkplh as $data)
                            <li>{{ $data->jenis_sk }} {{ $data->menerbitkan }} Nomor {{ $data->nomor_surat }} tanggal
                                {{ tgl_indo($data->tgl_surat) }} tentang {{ $data->perihal_surat }}
                            </li>
                        @endforeach
                    </ol>
                    <p style="text-align:justify; font-size:12pt"><span>dinyatakan tetap berlaku sepanjang tidak diubah
                            dengan keputusan ini dan merupakan bagian yang tidak terpisahkan dari keputusan ini.</span>
                    </p>
                </td>
            </tr>
            {{-- KELIMA BELAS --}}
            <tr>
                <td style="width:30%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>KELIMA BELAS</span></p>
                </td>
                <td style="width:2%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>:</span></p>
                </td>
                <td style="width:68%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Keputusan ini mulai berlaku pada tanggal
                            ditetapkan dan berakhir bersamaan dengan berakhirnya Perizinan Berusaha atau Persetujuan
                            Pemerintah. </span></p>
                </td>
            </tr>
            <tr>
                <td style="padding:0.75pt; vertical-align:middle">
                    <p style="font-size:12pt"><span style="-aw-import:ignore">&#xa0;</span></p>
                </td>
                <td style="padding:0.75pt; vertical-align:middle">
                    <p style="font-size:12pt"><span style="-aw-import:ignore">&#xa0;</span></p>
                </td>
                <td style="padding:0.75pt; vertical-align:middle">
                    <p style="font-size:12pt"><span style="-aw-import:ignore">&#xa0;</span></p>
                </td>
            </tr>
        </table>
        <p><span style="display:none; -aw-import:ignore">&#xa0;</span></p>
        <table cellspacing="2" cellpadding="0" style="width:100%; border-spacing:1.5pt">
            <tr>
                <td style="width:50%; padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>&#xa0;</span></p>
                </td>
                <td style="width:50%; padding:0.75pt; vertical-align:top">
                    <table cellspacing="2" cellpadding="0" style="border-spacing:1.5pt">
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>Ditetapkan di Jakarta</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>pada tanggal</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0.75pt; vertical-align:top">
                                <p style="text-align:justify; font-size:12pt"><span>a.n. MENTERI LINGKUNGAN HIDUP DAN
                                        KEHUTANAN REPUBLIK INDONESIA</span><br /><span>PLT. DIREKTORAT JENDERAL
                                        PLANOLOGI</span><br /><span>KEHUTANAN DAN TATA LINGKUNGAN,
                                    </span><br /><br /><br /><br /><br /><br /><span>RUANDHA AGUNG
                                        SUGARDIMAN</span><br /><span>NIP 19620301 198802 1 001 </span></p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size:12pt"></p>
                </td>
            </tr>
            <!-- tembusan -->
            <tr>
                <td colspan="2" style="padding:0.75pt; vertical-align:top">
                    <p style="text-align:justify; font-size:12pt"><span>Tembusan Yth.: </span></p>
                    <ol type="1" style="margin:0pt; padding-left:0pt">
                        @foreach ($data_pkplh->provinsi as $prov)
                            <li style="margin-left:36pt; text-align:justify; font-size:12pt">
                                <span>Gubernur {{ ucwords(strtolower($prov)) }}</span>
                            </li>
                        @endforeach
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Sekretaris Jenderal
                                Kementerian Lingkungan Hidup dan Kehutanan;</span></li>
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Direktur Jenderal
                                Planologi Kehutanan dan Tata Lingkungan;</span></li>
                        <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Direktur Jenderal
                                Penegakan Hukum Lingkungan Hidup dan Kehutanan;</span></li>
                        @foreach ($data_pkplh->kabupaten_kota as $kabkot)
                            <li style="margin-left:36pt; text-align:justify; font-size:12pt"><span>Bupati/Walikota
                                    {{ ucwords(strtolower($kabkot)) }}</span></li>
                        @endforeach
                        @foreach ($data_pkplh->provinsi as $prov)
                            <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                                <span>Kepala Dinas Lingkungan Hidup Provinsi {{ ucwords(strtolower($prov)) }}; </span>
                            </li>
                        @endforeach
                        @foreach ($data_pkplh->kabupaten_kota as $kabkota)
                            <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                                <span>Kepala Dinas Lingkungan Hidup Kabupaten/Kota
                                    {{ ucwords(strtolower($kabkota)) }}</span>
                            </li>
                        @endforeach

                        @foreach ($data_pkplh->region as $region)
                            <li style="margin-left:35.99pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                                <span>Kepala Pusat Pengendalian Pembangunan Ekoregion {{ $region }}, Kementerian
                                    Lingkungan Hidup dan Kehutanan;</span>
                            </li>
                        @endforeach

                        <li
                            style="margin-left:35.99pt; margin-bottom:12pt; text-align:justify; padding-left:0.01pt; font-size:12pt">
                            <span>{{ $data_pkplh->jabatan_baru }} {{ $data_pkplh->pelaku_usaha_baru }}; </span>
                        </li>
                    </ol>
                </td>
            </tr>
        </table>
        <p><span style="-aw-import:ignore">&#xa0;</span></p>
    </div>
</body>

</html>
