 <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
					<li class="menu-title">BASIC FEATURES</li>
					<li><a href="{{ route('admin.dashboard')}}">
						<div class="menu-icon">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M2.5 7.49999L10 1.66666L17.5 7.49999V16.6667C17.5 17.1087 17.3244 17.5326 17.0118 17.8452C16.6993 18.1577 16.2754 18.3333 15.8333 18.3333H4.16667C3.72464 18.3333 3.30072 18.1577 2.98816 17.8452C2.67559 17.5326 2.5 17.1087 2.5 16.6667V7.49999Z" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M7.5 18.3333V10H12.5V18.3333" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>	
						<span class="nav-text">Dashboard</span>
						</a>
						
					</li>
					@if(auth()->user()->roles->pluck('name')[0] == 'Superadmin' ||  (auth()->user()->roles->pluck('name')[0] == 'Admin'))
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.5346 2.55658H7.1072C4.28845 2.55658 2.52112 4.55216 2.52112 7.37733V14.9985C2.52112 17.8237 4.2802 19.8192 7.1072 19.8192H15.1959C18.0238 19.8192 19.7829 17.8237 19.7829 14.9985V11.3062" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M8.09214 10.0108L14.9424 3.16057C15.7958 2.30807 17.1791 2.30807 18.0325 3.16057L19.1481 4.27615C20.0015 5.12957 20.0015 6.51374 19.1481 7.36624L12.2648 14.2495C11.8917 14.6226 11.3857 14.8325 10.8577 14.8325H7.42389L7.51006 11.3675C7.52289 10.8578 7.73097 10.372 8.09214 10.0108Z" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.9014 4.21895L18.0869 8.40445" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>	
						<span class="nav-text">Visitor Management</span>
						</a>
						<ul aria-expanded="false">
							
							<li><a href="{{ route('visitor-management.list')}}">Visitor Management</a></li>
						</ul>
					</li>
					@endif


					<li><a href="{{route('call-register.list')}}" aria-expanded="false">
						<div class="menu-icon">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.353 2.5C18.054 2.911 20.978 5.831 21.393 9.532" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M14.353 6.04303C16.124 6.38703 17.508 7.77203 17.853 9.54303" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M11.0315 12.4724C15.0205 16.4604 15.9254 11.8467 18.4653 14.3848C20.9138 16.8328 22.3222 17.3232 19.2188 20.4247C18.8302 20.737 16.3613 24.4943 7.68447 15.8197C-0.993406 7.144 2.76157 4.67244 3.07394 4.28395C6.18377 1.17385 6.66682 2.58938 9.11539 5.03733C11.6541 7.5765 7.04254 8.48441 11.0315 12.4724Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
						</div>	
						<span class="nav-text">Call Register</span>
						</a>
						
					</li>

					<li><a href="{{route('book-appointment.list')}}" aria-expanded="false">
						<div class="menu-icon">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.8877 10.8967C19.2827 10.7007 20.3567 9.50467 20.3597 8.05567C20.3597 6.62767 19.3187 5.44367 17.9537 5.21967" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M19.7285 14.2503C21.0795 14.4523 22.0225 14.9253 22.0225 15.9003C22.0225 16.5713 21.5785 17.0073 20.8605 17.2813" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M11.8867 14.6638C8.67273 14.6638 5.92773 15.1508 5.92773 17.0958C5.92773 19.0398 8.65573 19.5408 11.8867 19.5408C15.1007 19.5408 17.8447 19.0588 17.8447 17.1128C17.8447 15.1668 15.1177 14.6638 11.8867 14.6638Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M11.8869 11.8879C13.9959 11.8879 15.7059 10.1789 15.7059 8.06888C15.7059 5.95988 13.9959 4.24988 11.8869 4.24988C9.7779 4.24988 8.0679 5.95988 8.0679 8.06888C8.0599 10.1709 9.7569 11.8809 11.8589 11.8879H11.8869Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M5.88509 10.8967C4.48909 10.7007 3.41609 9.50467 3.41309 8.05567C3.41309 6.62767 4.45409 5.44367 5.81909 5.21967" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M4.044 14.2503C2.693 14.4523 1.75 14.9253 1.75 15.9003C1.75 16.5713 2.194 17.0073 2.912 17.2813" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
						</div>	
						<span class="nav-text">Appointments</span>
						</a>
						
					</li>

					<li><a href="{{route('visit-register.list')}}" aria-expanded="false">
						<div class="menu-icon">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15.7161 16.2234H8.49609" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M15.7161 12.0369H8.49609" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M11.2511 7.86011H8.49609" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M15.9085 2.74982C15.9085 2.74982 8.23149 2.75382 8.21949 2.75382C5.45949 2.77082 3.75049 4.58682 3.75049 7.35682V16.5528C3.75049 19.3368 5.47249 21.1598 8.25649 21.1598C8.25649 21.1598 15.9325 21.1568 15.9455 21.1568C18.7055 21.1398 20.4155 19.3228 20.4155 16.5528V7.35682C20.4155 4.57282 18.6925 2.74982 15.9085 2.74982Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
						</div>	
						<span class="nav-text">Visit Report</span>
						</a>
						
					</li>
					 @if(auth()->user()->roles->pluck('name')[0] == 'Superadmin' ||  (auth()->user()->roles->pluck('name')[0] == 'Admin'))
					<li class="menu-title">OTHER FEATURES</li>
					<li class="@if(Route::is('users.*')){{'mm-active'}} @endif"><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M10.986 14.0673C7.4407 14.0673 4.41309 14.6034 4.41309 16.7501C4.41309 18.8969 7.4215 19.4521 10.986 19.4521C14.5313 19.4521 17.5581 18.9152 17.5581 16.7693C17.5581 14.6234 14.5505 14.0673 10.986 14.0673Z" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M10.986 11.0054C13.3126 11.0054 15.1983 9.11881 15.1983 6.79223C15.1983 4.46564 13.3126 2.57993 10.986 2.57993C8.65944 2.57993 6.77285 4.46564 6.77285 6.79223C6.76499 9.11096 8.63849 10.9975 10.9563 11.0054H10.986Z" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>	
						<span class="nav-text">User Management</span>
						</a>
						<ul aria-expanded="false" class="@if(Route::is('users.*')){{'mm-collapse mm-show left'}} @endif">
							<li class="@if(Route::is('users.*')){{'mm-active'}} @endif"><a class="@if(Route::is('users.*')){{'mm-active'}} @endif" href="{{ route('users.list') }}">User List</a></li>
							<!--<li><a href="{{ route('admin.userRoleList') }}">Role List</a></li>-->
						</ul>
					</li>
					<!--<li class="@if(Route::is('system-modules.*')){{'mm-active'}} @endif"><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M20.8064 7.62355L20.184 6.54346C19.6574 5.62954 18.4905 5.31426 17.5753 5.83866V5.83866C17.1397 6.09528 16.6198 6.16809 16.1305 6.04103C15.6411 5.91396 15.2224 5.59746 14.9666 5.16131C14.8021 4.88409 14.7137 4.56833 14.7103 4.24598V4.24598C14.7251 3.72916 14.5302 3.22834 14.1698 2.85761C13.8094 2.48688 13.3143 2.2778 12.7973 2.27802H11.5433C11.0367 2.27801 10.5511 2.47985 10.1938 2.83888C9.83644 3.19791 9.63693 3.68453 9.63937 4.19106V4.19106C9.62435 5.23686 8.77224 6.07675 7.72632 6.07664C7.40397 6.07329 7.08821 5.98488 6.81099 5.82035V5.82035C5.89582 5.29595 4.72887 5.61123 4.20229 6.52516L3.5341 7.62355C3.00817 8.53633 3.31916 9.70255 4.22975 10.2322V10.2322C4.82166 10.574 5.18629 11.2055 5.18629 11.889C5.18629 12.5725 4.82166 13.204 4.22975 13.5457V13.5457C3.32031 14.0719 3.00898 15.2353 3.5341 16.1453V16.1453L4.16568 17.2345C4.4124 17.6797 4.82636 18.0082 5.31595 18.1474C5.80554 18.2865 6.3304 18.2248 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6515 8.2191 17.7821C8.70725 17.9128 9.12299 18.233 9.37392 18.6716C9.53845 18.9488 9.62686 19.2646 9.63021 19.5869V19.5869C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5 14.7053 20.6491 14.7103 19.5961V19.5961C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6806 16.6233 17.6831C16.9449 17.6917 17.2594 17.7797 17.5387 17.9393V17.9393C18.4515 18.4653 19.6177 18.1543 20.1474 17.2437V17.2437L20.8064 16.1453C21.0615 15.7074 21.1315 15.1859 21.001 14.6963C20.8704 14.2067 20.55 13.7893 20.1108 13.5366V13.5366C19.6715 13.2839 19.3511 12.8665 19.2206 12.3769C19.09 11.8872 19.16 11.3658 19.4151 10.9279C19.581 10.6383 19.8211 10.3981 20.1108 10.2322V10.2322C21.0159 9.70283 21.3262 8.54343 20.8064 7.63271V7.63271V7.62355Z" stroke="#888888" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
								<circle cx="12.1747" cy="11.889" r="2.63616" stroke="#888888" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
						</div>	
						<span class="nav-text">System Settings</span>
						</a>
						<ul aria-expanded="false" class="@if(Route::is('system-modules.*') || Route::is('settings.*') ){{'mm-collapse mm-show left'}} @endif">
							<li><a href="#">Login Page</a></li>
							<li class="@if(Route::is('settings.*')){{'mm-active'}} @endif"><a href="{{route('general-settings')}}" class="@if(Route::is('general-settings.*')){{'mm-active'}} @endif">General Settings</a></li>
							<li><a href="#">User Permission</a></li>
							<li class="@if(Route::is('system-modules.*')){{'mm-active'}} @endif"><a href="{{route('system-modules')}}" class="@if(Route::is('system-modules.*')){{'mm-active'}} @endif">System Modules</a></li>
							
						</ul>
					</li>-->
					
					@endif

				</ul>
				<div class="help-desk">
					<a href="javascript:void(0)" class="btn btn-primary">Help Desk</a>
				</div>		
			</div>
        </div>		
        <!--**********************************
            Sidebar end
        ***********************************-->