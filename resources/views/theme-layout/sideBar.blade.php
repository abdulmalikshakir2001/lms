<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mb-5">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo demo">
          <img src="{{asset('assets\img\zetasoft.png')}}" width="80%" alt="">
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      @if (auth()->user()->hasRole('Super Admin'))
        <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-smile"></i>
              <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
          </a>
        </li>
      @elseif(auth()->user()->hasRole('Regional Facilitator'))
        <li class="menu-item {{ Route::is('regFacilitator.dashboard') ? 'active' : '' }}">
          <a href="{{ route('regFacilitator.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-smile"></i>
              <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
          </a>
        </li>
      @elseif(auth()->user()->hasRole('Local Facilitator'))
        <li class="menu-item {{ Route::is('locFacilitator.dashboard') ? 'active' : '' }}">
          <a href="{{ route('locFacilitator.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-smile"></i>
              <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
          </a>
        </li>
      @endif 
      @can('View Sessions')
      @if(!auth()->user()->hasRole('Super Admin'))
        <li class="menu-item {{ Route::is('sessions.index') ? 'active' : '' }}">
          <a href="{{ route('sessions.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-layout"></i>
              <div class="text-truncate" data-i18n="Dashboards">Sessions</div>
          </a>
        </li>
        @endif 
      @endcan
      @can('View Schools')
        @if(!auth()->user()->hasRole('Super Admin'))
            <li class="menu-item {{ Route::is('schools.index') ? 'active' : '' }}">
                <a href="{{ route('schools.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-school bx-md"></i>
                    <div class="text-truncate" data-i18n="Dashboards">Schools</div>
                </a>
            </li>
        @endif
      @endcan

      @can('View Parents')
      @if(!auth()->user()->hasRole('Super Admin'))
      <li class="menu-item {{ Route::is('parents.index') ? 'active' : '' }}">
        <a href="{{ route('parents.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-male-female"></i>
            <div class="text-truncate" data-i18n="Dashboards">Parents</div>
        </a>
      </li> 
      @endif
      @endcan
      @can('View Students')
      @if(!auth()->user()->hasRole('Super Admin'))
      <li class="menu-item {{ Route::is('students.index') ? 'active' : '' }}">
        <a href="{{ route('students.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-child"></i>
            <div class="text-truncate" data-i18n="Dashboards">Students</div>
        </a>
      </li> 
      @endif
      @endcan
      @can('View Teachers')
      @if(!auth()->user()->hasRole('Super Admin'))
      <li class="menu-item {{ Route::is('teachers.index') ? 'active' : '' }}">
        <a href="{{ route('teachers.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
            <div class="text-truncate" data-i18n="Dashboards">Teachers</div>
        </a>
      </li> 
      @endif
      @endcan
      @can('View Facilitators')
      @if(!auth()->user()->hasRole('Super Admin'))
      <li class="menu-item {{ Route::is('facilitators.index') ? 'active' : '' }}">
        <a href="{{ route('facilitators.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
            <div class="text-truncate" data-i18n="Dashboards">Facilitators</div>
        </a>
      </li> 
      @endif 
      @endcan
      @can('View Users')     
      <li class="menu-item {{ Route::is('users.index')  || Route::is('roles.index') || Route::is('permissions.index') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-user me-1_5"></i>
          <div class="text-truncate" data-i18n="Dashboards">User Management</div>
        </a>
        <ul class="menu-sub">
          @can('View Users')
          <li class="menu-item {{ Route::is('users.index') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
              <div class="text-truncate" data-i18n="Analytics">Users</div>
            </a>
          </li>
          @endcan
          {{-- @can('View Roles')
          <li class="menu-item {{ Route::is('roles.index') ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}" class="menu-link">
              <div class="text-truncate" data-i18n="Analytics">Roles</div>
            </a>
          </li>
          @endcan
          
          <li class="menu-item {{ Route::is('permissions.index') ? 'active' : '' }}">
            <a href="{{ route('permissions.index') }}" class="menu-link">
              <div class="text-truncate" data-i18n="Analytics">Permissions</div>
            </a>
          </li> --}}
         
          
          
        </ul>
      </li>
      @endcan
    </ul>
  </aside>