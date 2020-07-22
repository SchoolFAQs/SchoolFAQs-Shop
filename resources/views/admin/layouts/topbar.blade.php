<header class="sticky-top">
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  		<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ route('admin.dashboard') }}"><i class="fas fa-shopping-cart"></i> SchoolFAQs Shop | Control Panel</a>
  		<button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  		<ul class="navbar-nav px-3">
  			<li class="nav-item text-nowrap d-xs-none text-light">
    			<i class="fas fa-user"></i> Welcome {{Auth::user()->name}}
    		</li>
    		<li class="nav-item text-nowrap">
          <form  action="{{ route('logout') }}" method="POST">
            <input type="submit" class="btn form-control float-right btn-danger mb-2" value="Sign Out">
              @csrf
          </form>
      			
    		</li>
  		</ul>
	</nav>
</header>
