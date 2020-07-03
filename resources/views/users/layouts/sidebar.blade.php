<div class="container-fluid mt-5">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 position-fixed d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Filter by</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          </a>
        </h6>
          <li class="nav-item">
             <div data-role="page">
                <div data-role="header">
                 {{-- <h3>Price Slider</h3>
                </div>--}}

                <div data-role="main" class="ui-content">
                  <form method="post" action="{{ route('category.search') }}">
                    {{--<div data-role="rangeslider">
                      <label for="price-min">Min</label>
                      <input type="range" name="search" class="form-control" name="price-min" id="price-min" value="200" min="0" max="1000">
                      <label for="price-max">Max</label>
                      <input type="range" name="search" class="form-control" name="price-max" id="price-max" value="800" min="0" max="1000">
                    </div>
                    <div> --}} ​
                  <h3>Categories</h3>
                    </div>
                    @foreach($category as $cat)
                    <div class="form-group form-check">
                      <input type="checkbox" name="search" value="{{$cat->id}}" class="form-check-input" id="category">
                      <label class="form-check-label" for="category">{{$cat->category_name}}</label>
                    </div>
                    @endforeach
                    @csrf
                      <input type="submit" class="btn btn-primary mb-3" value="Search" data-inline="true" value="Submit">
                    </form>
                </div>
              </div>
          </li>
        </ul>
      </div>
    </nav>