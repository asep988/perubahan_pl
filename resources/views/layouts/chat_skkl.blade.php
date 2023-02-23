@extends('template.master')

@section('content')
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
                        <h4><b>Chat | No. Registrasi: {{ $data->noreg }}</b></h4>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                @include('layouts.navbar')
            </div>

        </nav>
    </div>
    <div class="card-body">
        {{-- <div class="container py-2">
            <div class="row">
                <div class="col-12">
                    <p>No. Registrasi: </p>
                </div>
            </div>
        </div>

        <hr> --}}

        <div class="container py-3">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <ul class="list-unstyled">

                        @if ($chat != null)
                            @for ($i = 0; $i < count($chat) - 1; $i++)
                                <li class="d-flex @if ($chat[$i]->sender == $role) justify-content-end @else justify-content-start @endif mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="fw-bold mb-0">{{ $chat[$i]->nama }}</p>
                                            <p class="text-muted small mb-0 ml-5"><i class="far fa-clock"></i> {{ tgl_indo2($chat[$i]->created_at->format('d-m-Y')) }}, {{ $chat[$i]->created_at->format('H:i') }}</p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">
                                                {{ $chat[$i]->chat }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endfor

                            <li class="d-flex @if ($chat[count($chat) - 1]->sender == $role) justify-content-end @else justify-content-start @endif mb-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between p-3">
                                        <p class="fw-bold mb-0">{{ $chat[count($chat) - 1]->nama }}&nbsp; @if($chat[count($chat) - 1]->sender == $role) <button type="button" id="edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button> @endif</p>
                                        <p class="text-muted small mb-0 ml-5"><i class="far fa-clock"></i> {{ tgl_indo2($chat[count($chat) - 1]->created_at->format('d-m-Y')) }}, {{ $chat[count($chat) - 1]->created_at->format('H:i') }}</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0" id="last">{{ $chat[count($chat) - 1]->chat }}</p>
                                    </div>
                                </div>
                            </li>
                        @endif
                        
                        <form action="{{ route('skkl.chat.create', $data->id) }}" method="POST" id="route">
                            @csrf
                            <input type="text" value="{{ $role }}" name="role" hidden>
                            <li class="bg-white mb-3">
                                <div class="form-outline">
                                    <textarea class="form-control" id="kolom-chat" rows="4" name="chat" required></textarea>
                                </div>
                            </li>
                            <button type="submit" class="btn btn-info btn-rounded float-end">Kirim</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($chat != null)
        <script>
            $(document).ready(function() {
                $('#edit').click(function() {
                    $("textarea#kolom-chat").val($('#last').html())
                    $("#route").removeAttr('action')
                    $("#route").attr('action', "{{ route('skkl.chat.update', $chat[count($chat) - 1]->id) }}")
                });
            });
        </script>
    @endif
@endpush
