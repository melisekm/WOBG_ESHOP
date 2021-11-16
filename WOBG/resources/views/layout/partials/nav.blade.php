<header>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{url("/")}}">
                <img src="{{asset("img/cubes.svg")}}" alt="logo">
                <span class="mx-3 ps-1">wobg.com</span>
            </a>
            <form class="me-lg-3" id="search_form">
                <div class="mx-auto search-wrapper">
                    <div class="form-white input-group">
                        <div class="search-input">
                            <div class="icon"><i class="fas fa-search fa-lg pt-1 px-1"></i></div>
                            <a href="" target="_blank" hidden></a>

                            <input id="searchGroup" type="search" class="form-control rounded-pill"
                                   placeholder="Search..." aria-label="Search">
                            <div class="autocom-box bg-dark">
                                <!-- here list are inserted from javascript -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <button id="hamburger-btn" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#toggleMobileMenu"
                    aria-controls="toggleMobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="toggleMobileMenu">
                <ul class="navbar-nav nav-fill w-100">
                    <li class="nav-item">
                        <a class="nav-link" href={{url("products")}}>Board games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart " href={{url("cart")}}><i
                                class="fas fa-shopping-cart fa-lg"></i>
                            <span id="cartCount" class="cart-basket  text-white">
                                {{App\Facades\Cart::getCartCount()}}
                            </span></a>
                    </li>
                    @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("profile")}}">My Account</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{route("logout")}}">
                                @csrf
                                <a class="nav-link" href="{{route("logout")}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">Logout</a>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href={{url("login")}}>Sign in</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{url("register")}}>Sign up</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
