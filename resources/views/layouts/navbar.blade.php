<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    <li class="nav-item dropdown no-arrow mx-1">
        <!-- Dropdown - Alerts -->
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if ($notif_jml != 0)
                <span class="badge badge-danger badge-counter">{{ $notif_jml }}</span>
            @elseif ($notif_jml > 10)
                <span class="badge badge-danger badge-counter">10+</span>
            @endif
            <i class="fas fa-bell fa-fw"></i>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Notifikasi
            </h6>
            @if ($notif_skkl != null)
                <?php $i = 0; ?>
                @foreach ($notif_skkl as $notif)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('skkl.notif.update', $notif->id) }}">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-comments text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $notif->created_at->format('d M Y') }}</div>
                            <span>Chat SKKL dengan Noreg {{ $notif->noreg }} oleh {{ $notif->pelaku_usaha_baru }}</span>
                        </div>
                    </a>
                    <?php $i++; ?>
                    @if ($i == 10)
                        @break
                    @endif
                @endforeach
            @endif
            @if ($notif_pkplh != null)
                <?php $i = 0; ?>
                @foreach ($notif_pkplh as $notif)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('pkplh.notif.update', $notif->id) }}">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-comments text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $notif->created_at->format('d M Y') }}</div>
                            <span>Chat PKPLH dengan Noreg {{ $notif->noreg }} oleh {{ $notif->pelaku_usaha_baru }}</span>
                        </div>
                    </a>
                    <?php $i++; ?>
                    @if ($i == 10)
                        @break
                    @endif
                @endforeach
            @endif
        </div>
    </li>
    @guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
    @if (Route::has('register'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
    @endif
    @else
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

    @endguest
</ul>