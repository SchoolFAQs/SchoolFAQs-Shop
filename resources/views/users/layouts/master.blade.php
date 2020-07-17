<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		@include('users.layouts.header')

		<body>	
			<main role="main">	   
				@include('users.layouts.topbar')
    			@yield('sidebar')			
				<div class="container-fluid">
		    		<div class="modal-dialog my-3 modal-body">
						@include('messages.messages')
					</div>
				@yield('content')
				</div>
			</main>
			<div class="">
				@include('users.layouts.footer')
			</div>
  		</body>
</html>