<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header" style="color:#fff;"> MAIN MENU <i class="fa fa-level-down"></i></li>  
			<li class="
						{{ Request::segment(1) === null ? 'active' : null }}
						{{ Request::segment(1) === 'home' ? 'active' : null }}
					  ">
				<a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a>
			</li>
			
			@if(Request::segment(1) === 'profile')

			<li class="{{ Request::segment(1) === 'profile' ? 'active' : null }}">
				<a href="{{ route('profile') }}" title="Profile"><i class="fa fa-user"></i> <span> PROFILE</span></a>
			</li>

			@endif

			<li class="treeview 
				{{ Request::segment(1) === 'vlf' ? 'active menu-open' : null }}
				">
				<a href="#">
					<i class="fa fa-gear"></i>
					<span>VLF</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					{{-- @if (Auth::user()->can('root-dev', '')) --}}
					{{-- @if (Auth::user()->designation !== 'visitor')) --}}
						<li class="{{ Request::segment(1) === 'vlf' && Request::segment(2) === null ? 'active' : null }}">
							<a href="{{ route('vlfdata') }}" title="Manage VLF Data">
								<i class="fa fa-gear"></i> <span> VLF Database</span>
							</a>
						</li>
						<li class="{{ Request::segment(1) === 'vlf' ? 'active' : null }}">
							<a href="{{ route('vlfdata') }}" title="VLF">
								<i class="fa fa-user"></i> <span> Import CSV</span>
							</a>
						</li>
					{{-- @endif --}}
				</ul>
			</li> 

			@if (Auth::user()->designation !== 'visitor')
			<li class="treeview 
				{{ Request::segment(1) === 'changerequest' ? 'active menu-open' : null }}
				">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>CHANGE REQUESTS</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ Request::segment(1) === 'changerequest' ? 'active' : null }}">
						<a href="{{ route('change-request') }}" title="App Config">
							<i class="fa fa-gear"></i> <span> View Change Requests</span>
						</a>
					</li>
				</ul>

			</li> 
			@endif

			<li class="treeview 
				{{ Request::segment(1) === 'config' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'user' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'role' ? 'active menu-open' : null }}
				">
				<a href="#">
					<i class="fa fa-gear"></i>
					<span>SETTINGS</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@if (Auth::user()->designation == 'dev'))
						<li class="{{ Request::segment(1) === 'config' && Request::segment(2) === null ? 'active' : null }}">
							<a href="{{ route('config') }}" title="App Config">
								<i class="fa fa-gear"></i> <span> Settings App</span>
							</a>
						</li>
					@endif					
					<li class="
						{{ Request::segment(1) === 'user' ? 'active' : null }}
						{{ Request::segment(1) === 'role' ? 'active' : null }}
						">
						<a href="{{ route('user') }}" title="Users">
							<i class="fa fa-user"></i> <span> Users</span>
						</a>
					</li>
				</ul>
			</li>      
		</ul>
	</section>
</aside>