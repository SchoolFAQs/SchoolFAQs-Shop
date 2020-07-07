<header>
  <nav class="navbar navbar-expand-md border-bottom text-white bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand text-white" href="/"><i class="fa fa-shopping-cart"></i> SchoolFAQs Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fas fa-th-list text-white"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-white" href="/"><i class="fa fa-home"></i> Shop <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('vendor.apply') }}"><i class="fas fa-shopping-basket"></i> Sell</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('contact.create') }}"><i class="fas fa-phone-alt"></i> Contact Us</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
</header>
