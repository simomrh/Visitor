<nav class="nav">
    <div>
        <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                class="nav_logo-name">Visitor</span> </a>

        <div class="nav_list">
            <a href="{{ url('dashboard') }}" class="nav_link "> <i class="fa-solid fa-sliders icon"></i> <span
                    class="nav_name">Dashboard</span>
            </a>
            @if (Auth::user()->RoleUSR === 'admin')
                <a href="{{ url('/users') }}" class="nav_link"> <i class="fa-solid fa-user icon"></i> <span
                        class="nav_name">Utilisateurs</span>

                </a>
            @endif


            <a href="{{ url('/roundezVous') }}" class="nav_link"> <i class="fa-solid fa-calendar-check icon"></i>
                <span class="nav_name">Rendez-vous</span>
            </a>
            @if (Auth::user()->RoleUSR === 'admin')
            <a href="{{ url('/departemnt_view') }}" class="nav_link"> <i class="fa-solid fa-building icon"></i> <span
                    class="nav_name">Départements</span>
            </a>
            @endif
            <a href="{{ url('/visiteur') }}" class="nav_link"> <i class="fa-solid fa-person icon"> </i> <span
                    class="nav_name">Visiteurs</span>
            </a>

            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fa-solid fa-plus"></i>  Visites Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="{{ url('/visites') }}" class="nav_link"> <i class="fa-solid fa-business-time icon"></i> <span
                    class="nav_name">Visites</span>
            </a>
            <a href="{{ url('/types_view') }}" class="nav_link"> <i class="fa-solid fa-list"></i> <span
                class="nav_name">Type Visites</span>
            </a>
                </div>
              </div>

            @if (Auth::user()->RoleUSR === 'admin')
            <a href="{{ url('/journal_email') }}" class="nav_link"> <i class="fa-solid fa-envelope icon"></i> <span
                    class="nav_name">Journal Email</span>

            </a>
        @endif
        @if (Auth::user()->RoleUSR === 'admin')
        <a href="{{ url('/events') }}" class="nav_link"> <i class="fa-solid fa-ban icon"></i> <span
                class="nav_name">temps intervalle</span>

        </a>
    @endif

        </div>
    </div>
    <a href="#" class="nav_link deconnectBtn" onclick="document.getElementById('logout-form').submit();"> <i
            class='bx bx-log-out nav_icon'></i> <span class="btn btn-outline-light">Se déconnecter</span> </a>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none">
        @csrf
    </form>

</nav>
