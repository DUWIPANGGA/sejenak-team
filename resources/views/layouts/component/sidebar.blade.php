<a href="{{ route('user.meditation') }}" 
   class="nav-item {{ Request::routeIs('user.meditation') ? 'active' : '' }}">
    <p>Sejenak</p>
</a>

<a href="{{ route('user.dashboard') }}"
   class="nav-item {{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
    <p>Dashboard</p>
</a>

<a href="{{ route('user.konseling') }}" 
   class="nav-item {{ Request::routeIs('user.konseling') ? 'active' : '' }}">
    <p>Chat</p>
</a>

<a href="{{ route('user.history') }}" 
   class="nav-item {{ Request::routeIs('user.history') ? 'active' : '' }}">
    <p>Kalender</p>
</a>

<a href="{{ route('user.comunity') }}" 
   class="nav-item {{ Request::routeIs('user.comunity') ? 'active' : '' }}">
    <p>Post</p>
</a>

<a href="{{ route('user.journal') }}"
   class="nav-item {{ Request::routeIs('user.journal') ? 'active' : '' }}">
    <p>Journal</p>
</a>

<a href="/logout" class="nav-item">
    <p>Logout</p>
</a>
