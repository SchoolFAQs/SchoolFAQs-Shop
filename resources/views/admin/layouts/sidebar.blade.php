<div class="container-fluid">
  <div class="row">
    @can('isVendor')
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 position-fixed d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-1">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('store.index') }}">
              <span><i class="fa fa-home"></i></span>
              My Store 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('products.index') }}">
              <span><i class="fas fa-book"></i></span>
              Products <span class="badge img-thumbnail">{{number_format($my_products)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('uservendors.index') }}">
              <span><i class="fas fa-store"></i></span>
              Vendors <span class="badge img-thumbnail">{{number_format($my_vendors)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('page.index') }}">
              <span> <i class="fas fa-shopping-cart"></i></span>
              Orders <span class="badge img-thumbnail">{{number_format($my_orders)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#">
              <span><i class="fa fa-money"></i></span>
              Withdrawals <span class="badge img-thumbnail">#</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('user.profile', Auth()->User()->slug) }}">
              <span><i class="fa fa-user"></i></span>
              My Profile
            </a>
          </li>
        </ul>
        @endcan
        @can('isAdmin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 text-muted">
          <span>Admin</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          </a>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('category.index') }}">
              <span><i class="fas fa-layer-group"></i></span>
              Categories <span class="badge img-thumbnail">{{number_format($total_categories)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('adminmessage.index') }}">
              <span><i class="fas fa-envelope"></i></span>
              Messages <span class="badge img-thumbnail">{{number_format($total_messages)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('applications.index') }}">
              <span><i class="fas fa-users"></i></span>
              Vendor Applications <span class="badge img-thumbnail">{{number_format($total_applications)}}</span>
            </a>
          </li>
          @endcan
          @can('isSuperAdmin')
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 text-muted">
            <span>Super Admin</span>
          </h6>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('user.index') }}">
              <span><i class="fas fa-user"></i></span>
              Users <span class="badge img-thumbnail">{{number_format($total_users)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('adminproducts.index') }}">
              <span><i class="fas fa-book"></i></span>
              Total Products <span class="badge img-thumbnail">{{number_format($total_products)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('adminvendors.index') }}">
              <span><i class="fas fa-store"></i></span>
              Total Vendors <span class="badge img-thumbnail">{{number_format($total_vendors)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#">
              <span><i class="fas fa-search"></i></span>
              Audit
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('sms.index') }}">
              <span><i class="fas fa-envelope"></i></span>
              SMS <span class="badge img-thumbnail">{{number_format($messages_count)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="#">
              <span><i class="fas fa-money-bill"></i></span>
              Finances
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('today.sales') }}">
              <span><i class="fas fa-calendar-day"></i></span>
              Current day <span class="badge img-thumbnail">{{number_format($total_today_orders)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('month.sales') }}">
              <span><i class="far fa-calendar-alt"></i></span>
              Monthly Sales <span class="badge img-thumbnail">{{number_format($total_month_orders)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('quarter.sales') }}">
              <span><i class="fas fa-calendar-week"></i></span>
              Last quarter <span class="badge img-thumbnail">{{number_format($total_quater_orders)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('year.sales') }}">
              <span><i class="far fa-calendar"></i></span>
              Year-end sale <span class="badge img-thumbnail">{{number_format($total_year_orders)}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('totalorders.index') }}">
              <span><i class="fas fa-shopping-cart"></i></span>
              All Time Sales <span class="badge img-thumbnail">{{number_format($all_time_orders)}}</span>
            </a>
          </li>
        </ul>
      @endcan
      </div>
    </nav>