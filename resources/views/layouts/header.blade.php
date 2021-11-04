<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			@include("layouts.shortcuts")
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="{{ asset('assets/attachment/user/'.Auth::user()->image) }}" class="logo-icon" alt="{{ Auth::user()->name }}">
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{ Auth::user()->name }}</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="/profile/{{ Auth::user()->id }}"><i class="bx bx-user"></i><span>Profile</span></a></li>
					<!-- <li>
						<div class="dropdown-divider mb-0"></div>
					</li> -->
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							<i class='bx bx-log-out-circle'></i><span>Logout</span>
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>