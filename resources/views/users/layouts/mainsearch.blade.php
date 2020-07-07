<form action="{{ route('search') }}" method="post">
  <div class="p-1 bg-light container rounded rounded-pill shadow-sm mb-4">
    <div class="input-group">
      <input type="search" name="search" placeholder="What are you searching for?" aria-describedby="button-addon1" class="form-control rounded border-0 bg-light">
      <div class="input-group-append">
        <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search text-dark"></i></button>
      </div>
    </div>
  </div> 
  @csrf  
</form>