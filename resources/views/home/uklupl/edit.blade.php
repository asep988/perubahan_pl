@extends('template.master')
@section('content')
<form action="{{ route('uklupl.update', $uklupl->id) }}" method="post" enctype="multipart/form-data">
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
                            <h4><b>Ubah Data (UKL-UPL)</b></h4>
                        </li>
                    </ul>
                </div>
            </nav>
            <input type="hidden" name="id_pkplh" value="{{ $uklupl->id_pkplh }}">
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
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <select name="tahap_kegiatan" id="tahap_kegiatan" class="form-control">
                                            <option value="Pra Konstruksi">Pra Konstruksi</option>
                                            <option value="Konstruksi">Konstruksi</option>
                                            <option value="Operasi">Operasi</option>
                                            <option value="Pasca Operasi">Pasca Operasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sumber_dampak" value="{{$uklupl->sumber_dampak}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="jenis_dampak" class="form-label">Jenis Dampak</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="jenis_dampak" value="{{$uklupl->jenis_dampak}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="besaran_dampak" class="form-label">Besaran Dampak</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="besaran_dampak" value="{{$uklupl->besaran_dampak}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="besaran_dampak" class="form-label">Bentuk Pengelolaan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="bentuk_pengelolaan">{!!$uklupl->bentuk_pengelolaan!!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="lokasi_pengelolaan" class="form-label">Lokasi Pengelolaan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi_pengelolaan">{!!$uklupl->lokasi_pengelolaan!!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="periode_pengelolaan" class="form-label">Periode Pengelolaan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="periode_pengelolaan" value="{{$uklupl->periode_pengelolaan}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="bentuk_pemantauan" class="form-label">Bentuk Pemantauan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="bentuk_pemantauan">{!!$uklupl->bentuk_pemantauan!!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="lokasi_pemantauan" class="form-label">Lokasi Pemantauan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="mytextarea" aria-label="editor" name="lokasi_pemantauan">{!!$uklupl->lokasi_pemantauan!!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="periode_pemantauan" class="form-label">Periode Pemantauan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="periode_pemantauan" value="{{$uklupl->periode_pemantauan}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="institusi" class="form-label">Institusi Pengelola dan Pemantau</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="institusi" value="{{$uklupl->institusi}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="keterangan" value="{{$uklupl->keterangan}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <br>

            <div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
</form>
</div>
</div>
@endsection