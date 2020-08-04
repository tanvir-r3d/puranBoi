@include('Backend.layouts.app_css')
@include('Backend.layouts.app_header')
@include('Backend.layouts.app_sidebar')

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
      			<div class="page-body">
					@include('Backend.layouts.app_pagehead')
					@yield('content') 
				</div>
			</div>
		</div>
	</div>
</div>

@include('Backend.layouts.app_js')
 