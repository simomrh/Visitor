<nav class="nav">
    <div>
        <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                class="nav_logo-name">Visitor</span> </a>
        <div class="nav_list">
            <a href="{{ url('dashboard') }}" class="nav_link "> <i class='bx bx-grid-alt nav_icon'></i> <span
                    class="nav_name">Dashboard</span>
            </a>

            <a href="{{ url('/users') }}" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                    class="nav_name">Utilisateurs</span>
            </a>

            <a href="{{ url('/roundezVous') }}" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i>
                <span class="nav_name">Rendez-vous</span>
            </a>

            <a href="{{url('/departemnt_view')}}" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span
                class="nav_name">Departemnt</span>
            </a>

            <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span
                    class="nav_name">Visiteurs</span>
            </a>


            <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span
                    class="nav_name">Visites</span>
            </a>
            <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                    class="nav_name">Contact</span>
            </a>
        </div>
    </div>
    <a href="#" class="nav_link deconnectBtn" onclick="document.getElementById('logout-form').submit();"> <i
            class='bx bx-log-out nav_icon'></i> <span class="btn btn-outline-light">Se déconnecter</span> </a>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none">
        @csrf
    </form>

</nav>
