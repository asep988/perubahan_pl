@extends('template.master')
@section('content')
    <form action="{{ route('rkl.update', $rkl->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
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
                                        <input type="text" class="form-control" name="dampak_dikelola"
                                            value="{{ $rkl->dampak_dikelola }}" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                                    <div>
                                        <input type="text" class="form-control" name="sumber_dampak"
                                            value="{{ $rkl->sumber_dampak }}" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="indikator" class="form-label">Indikator Keberhasilan Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="indikator">{!! $rkl->indikator !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <label for="bentuk_pengelolaan" class="form-label">Bentuk Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="bentuk_pengelolaan">{!! $rkl->bentuk_pengelolaan !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <label for="lokasi" class="form-label">Lokasi Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="lokasi">{!! $rkl->lokasi !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <label for="periode" class="form-label">Periode Pengelolaan LH</label>
                                    <input type="text" class="form-control" name="periode" value="{{ $rkl->periode }}"
                                        required>
                                </div>
                                <div class="input-box">
                                    <label for="institusi" class="form-label">Institusi Pengelolaan LH</label>
                                    <textarea class="form-control" id="myrkl" aria-label="editor" name="institusi">{!! $rkl->institusi !!}</textarea>
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

@push('scripts')
    <script>
        tinymce.init({
            selector: 'textarea#myrkl',
            height: 400,
            forced_root_block: "",
            force_br_newlines: true,
            force_p_newlines: true,
            plugins: 'anchor autolink charmap codesample link lists searchreplace visualblocks wordcount',
            toolbar1: 'undo redo | insert | styleselect | bold italic | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ',
            toolbar2: 'forecolor backcolor emoticons | fontselect | fontsizeselect | fullscreen',
            templates: [{
                    title: 'Test template 1',
                    content: ''
                },
                {
                    title: 'Test template 2',
                    content: ''
                }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
        });
    </script>
@endpush
