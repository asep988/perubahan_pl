<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skkl;
use App\il_skkl;
use App\Pkplh;
use App\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use FacadePdf;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_skkl = Skkl::orderBy('updated_at', 'DESC')->get();

        return view('operator.skkl.index', compact('data_skkl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload_file(Request $request)
    {
        // Validation
        $request->validate([
            'file' => 'required|mimes:pdf|max:5120',
            'status' => 'required'
        ]);

        if ($request->status == "draft") {
            $status = "Belum";
        } else {
            $status = "Selesai";
        }

        $id = $request->id_skkl;
        $skkl_id = Skkl::find($id);

        $destination = 'files/skkl/' . $skkl_id->file;
        if ($destination) {
            Storage::delete($destination);
        }

        $file = $request->file('file');
        $format = $file->getClientOriginalExtension();
        $fileName = time() . '_skkl.' . $format; //Variabel yang menampung nama file
        $file->storeAs('files/skkl', $fileName); //Simpan ke Storage

        Skkl::find($id)->update([
            'status' => $status,
            'file' => $fileName
        ]);

        return back()->with('message', 'PDF berhasil diupload!');
    }

    public function destroyFile($id)
    {
        $skkl = Skkl::find($id);
        $destination = 'files/skkl/' . $skkl->file;
        if ($destination) {
            Storage::delete($destination);
        }

        $skkl->update([
            'file' => null
        ]);

        return back()->with('message', 'PDF berhasil dihapus!');
    }

    public function periksa($id)
    {
        Skkl::find($id)->update([
            'nama_operator' => Auth::user()->name
        ]);

        $skkl = Skkl::find($id);

        $nama_usaha = $skkl->nama_usaha_baru;
        $nama_operator = Auth::user()->name;

        return back()->with('message', 'PJM untuk ' . $nama_usaha . ' adalah ' . $nama_operator);
    }

    public function download($id)
    {
        //phpword

        $skkl = Skkl::find($id);
        $il_skkl = il_skkl::where('id_skkl', $id)->get();
        $kabkota = implode(", ", $skkl->kabupaten_kota);
        $prov = implode(", ", $skkl->provinsi);

        $loopkk1 = "";
        for ($i = 0; $i < count($skkl->kabupaten_kota); $i++) {
            $loopkk1 .= "<li>Bupati/Walikota " . ucwords(strtolower($skkl->kabupaten_kota[$i])) . "</li>";
        }

        $loopprov1 = "";
        for ($i = 0; $i < count($skkl->provinsi); $i++) {
            $loopprov1 .= "<li>Gubernur " . ucwords(strtolower($skkl->provinsi[$i])) . "</li>";
        }

        $loopkk2 = "";
        for ($i = 0; $i < count($skkl->kabupaten_kota); $i++) {
            $loopkk2 .= "<li>Bupati/Walikota " . ucwords(strtolower($skkl->kabupaten_kota[$i])) . " melalui Kepala Dinas Lingkungan Hidup Kabupaten/Kota " . ucwords(strtolower($skkl->kabupaten_kota[$i])) . "</li>";
        }

        $loopprov2 = "";
        for ($i = 0; $i < count($skkl->provinsi); $i++) {
            $loopprov2 .= "<li>Gubernur " . ucwords(strtolower($skkl->provinsi[$i])) . " melalui Kepala Dinas Lingkungan Hidup Provinsi " . ucwords(strtolower($skkl->provinsi[$i])) . "</li>";
        }

        $il_dkk = "";
        for ($i = 0; $i < count($il_skkl); $i++) {
            $il_dkk .= "<li>" . $il_skkl[$i]->jenis_sk . " " . $il_skkl[$i]->menerbitkan . " Nomor " . $il_skkl[$i]->nomor_surat . " tanggal " . date("d m Y", strtotime($il_skkl[$i]->tgl_surat)) . " tentang " . $il_skkl[$i]->perihal_surat . "</li>";
        }

        $headers = array(

            "Content-type" => "text/html",

            "Content-Disposition" => "attachment;Filename=PL_$skkl->nama_usaha_baru.doc"

        );

        $body = '
        <style>
            body {
                font-family:"Bookman Old Style,serif";
            }
            ol {
            columns:2;
            }
            ol > li.list_kurung::marker {
            content:counter(list-item) ")\2003";
            }
            td {
                vertical-align: top;
                text-align: justify;
            }
        </style>';

        $body .=
            '<table width="100%">
                <tr>
        <td colspan="3" width="100%">
            <center>KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN<br>REPUBLIK INDONESIA<br> 
                NOMOR .....<br><br>TENTANG<br><br>
                KELAYAKAN LINGKUNGAN HIDUP ' . strtoupper($skkl->nama_usaha_baru)  .
                    ' DI KABUPATEN/KOTA ' . strtoupper($kabkota) . ' PROVINSI ' . strtoupper($prov) . ' OLEH '
                    . strtoupper($skkl->pelaku_usaha_baru) . ' <br><br>
                DENGAN RAHMAT TUHAN YANG MAHA ESA<br><br>MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
            <center>    
        </td>
        </tr>
        <tr>
        <td width="30%">
            Menimbang
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            <ol style="list-style-type: lower-alpha;">
                <li>bahwa berdasarkan ketentuan Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup, ditetapkan:</li>
                    <ol>
                        <li class="list_kurung">Pasal 3 ayat (1): Persetujuan Lingkungan wajib dimiliki oleh setiap Usaha dan/atau Kegiatan yang memiliki Dampak Penting atau tidak penting terhadap lingkungan;</li>
                        <li class="list_kurung">Pasal 3 ayat (2): Persetujuan Lingkungan diberikan kepada Pelaku Usaha atau Instansi Pemerintah;</li>
                        <li class="list_kurung">Pasal 3 ayat (3): Persetujuan Lingkungan menjadi prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah;</li>
                        <li class="list_kurung">Pasal 3 ayat (4): Persetujuan Lingkungan dilakukan melalui penyusunan Amdal dan uji kelayakan Amdal;</li>
                        <li class="list_kurung">Pasal 89 ayat (1) : Penanggungjawab Usaha dan/atau Kegiatan wajib melakukan perubahan Persetujuan Lingkungan apabila Usaha dan/atau Kegiatannya yang telah memperoleh surat Keputusan Kelayakan Lingkungan Hidup atau persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup direncanakan untuk dilakukan perubahan;</li>
                        <li class="list_kurung">Pasal 89 ayat (2) : Perubahan Persetujuan Lingkungan dilakukan melalui: a. perubahan Persetujuan Lingkungan dengan kewajiban menyusun dokumen lingkungan hidup baru; atau b. perubahan Persetujuan Lingkungan tanpa disertai kewajiban menyusun dokumen lingkungan hidup baru;</li>
                    </ol>
//point b*      <li>bahwa kegiatan' .$skkl->nama_usaha_baru. ' Kabupaten '
                .ucwords(strtolower($kabkota)).' Provinsi '.ucwords(strtolower($prov)).' Oleh '.ucwords(strtolower($skkl->pelaku_usaha_baru)).' telah memiliki dokumen lingkungan yang telah disetujui berdasarkan:<br>
                <ol> ' . $il_dkk . ' </ol></li>
//point c*      <li>bahwa terdapat perubahan kepemilikan kegiatan ' 
                . $skkl->jabatan . ' melalui surat Nomor: ' . $skkl->nomor_pl . ' Tanggal ' . $skkl->tgl_pl . ' perihal ' . $skkl->perihal . ' mengajukan permohonan perubahan persetujuan lingkungan kepada Menteri Lingkungan Hidup dan Kehutanan;</li>
//point d*      <li>bahwa terhadap permohonan sebagaimana dimaksud dalam huruf
                b, penanggung jawab usaha dan/atau kegiatan telah memiliki persetujuan lingkungan berdasarkan:<br>
                <ol>' . $il_dkk . '</ol></li>
//point e*      <li>berdasarkan pertimbangan sebagaimana dimaksud dalam huruf 
                a sampai dengan huruf c, perlu menetapkan Keputusan Menteri Lingkungan Hidup dan Kehutanan Republik Indonesia tentang Kelayakan Lingkungan Hidup Usaha ' . $skkl->nama_usaha_baru . ' di ' . ucwords(strtolower($kabkota)) . ' Provinsi ' . ucwords(strtolower($prov)) . ' oleh ' . $skkl->pelaku_usaha_baru . '</li>
//point f*      <li>berdasarkan pertimbangan sebagaimana dimaksud dalam huruf
                a sampai dengan ..., perlu menetapkan Keputusan Mentri Lingkungan Hidup dan Kehutanan Republik Indonesia tentang Kelayakan Lingkungan Hidup Kegiatan' . ucwords(strtolower($skkl->nama_usaha_baru)) . ';</li>
            </ol>
        </td>
        </tr>
        <tr>
        <td width="30%" >
            Mengingat
        </td>
        <td width="5%"> :</td>
        <td width="65%">
        <ol>
            <li>Undang-Undang Nomor 32 Tahun 2009 tentang Perlindungan dan Pengelolaan Lingkungan Hidup (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 140, Tambahan Lembaran Negara Republik Indonesia Nomor 5059) sebagaimana telah diubah dengan Peraturan Pemerintah Pengganti Undang-Undang Nomor 2 Tahun 2022 Tentang Cipta Kerja (Lembaran Negara Republik Indonesia Tahun 2022 Nomor 238);</li>
            <li>Peraturan Pemerintah Nomor 5 Tahun 2021 tentang
            Penyelenggaraan Perizinan Berusaha Berbasis Resiko (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 15, Tambahan Lembaran Negara Republik Indonesia Nomor 6617);</li>
            <li>Peraturan Pemerintah Nomor 22 Tahun 2021 tentang 
            Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 32, Tambahan Lembaran Negara Republik indonesia Nomor 6634);</li>
            <li>Peraturan Presiden Nomor 68 Tahun 2019 tentang Organisasi 
            Kementerian Negara , (Lembaran Negara Republik Indonesia Tahun 2019 Nomor 203), sebagaimana telah diubah dengan Peraturan Presiden Nomor 32 Tahun 2021 tentang Perubahan atas Peraturan Presiden Nomor 68 Tahun 2019 (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 106);</li>
            <li>Peraturan Presiden Nomor 92 Tahun 2020 tentang Kementerian 
            Lingkungan Hidup dan Kehutanan (Lembaran Negara Republik Indonesia Tahun 2020 Nomor 209);</li>
            <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 4 Tahun 
            2021 tentang Daftar Usaha dan/atau Kegiatan yang Wajib Memiliki AMDAL, UKL-UPL atau SPPL (Berita Negara Republik Indonesia Tahun 2021 Nomor 267);</li>
            <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 5 Tahun 
            2021 tentang Tata Cara Penerbitan Persetujuan Teknis dan Surat Kelayakan Operasional Bidang Pengendalian Pencemaran Lingkungan (Berita Negara Republik Indonesia Tahun 2021 Nomor 268);</li>
            <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 6 Tahun 2021 tentang Tata Cara dan Persyaratan Pengelolaan Limbah Bahan Berbahaya dan Beracun (Berita Negara Republik Indonesia Tahun 2021 Nomor 294);
            </li>
            <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 15 Tahun 2021 tentang Organisasi dan Tata Kerja Kementerian Lingkungan Hidup dan Kehutanan (Berita Negara Republik Indonesia Tahun 2021 Nomor 756);
            </li>
            <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 19 Tahun 2021 tentang Tata Cara Pengelolaan Limbah NonBahan Berbahaya dan Beracun (Berita Negara Republik Indonesia Tahun 2021 Nomor 1214);
            </li>
        </ol>
        </td>
        </tr>
        <tr>
        <td width="30%" >
            Memperhatikan
        </td>
        <td width="5%"> :</td>
        <td width="65%">Risalah Pengolahan Data Proses Penelaahan 
        Surat Keputusan Kelayakan Lingkungan Hidup Kegiatan ..... oleh ....
        </td>
        </tr>   
        <tr>
        <td colspan="3"><br><center>MEMUTUSKAN</center><br></td>
        </tr>
        <tr>
        <td width="30%" >
            Menetapkan
        </td>
        <td width="5%"> :</td>
        <td width="65%">
        KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA TENTANG KELAYAKAN LINGKUNGAN HIDUP KEGIATAN ' . strtoupper($skkl->nama_usaha) . ' DI ' . strtoupper($kabkota) . ' PROVINSI ' . strtoupper($prov) . ' OLEH ' . strtoupper($skkl->pelaku_usaha_baru) . '
        </td>
        </tr>   
        <tr>
        <td width="30%">
            KESATU
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Penanggung jawab Usaha dan/atau Kegiatan ini adalah:
            <table>
                <tr>
                    <td width="20px">1.</td>
                    <td width="40%" style="text-align: left;">Nama Usaha dan/ atau kegiatan </td>
                    <td>:</td>
                    <td width= "50%">' . ucfirst($skkl->pelaku_usaha) . '</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td style="text-align: left;">Nomor Induk Berusaha</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->jenis_usaha) . '</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td style="text-align: left;">Jenis Usaha dan/atau Kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->penanggung) . '</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Penanggung Jawab 
                    Usaha dan/ atau kegiatan
                    </td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->nib) . '</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->knli) . '</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Alamat Kantor</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->jabatan) . '</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Lokasi Usaha dan/ atau kegiatan</td>
                    <td>:</td>
                    <td>' . ucfirst($skkl->alamat) . '</td>
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
        <td width="65%">Ruang lingkup kegiatan dalam Surat Keputusan Kelayakan Lingkungan Hidup ini, meliputi:
            ' . ucfirst($skkl->ruang_lingkup) . '.
        </td>
        </tr>
        <tr>
        <td width="30%">
            KETIGA
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Penanggung Jawab Usaha dan/atau Kegiatan wajib memenuhi komitmen Persetujuan Teknis sebelum operasi terkait dengan lingkup Persetujuan Teknis.
        </td>
        </tr>
        <tr>
        <td width="30%">
            KEEMPAT
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Dalam melaksanakan kegiatan sebagaimana dimaksud dalam Diktum KEDUA, Penanggung Jawab Usaha dan/atau Kegiatan wajib:
            <ol>
                <li>melakukan pengelolaan dan pemantauan dampak lingkungan hidup sebagaimana tercantum dalam Lampiran I dan II Keputusan ini;</li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                </ol>
        </td>
        </tr>
        <tr>
        <td width="30%">
            KELIMA
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Apabila dalam pelaksanaan usaha dan/atau kegiatan timbul dampak lingkungan hidup di luar dari dampak yang dikelola sebagaimana dimaksud dalam Lampiran Keputusan Menteri ini, penanggung jawab usaha dan/atau kegiatan wajib melaporkan kepada instansi sebagaimana dimaksud dalam Diktum KEEMPAT angka 12 (dua belas) paling lama 30 (tiga puluh) hari kerja sejak diketahuinya timbulan dampak lingkungan hidup di luar dampak yang wajib dikelola.
        </td>
        </tr>
        <tr>
        <td width="30%">
            KEENAM
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Dalam pelaksanaan Keputusan Menteri ini, Menteri menugaskan Pejabat Pengawas Lingkungan Hidup (PPLH) untuk melakukan pengawasan.
        </td>
        </tr>
        <tr>
        <td width="30%">
            KETUJUH
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Pengawasan sebagaimana dimaksud dalam Diktum KEENAM dilaksanakan sesuai dengan peraturan perundang-undangan paling sedikit 2 (dua) kali dalam 1 (satu) tahun.
        </td>
        </tr>
        <tr>
        <td width="30%">
            KEDELAPAN
        </td>
        <td width="5%"> :</td>
        <td width="65%">
            Dalam hal berdasarkan hasil pengawasan sebagaimana dimaksud dalam Diktum KETUJUH ditemukan pelanggaran, Penanggung jawab Usaha dan/atau Kegiatan dikenakan sanksi sesuai dengan ketentuan peraturan perundang-undangan.
        </td>
        </tr>';

        $body .= '<tr>
 *       <td width="30%">
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
            '</ol>
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
        <tr>
        </table>';

                $body .= '<table width="100%">
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
        </tr>';


        $body .= '<tr>
        <td colspan="2" width="100%">
            Tembusan Yth.: <br>
            <ol>
                <li>Menteri Lingkungan Hidup dan Kehutanan;</li> '
            . $loopprov1 .
            ' <li>Sekretaris Jendral Kementrian Lingkungan Hidup dan Kehutanan;</li>
                <li>Direktur Jendral Penegakan Hukum Lingkungan Hidup dan Kehutanan;</li> '
            . $loopkk1 .
            '<li>Pelaku Usaha ' . $skkl->pelaku_usaha_baru . ';</li>
            </ol>
        </td>
        </tr>';

        $body .= '</table>';

        return \Response::make($body, 200, $headers);
    }

    public function preview($id)
    {
        $data_skkl = Skkl::find($id);
        $il_skkl = il_skkl::where('id_skkl', $id)->get();
        return view('operator.skkl.preview', compact('data_skkl', 'il_skkl'));
    }
}
