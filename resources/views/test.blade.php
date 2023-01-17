<table width="100%">
    <tr>
        <td colspan="3" width="100%">
            <center>KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN<br>REPUBLIK INDONESIA<br>
                NOMOR .....<br><br>TENTANG<br><br>
                KEPUTUSAN KELAYAKAN LINGKUNGAN HIDUP ' . $skkl->nama_usaha_baru .
                ' DI KABUPATEN/KOTA ' . strtoupper($kabkota) . ' PROVINSI ' . strtoupper($prov) . ' OLEH '
                . strtoupper($skkl->pelaku_usaha_baru) . ' <br><br>
                DENGAN RAHMAT TUHAN YANG MAHA ESA<br><br>MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
            </center>
        </td>
    </tr>
    <tr>
        <td width="30%">
            Menimbang
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            <ol style="list-style-type: lower-alpha;">
                <li>bahwa berdasarkan ketentuan Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup, ditetapkan</li>
                <ol>
                    <li class="list_kurung">Pasal 3 ayat (1): Persetujuan Lingkungan wajib dimiliki oleh setiap Usaha dan/atau Kegiatan yang memiliki Dampak Penting atau tidak penting terhadap lingkungan;</li>
                    <li class="list_kurung">Pasal 3 ayat (2): Persetujuan Lingkungan diberikan kepada Pelaku Usaha atau Instansi Pemerintah;</li>
                    <li class="list_kurung">Pasal 3 ayat (3): Persetujuan Lingkungan menjadi prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah;</li>
                    <li class="list_kurung">Pasal 3 ayat (4): Persetujuan Lingkungan dilakukan melalui penyusunan Amdal dan uji kelayakan Amdal;</li>
                    <li class="list_kurung">Pasal 89 ayat (1) : Penanggungjawab Usaha dan/atau Kegiatan wajib melakukan perubahan Persetujuan Lingkungan apabila Usaha dan/atau Kegiatannya yang telah memperoleh surat Keputusan Kelayakan Lingkungan Hidup atau persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup direncanakan untuk dilakukan perubahan;</li>
                    <li class="list_kurung">Pasal 89 ayat (2) : Perubahan Persetujuan Lingkungan dilakukan melalui: a. perubahan Persetujuan Lingkungan dengan kewajiban menyusun dokumen lingkungan hidup baru; atau b. perubahan Persetujuan Lingkungan tanpa disertai kewajiban menyusun dokumen lingkungan hidup baru;</li>
                </ol>
                <li>bahwa ' . $skkl->jabatan . ' melalui surat Nomor: ' . $skkl->nomor_pl . ' Tanggal ' . $skkl->tgl_pl . ' perihal ' . $skkl->perihal . ' mengajukan permohonan perubahan persetujuan lingkungan kepada Menteri Lingkungan Hidup dan Kehutanan;</li>
                <li>bahwa terhadap permohonan sebagaimana dimaksud dalam huruf b, penanggung jawab usaha dan/atau kegiatan telah memiliki persetujuan lingkungan berdasarkan:<br>
                    <ol>' . $il_dkk . '</ol>
                </li>
                <li>berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a sampai dengan huruf c, perlu menetapkan Keputusan Menteri Lingkungan Hidup dan Kehutanan Republik Indonesia tentang Kelayakan Lingkungan Hidup Usaha ' . $skkl->nama_usaha_baru . ' di ' . ucwords(strtolower($kabkota)) . ' Provinsi ' . ucwords(strtolower($prov)) . ' oleh ' . $skkl->pelaku_usaha_baru . '</li>
            </ol>
        </td>
    </tr>
    <tr>
        <td width="30%">
            Mengingat
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            <ol>
                <li>Undang-Undang Nomor 32 Tahun 2009 tentang Perlindungan dan Pengelolaan Lingkungan Hidup sebagaimana telah diubah dengan Undang-Undang Nomor 11 Tahun 2020 tentang Cipta Kerja;</li>
                <li>Peraturan Pemerintah Nomor 5 Tahun 2021 tentang Penyelenggaraan Perizinan Berusaha Berbasis Resiko;</li>
                <li>Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup;</li>
                <li>Peraturan Presiden Nomor 68 Tahun 2019 tentang Organisasi Kementerian Negara, sebagaimana telah diubah dengan Peraturan Presiden Nomor 32 Tahun 2021;</li>
                <li>Peraturan Presiden Nomor 92 Tahun 2020 tentang Kementerian Lingkungan Hidup dan Kehutanan;</li>
                <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 4 Tahun 2021 tentang Daftar usaha dan/atau kegiatan yang Wajib Memiliki Analisis Mengenai Dampak Lingkungan Hidup, Upaya Pengelolaan Lingkungan Hidup dan Upaya Pemantauan Lingkungan Hidup atau Surat Pernyataan Kesanggupan Pengelolaan dan Pemantauan Lingkungan Hidup;</li>
                <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 6 Tahun 2021</li>
                <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 5 Tahun 2021 tentang Tata Cara Penerbitan Persetujuan Teknis dan Surat Kelayakan Operasional Bidang Pengendalian Pencemaran Lingkungan;</li>
                <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 15 Tahun 2021 tentang Organisasi dan Tata Kerja Kementerian Lingkungan Hidup dan Kehutanan.</li>
            </ol>
        </td>
    </tr>
    <tr>
        <td width="30%">
            Memperhatikan
        </td>
        <td width="5%"> :</td>
        <td width="65%">Surat Nomor: ' . $skkl->nomor_pl . ' Tanggal ' . $skkl->tgl_pl . ' perihal ' . $skkl->perihal . ' yang telah diterima PTSP KLHK pada tanggal ...
        </td>
    </tr>
    <tr>
        <td colspan="3"><br>
            <center>MEMUTUSKAN</center><br>
        </td>
    </tr>
    <tr>
        <td width="30%">
            Menetapkan
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA TENTANG KELAYAKAN LINGKUNGAN HIDUP USAHA ' . strtoupper($skkl->nama_usaha) . ' DI ' . strtoupper($kabkota) . ' PROVINSI ' . strtoupper($prov) . ' OLEH ' . strtoupper($skkl->pelaku_usaha_baru) . '
        </td>
    </tr>
    <tr>
        <td width="30%">
            KESATU
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Penanggung jawab Usaha dan/atau Kegiatan ini berubah dari:
            <table>
                <tr>
                    <td width="20px">1.</td>
                    <td width="40%" style="text-align: left;">Pelaku Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td width="50%">' . ucfirst($skkl->pelaku_usaha) . '</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="text-align: left;">Jenis Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->jenis_usaha) . '</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td style="text-align: left;">Penanggung Jawab Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->penanggung) . '</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>NIB</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->nib) . '</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>KBLI</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->knli) . '</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->jabatan) . '</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Alamat Kantor/Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->alamat) . '</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td style="text-align: left;">Lokasi Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->lokasi) . '</td>
                </tr>
                <tr>
                    <td colspan="4"><br>menjadi:</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td style="text-align: left;">Pelaku Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->pelaku_usaha_baru) . '</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="text-align: left;">Jenis Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->jenis_usaha_baru) . '</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td style="text-align: left;">Penanggung Jawab Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->penanggung_baru) . '</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>NIB</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->nib_baru) . '</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>KBLI</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->knli_baru) . '</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->jabatan_baru) . '</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Alamat Kantor/Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->alamat_baru) . '</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td style="text-align: left;">Lokasi Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->lokasi_baru) . '</td>
                </tr>
                    <br>
            </table>
        </td>
    </tr>
    <tr>
        <td width="30%">
            KEDUA
        </td>
        <td width="5%"> :</td>
        <td width="65%">Ruang lingkup rencana usaha dan/atau kegiatan adalah sebagaimana dimaksud dalam:
            ' . ucfirst($skkl->lokasi_baru) . '.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KETIGA
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            <ol> ' . $il_dkk . ' </ol>
            dipersamakan dengan Persetujuan Lingkungan.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KEEMPAT
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Izin Pembuangan Air Limbah yang telah dimiliki dan masih berlaku setelah 2 Februari 2021 serta tidak ada perubahan dipersamakan sebagai Persetujuan Teknis;
        </td>
    </tr>
    <tr>
        <td width="30%">
            KELIMA
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Izin Penyimpanan Limbah B3 yang telah dimilik dan masih berlaku dipersamakan sebagai rincian teknis penyimpanan limbah B3.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KEENAM
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Penanggung Jawab Usaha dan/atau Kegiatan Wajib melakukan pengelolaan dan pematauan lingkungan sebagaimana tercantum dalam
            <ol>' . $il_dkk . '</ol>
        </td>
    </tr>
    <tr>
        <td width="30%">
            KETUJUH
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Dalam pelaksanaan Keputusan ini, Menteri melakukan pengawasan terhadap pelaksanaan usaha yang dilaksanakan sesuai dengan peraturan perundang-undangan paling sedikit 1 (satu) kali dalam 1 (satu) tahun.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KEDELAPAN
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Dalam rangka menjamin pelaksanaan Persetujuan Lingkungan, Pelaku usaha diprioritaskan untuk dilakukan pengawasan dalam jangka waktu 1 (satu)
            tahun.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KESEMBILAN
        </td>
        <td width="5%"> :</td>
        <td width="65%">Dalam melaksanakan kegiatan, Penanggung Jawab Usaha dan/atau Kegiatan wajib:<br>
            <ol>
                <li>Mematuhi ketentuan peraturan perundang-undangan di bidang Perlindungan dan Pengelolaan Lingkungan Hidup;&nbsp;</li>
                <li>Melakukan koordinasi dengan instansi pusat maupun daerah, berkaitan dengan pelaksanaan kegiatan ini;</li>
                <li>Melaksanakan ketentuan pelaksanaan kegiatan sesuai dengan Standard Operating Procedure (SOP);</li>
                <li>Melakukan perbaikan secara terus-menerus terhadap kehandalan teknologi yang digunakan dalam rangka meminimalisasi dampak yang diakibatkan dari rencana kegiatan ini;</li>
                <li>Mendokumentasikan kegiatan pengelolaan lingkungan yang dilakukan terkait dengan kegiatan tersebut;</li>
                <li>Menyiapkan dana penjaminan untuk pemulihan fungsi lingkungan hidup sesuai dengan ketentuan peraturan perundang-undangan;</li>
                <li>Menyusun laporan pelaksanaan kewajiban sebagaimana dimaksud pada angka 1 sampai dengan angka 7, paling sedikit (satu) kali setiap 6 (enam) bulan selama usaha dan/atau kegiatan berlangsung dan menyampaikan kepada:
                    <ol style="list-style-type: lower-alpha;">
                        <li>Menteri Lingkungan Hidup dan Kehutanan melalui Direktur Jenderal Penegakan Hukum Lingkungan Hidup dan Kehutanan;</li>' .
                        $loopprov2 .
                        $loopkk2 .
                        '
                    </ol>
                </li>
            </ol>
        </td>
    </tr>
    <tr>
        <td width="30%">
            KESEPULUH
        </td>
        <td width="5%"> :</td>
        <td width="65%">Penanggung Jawab Usaha dan/atau Kegiatan wajib mengajukan permohonan perubahan Persetujuan Lingkungan apabila terjadi perubahan atas rencana usaha dan/atau kegiatannya dan/atau oleh sebab lain sesuai dengan kriteria perubahan yang tercantum dalam Pasal 89 Peraturan Pemerintah Republik Indonesia Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KESEBELAS
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Keputusan Kelayakan Lingkungan Hidup ini merupakan prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah.
        </td>
    </tr>
    <tr>
        <td width="30%">
            KEDUA BELAS
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Keputusan Menteri ini berlaku sejak tanggal ditetapkan, dan berakhir bersamaan dengan berakhirnya Perizinan Berusaha atau Persetujuan Pemerintah.
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="50%">&nbsp;</td>
        <td width="50%">
            <table>
                <tr>
                    <td>Ditetapkan di</td>
                    <td>: Jakarta</td>
                </tr>
                <tr>
                    <td>pada tanggal</td>
                    <td>: </td>
                </tr>
                <tr>
                    <td colspan="2">MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA
                        <br><br><br>
                        SITI NURBAYA
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" width="100%">
            Tembusan Yth.: <br>
            <ol>
                <li>Menteri Lingkungan Hidup dan Kehutanan;</li>'
                . $loopprov1 .
                '<li>Sekretaris Jendral Kementrian Lingkungan Hidup dan Kehutanan;</li>
                <li>Direktur Jendral Penegakan Hukum Lingkungan Hidup dan Kehutanan;</li> '
                . $loopkk1 .
                '<li>Pelaku Usaha ' . $skkl->pelaku_usaha_baru . ';</li>
            </ol>
        </td>
    </tr>
</table>