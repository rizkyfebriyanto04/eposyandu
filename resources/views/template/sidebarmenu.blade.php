<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        <li
            class="sidebar-item active ">
            <a href="{{ route('home')}}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if(auth()->check() && auth()->user()->role === 'admin' || 'petugaspkk')

        @if(auth()->check() && (auth()->user()->role === 'admin'))
        <li
            class="sidebar-item ">
            <a href="{{ route('registrasi') }}" class='sidebar-link'>
                <i class="fa fa-address-card"></i>
                <span>Registrasi</span>
            </a>
        </li>
        @endif

        <li
            class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Data User</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item  ">
                    <a href="{{ route('pasien') }}" class="submenu-link">User</a>
                </li>
                <li class="submenu-item  ">
                    <a href="{{ route('penimbangan') }}" class="submenu-link">Penimbangan</a>
                </li>
                <li class="submenu-item  ">
                    <a href="{{ route('imunisasi') }}" class="submenu-link">Imunisasi</a>
                </li>
                <li class="submenu-item  ">
                    <a href="{{ route('stunting') }}" class="submenu-link">Stunting</a>
                </li>
                <li class="submenu-item  ">
                    <a href="{{ route('obat') }}" class="submenu-link">Vitamin / Obat</a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'pasien' || auth()->user()->role === 'admin' || auth()->user()->role === 'petugasppk'))
        <li
            class="sidebar-item ">
            <a href="{{ route('tampilpasien') }}" class='sidebar-link'>
                <i class="fas fa-search"></i>
                <span>Cari User</span>
            </a>
        </li>
        @endif
    </ul>
    <br>
    <ul class="menu">
        <li
            class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-person-fill"></i>
                <span>{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item  ">
                    <a href="{{ route('logoutaksi') }}" class="submenu-link" onclick="return confirm('Apakah anda yakin ingin keluar ?')">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
