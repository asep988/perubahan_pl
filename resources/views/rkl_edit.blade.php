@extends('template.master')
@section('content')
<form action="{{ route('rkl.update', $rkl->id) }}" method="post" enctype="multipart/form-data">
    @csrf
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
                            <h4><b>Ubah Data (RKL)</b></h4>
                        </li>
                    </ul>
                </div>
            </nav>
            <input type="hidden" name="id_skkl" value="{{ $rkl->id_skkl }}">
        </div>
        <div class="card-body">
            <table border="1" width="100%">
                <tr>
                    <!-- dari -->
                    <td style="padding: 20px;">
                        <div class="user-detail">
                            <div class="input-box">
                                <br>
                                <label for="tahap_kegiatan" class="form-label">Tahap Kegiatan</label>
                                <div>
                                    <select name="tahap_kegiatan" id="tahap_kegiatan" class="form-control">
                                        <option value="Pra Konstruksi">Pra Konstruksi</option>
                                        <option value="Konstruksi">Konstruksi</option>
                                        <option value="Operasi">Operasi</option>
                                        <option value="Pasca Operasi">Pasca Operasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-box">
                                <br>
                                <label for="jenis_dph" class="form-label">Jenis Dampak Penting</label>
                                <div>
                                    <select name="jenis_dph" id="jenis_dph" class="form-control">
                                        <option value="Penting">Dampak Penting yang Dikelola</option>
                                        <option value="Lainnya">Dampak Lainnya yang Dikelola</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-box">
                                <br>
                                <label for="dampak_dikelola" class="form-label">Dampak Lingkungan yang dikelola</label>
                                <div>
                                    <input type="text" class="form-control" name="dampak_dikelola" value="{{$rkl->dampak_dikelola}}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                                <div>
                                    <input type="text" class="form-control" name="sumber_dampak" value="{{$rkl->sumber_dampak}}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="indikator" class="form-label">Indikator Keberhasilan Pengelolaan LH</label>
                                <div>
                                    <input type="text" class="form-control" name="indikator" value="{{$rkl->indikator}}" required>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="bentuk_pengelolaan" class="form-label">Bentuk Pengelolaan LH</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="bentuk_pengelolaan">{!! ($rkl->bentuk_pengelolaan) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="lokasi" class="form-label">Lokasi Pengelolaan LH</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi">{!! ($rkl->lokasi) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="periode" class="form-label">Periode Pengelolaan LH</label>
                                <input type="text" class="form-control" name="periode" value="{{$rkl->periode}}" required>
                            </div>
                            <div class="input-box">
                                <label for="institusi" class="form-label">Institusi Pengelolaan LH</label>
                                <input type="text" class="form-control" name="institusi" value="{{$rkl->institusi}}" required>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <br>

        <div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endsection