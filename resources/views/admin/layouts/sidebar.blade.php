<div class="container-fluid">
  <div class="row">
    @can('isVendor')
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 position-fixed d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
         <li class="nav-item sidebar-heading text-muted"> 
               <h6><i class="fa fa-gear"></i> Admin Control Panel</h6>
          </li>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Vendor</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          </a>
        </h6>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('store.index') }}">
              <span><i class="fa fa-home"></i></span>
              My Store
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('page.index') }}">
              <span> <i class="fas fa-shopping-cart"></i></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#">
              <span><i class="fa fa-money"></i></span>
              Withdrawals
            </a>
          </li>
        </ul>
        <hr>
        @endcan
        @can('isAdmin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Admin</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('products.index') }}">
              <span><i class="fas fa-book"></i></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('category.index') }}">
              <span><i class="fas fa-layer-group"></i></span>
              Categories
            </a>
          </li>
          @endcan
          @can('isSuperAdmin')
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Super Admin</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          </a>
        </h6>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('vendors.index') }}">
              <span><i class="fas fa-store"></i></span>
              Vendors
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('user.index') }}">
              <span><i class="fas fa-user"></i></span>
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('today.sales') }}">
              <span><i class="fas fa-calendar-day"></i></span>
              Current day
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('month.sales') }}">
              <span><i class="far fa-calendar-alt"></i></span>
              Monthly Sales
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('quarter.sales') }}">
              <span><i class="fas fa-calendar-week"></i></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('year.sales') }}">
              <span><i class="far fa-calendar"></i></span>
              Year-end sale
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('totalorders.index') }}">
              <span><i class="fas fa-shopping-cart"></i></span>
              All Time Sales
            </a>
          </li>
        </ul>
      @endcan
      </div>
    </nav>