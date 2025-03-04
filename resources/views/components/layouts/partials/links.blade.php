<div class="navbar-nav order-md-last flex-grow-0">
    <li class="nav-item"><a class="nav-link active" href="/" aria-current="page">Home</a></li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Alumni</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/loker">Loker</a></li>
            <li><a class="dropdown-item" href="/beasiswa">Beasiswa</a></li>
            <li><a class="dropdown-item" href="/prestasi">prestasi</a></li>

        </ul>
    </li>

    <li class="nav-item"><a class="nav-link" href="/kuesioner">Kuesioner</a></li>
    @auth
        <li class="nav-item"><a class="nav-link" href="/logout">Keluar</a></li>
    @endauth
    @guest
        <li class="nav-item"><a class="nav-link" href="/login">Masuk</a></li>
    @endguest

</div>
