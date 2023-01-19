@extends('template.master')

@section('content')
<div class="card-header">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li>
                    <h4><b>Penugasan pada Pernyataan PKPLH</b></h4>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
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
            </ul>
        </div>

    </nav>
</div>
<div class="card-body">
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <table id="datatable" class="table table-bordered table-striped" style="table-layout: fixed;">
        <thead>
            <tr class="text-center">
                <th width="70px">No</th>
                <th>Nama Usaha/Kegiatan</th>
                <th>Perihal Perubahan PL</th>
                <th>NIB</th>
                <th>Nama PJM</th>
                <th width="120px">Penugasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_pkplh as $pkplh)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pkplh->nama_usaha_baru }}</td>
                <td>{{ $pkplh->perihal }}</td>
                <td>{{ $pkplh->nib }}</td>
                <td>
                    @if ($pkplh->nama_operator != null)
                        {{ $pkplh->nama_operator }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <form action="{{ route('sekre.pkplh.update', $pkplh->id) }}" method="POST">
                        @csrf
                        @method('PUT')    
                        <select class="operator-list" style="width: 100%" name="operator_name">
                            <option value="-">Pilih</option>
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->name }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-sm btn-success btn-block" @if ($pkplh->status != "Belum") disabled @endif>Tugaskan</button>
                    </form>
                    {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="{{ '#aksiModal'.$pkplh->id }}">
                        Tugaskan
                    </button> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
@foreach ($data_pkplh as $pkplh)
<div class="modal fade operator-modal" id="{{ 'aksiModal'.$pkplh->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Operator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sekre.pkplh.update', $pkplh->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="operator_name" class="col-form-label">Operator untuk ditugaskan</label>
                        <select class="operator-list" id="operator_name" style="width: 100%" name="operator_name">
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->name }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-sm btn-success btn-block" @if ($pkplh->status != "Belum") disabled @endif>Tugaskan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        // $('#operator_name').select2({
        //     dropdownParent: $('.operator-modal')
        // });

        $('.operator-list').select2();
        $("#datatable").DataTable({
            lengthmenu: [
                [5,10,25,50,-1],
                [5,10,25,50,'All']
            ],
            responsive: true,
            "columns": [
                { "width": "1%" },
                null,
                null,
                null,
                null,
                { "width": "25%" }
            ]
        });
    });
</script>
@endpush