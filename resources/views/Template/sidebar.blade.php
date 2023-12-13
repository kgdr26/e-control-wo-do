<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if($idn_user->role_id == 1)

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('upload_sto')}}">
                    <i class="bi bi-file-arrow-up-fill"></i>
                    <span>Upload STO</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('input_stowo')}}">
                    <i class="bi bi-file-break"></i>
                    <span>Input STO WO</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('input_stodo')}}">
                    <i class="bi bi-file-check"></i>
                    <span>Inpu STO DO</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('users')}}">
                    <i class="bi bi-person-circle"></i>
                    <span>Users</span>
                </a>
            </li>

        @elseif($idn_user->role_id == 2)

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('input_stowo')}}">
                    <i class="bi bi-file-break"></i>
                    <span>Input STO WO</span>
                </a>
            </li>

        @elseif($idn_user->role_id == 3)

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('input_stodo')}}">
                    <i class="bi bi-file-check"></i>
                    <span>Inpu STO DO</span>
                </a>
            </li>

        @elseif($idn_user->role_id == 4)

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('upload_sto')}}">
                    <i class="bi bi-file-arrow-up-fill"></i>
                    <span>Upload STO</span>
                </a>
            </li>

        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>



    </ul>

</aside>
