<div class="leftpanel">
	<a href="{{route('login')}}"><img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="logo"></a>

	<ul class="left-nav" id="nav">
		<li class="list-group-item"><a href="{{route('login')}}"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Dashboard </a></li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Send Onbaording Link </a></li>
		
		<li class="list-group-item"><a href="{{ route('onboarding.list')}}"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Approve Onboarding </a></li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Mapping Employee</a></li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Distribute Traget</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Incentive</a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Salary Component </a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Form-16</a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">PF/ESI Update</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Approve Leave</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Approve TA/Expense</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Generate Salary</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Notification to Employee</a></li>
		
		<li class="list-group-item mb-1">
			<a href="javascript:void(0)" class="text-white" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false"><img src="{{asset('assets/assets/img/right.png')}}" alt="">
			  Reports
			</a>
			<div class="collapse" id="dashboard-collapse" style="padding-left: 40px ;">
			  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small text-white" style="padding:5px;">
				<li style="border:0px;padding:4px;"><a href="{{route('reports.calling-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Calling Reports</a></li>
				<li style="border:0px;padding:4px;"><a href="{{route('reports.appointment-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Appointment Reports</a></li>
				<li style="border:0px;padding:4px;"><a href="{{route('reports.visiting-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Visit Report</a></li>
				<li style="border:0px;padding:4px;"><a href="{{ route('reports.proposal-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Proposal Send Report</a></li>
				<li style="border:0px;padding:4px;"><a href="#" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Closing Reports</a></li>
			    </ul>
			</div>
		  </li>
		
		<li class="list-group-item"><a href="{{route('users.list')}}"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Block/Unblock Employee </a></li>
		<li class="list-group-item"><a href="{{route('general-settings')}}"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Master Settings</a></li>
		<li class="list-group-item"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
			document.getElementById('logout-form').submit();"><img src="{{asset('assets/assets/img/power.png')}}" alt="">Log Out </a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST">
			@csrf
		</form>	
	   </li>
		
		</ul>
		
		<p class="powerdPMIT">Powered by <a href="https://sikshapedia.com/" target="_blank">Sikshapedia.com</a>
        </p>
	
</div>
<div class="rightpanel">

	<div class="navbar">
		<div class="container-fluid">

			<h2 class="mobileOff ass-text">Superadmin Dashboard</h2>
		  <a class="navbar-brand desktopOff" href="{{route('login')}}" ><img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="logoMobile"></a>
		  <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button> -->

		  <div class="profileBar mobileOff">
			<div class="procon ass-text">
				<p class="">Welcome</p>
				<h4 class="my_name">
					{{auth()->user()->name}}
				</h4>
			</div>
			<div class="proImgMobile"><img src="{{asset('assets/assets/img/avatar.png')}}" alt="" class="profileBarpro"></div>
		</div>
		<div class="menubar">
		<a class="navbar-brand desktopOff mobileOn" href="{{route('login')}}" ><img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="logoMobile"></a>
		  <a class="btn btn-primary menu desktopOff mobileOn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
			Menu
		  </a>
		</div> 

		  <div class="offcanvas offcanvas-start desktopOff mobileOn" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
			<div class="offcanvas-header">
			  <h5 class="offcanvas-title" id="offcanvasExampleLabel"><img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="logoMobile"></h5>
			  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">

				<div class="profileBar">
					<div class="procon ass-text">
						<p class="">Welcome</p>
						<h4 class="my_name">
							{{auth()->user()->name}}
						</h4>
					</div>
					<div class="proImgMobile"><img src="{{asset('assets/assets/img/avatar.png')}}" alt="" class="profileBarpro"></div>
				</div>
				
				<ul class="left-nav desktopOff mobileOn" id="mob_nav">
					<li class="list-group-item"><a href="{{route('login')}}"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Dashboard </a></li>
		
					<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Send Onbaording Link </a></li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Approve Onboarding </a></li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Mapping Employee</a></li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Distribute Traget</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Incentive</a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Salary Component </a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Form-16</a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">PF/ESI Update</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Approve Leave</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Approve TA/Expense</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Generate Salary</a></li>

		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Notification to Employee</a></li>
		
		<li class="list-group-item mb-1">
			<a href="javascript:void(0)" class="text-white" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false"><img src="{{asset('assets/assets/img/right.png')}}" alt="">
			  Reports
			</a>
			<div class="collapse" id="dashboard-collapse" style="padding-left: 40px ;">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small text-white" style="padding:5px;">
					<li style="border:0px;padding:4px;"><a href="{{route('reports.calling-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Calling Reports</a></li>
					<li style="border:0px;padding:4px;"><a href="{{route('reports.appointment-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Appointment Reports</a></li>
					<li style="border:0px;padding:4px;"><a href="{{route('reports.visiting-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Visit Report</a></li>
					<li style="border:0px;padding:4px;"><a href="{{ route('reports.proposal-reports.list')}}" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Proposal Send Report</a></li>
					<li style="border:0px;padding:4px;"><a href="#" class="link-white rounded"><img src="{{asset('assets/assets/img/anchor-icon.png')}}" style="width:15px;" alt="">Closing Reports</a></li>
				</ul>
			</div>
		  </li>
		
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Block/Unblock Employe </a></li>
		<li class="list-group-item"><a href="#"><img src="{{asset('assets/assets/img/right.png')}}" alt="">Master Settings</a></li>
		<li class="list-group-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();"><img src="{{asset('assets/assets/img/power.png')}}" alt="">Log Out </a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf
			</form>	
		</li>
					
					
		</ul>
					
					<p class="powerdPMIT">Powered by <a href="https://sikshapedia.com/" target="_blank">Sikshapedia.com</a>
        </p>
				
			</div>
		  </div>

		</div>

</div>