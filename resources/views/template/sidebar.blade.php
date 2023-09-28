<!-- Sidebar -->
<?php
    if (Auth::check()) {
        for ($i = 0; $i < count($pemrakarsa_role); $i++) {
            if (Auth::user()->email == $pemrakarsa_role[$i]->email) {
                $role = 'Pemrakarsa';
            }
        }

        for ($i = 0; $i < count($operator_role); $i++) {
            if (Auth::user()->email == $operator_role[$i]->email) {
                $role = 'Operator';
            }
        }

        for ($i = 0; $i < count($sekretariat_role); $i++) {
            if (Auth::user()->email == $sekretariat_role[$i]->email) {
                $role = 'Sekretariat';
            }
        }
    } else {
        $role = 'ptsp';
    }
?>

<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #033022;">
    <img src="{{ asset('img/logo-amdal.png') }}" style="margin-left:25px; margin-right:25px;
    padding-top: 20px;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/operator">
        {{-- <div class="sidebar-brand-icon rotate-n-15"> --}}
            <!-- <i class="fas fa-laugh-wink"></i> -->
        {{-- </div> --}}
        {{-- <div class="sidebar-brand-text mx-3">Amdalnet</div> --}}
    </a>
    <center><button class=" btn btn-sm btn-success" style=" width:100px;"><a style="color: white;" href="https://amdalnet.menlhk.go.id/#/dashboard"> <i class="fas fa-home"></i> Back</a></button></center>

    @if ($role == 'Pemrakarsa')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('pemrakarsa.index') }}">
                <i class="fas fa-book"></i>
                <span>Perubahan SKKL</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('pkplh.index') }}" >
                <i class="fas fa-book"></i>
                <span>Perubahan PKPLH</span>
            </a>
        </li>
    @elseif ($role == 'Operator')
        <li class="nav-item {{ Request::routeIs('operator.skkl.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('operator.skkl.index') }}">
                <i class="fas fa-book"></i>
                <span>Perubahan SKKL</span>
            </a>
        </li>

        <li class="nav-item {{ Request::routeIs('operator.pkplh.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('operator.pkplh.index') }}" >
                <i class="fas fa-book"></i>
                <span>Perubahan PKPLH</span>
            </a>
        </li>
    @elseif ($role == 'Sekretariat')
        <li class="nav-item {{ Request::routeIs('sekre.skkl.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSkkl" aria-expanded="true" aria-controls="collapseSkkl">
                <i class="fas fa-book"></i>
                <span>Perubahan SKKL</span>
            </a>
            <div id="collapseSkkl" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::routeIs('sekre.skkl.index') ? 'active' : '' }}" href="{{ route('sekre.skkl.index') }}">Semua Permohonan</a>
                    <a class="collapse-item {{ Request::routeIs('sekre.skkl.sudah') ? 'active' : '' }}" href="{{ route('sekre.skkl.sudah') }}">Sudah Disposisi</a>
                    <a class="collapse-item {{ Request::routeIs('sekre.skkl.belum') ? 'active' : '' }}" href="{{ route('sekre.skkl.belum') }}">Belum Disposisi</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ Request::routeIs('sekre.pkplh.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePkplh" aria-expanded="true" aria-controls="collapsePkplh">
                <i class="fas fa-book"></i>
                <span>Perubahan PKPLH</span>
            </a>
            <div id="collapsePkplh" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::routeIs('sekre.pkplh.index') ? 'active' : '' }}" href="{{ route('sekre.pkplh.index') }}">Semua Permohonan</a>
                    <a class="collapse-item {{ Request::routeIs('sekre.pkplh.sudah') ? 'active' : '' }}" href="{{ route('sekre.pkplh.sudah') }}">Sudah Disposisi</a>
                    <a class="collapse-item {{ Request::routeIs('sekre.pkplh.belum') ? 'active' : '' }}" href="{{ route('sekre.pkplh.belum') }}">Belum Disposisi</a>
                </div>
            </div>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('ptsp.skkl.index') }}">
                <i class="fas fa-book"></i>
                <span>Perubahan SKKL</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('ptsp.pkplh.index') }}">
                <i class="fas fa-book"></i>
                <span>Perubahan PKPLH</span>
            </a>
        </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
