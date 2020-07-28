<div>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="https://z11.live/">
                        Z11 Admin Panel
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}"><img src="/img/conf.png" width="20px" height="20px"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">

                                </form>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/past_matches">Past Matches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/live_matches">Live Matches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/future_matches">Future Matches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/merge_series">Merge Series</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
        <div>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/countries">Countries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/heroes">Heroes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/trainers">Trainers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/players">Players</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/teams">Teams</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/leagues">Leagues</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/streams">Streams</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/banners">Banners</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/users">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/coefficients">Сoefficients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/bwords">Bad Words</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/cosplay">Cosplay</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $route }}/news">News</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
