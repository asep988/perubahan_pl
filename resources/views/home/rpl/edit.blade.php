@extends('template.master')
@section('content')
    <form action="{{ route('rpl.update', $rpl->id) }}" method="post" enctype="multipart/form-data">
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
                                <h4><b>Ubah Data (RPL)</b></h4>
                            </li>
                        </ul>
                    </div>
                </nav>
                <input type="hidden" name="id_skkl" value="{{ $rpl->id_skkl }}">
            </div>
            <div class="card-body">
                <table border="1" width="100%">
                    <tr>
                        <!-- dari -->
                        <td style="padding: 20px;">
                            <div class="user-detail">
                                <div class="input-box">
                                    <br>
                                    <label for="jenis_dampak" class="form-label">Jenis Dampak Yang Timbul</label>
                                    <div>
                                        <input type="text" class="form-control" name="jenis_dampak" require
                                            value="{{ $rpl->jenis_dampak }}">
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="indikator" class="form-label">Indikator</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="indikator">{!! $rpl->indikator !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <br>
                                    <label for="sumber_dampak" class="form-label">Sumber Dampak</label>
                                    <div>
                                        <input type="text" class="form-control" name="sumber_dampak"
                                            value="{{ $rpl->sumber_dampak }}" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label for="metode" class="form-label">Metode</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="metode">{!! $rpl->metode !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="lokasi">{!! $rpl->lokasi !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <br>
                                    <label for="waktu" class="form-label">Waktu</label>
                                    <div>
                                        <input type="text" class="form-control" name="waktu"
                                            value="{{ $rpl->waktu }}" required>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <br>
                                    <label for="pelaksana" class="form-label">Pelaksana</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="pelaksana">{!! $rpl->pelaksana !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <label for="pengawas" class="form-label">Pengawas</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="pengawas">{!! $rpl->pengawas !!}</textarea>
                                </div>
                                <div class="input-box">
                                    <label for="penerima" class="form-label">Penerima</label>
                                    <textarea class="form-control" id="myrpl" aria-label="editor" name="penerima">{!! $rpl->penerima !!}</textarea>
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
            selector: 'textarea#myrpl',
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
