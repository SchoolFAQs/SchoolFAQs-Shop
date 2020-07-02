<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		@include('users.layouts.header')

		<body>	
			<main role="main">	   
				@include('users.layouts.topbar')
				<div class="container-fluid">
		    		<div class="modal-dialog modal-body">
						@include('messages.messages')
					</div>
				@yield('content')
				</div>
			</main>
			@include('users.layouts.footer')
  		</body>
</html>