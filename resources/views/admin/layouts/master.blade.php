<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		@include('admin.layouts.header')	
		<body>		   
				@include('admin.layouts.topbar')
				@include('admin.layouts.sidebar')
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
					<div class="container-fluid">

			    		<div class="modal-dialog modal-body">
							@include('messages.messages')
						</div>
						<div class="mb-5">
							@yield('content')
						</div>
						

					</div>				
				</main>
				<div class="fixed-bottom">
						@include('admin.layouts.footer')
				</div>
  		</body>
</html>