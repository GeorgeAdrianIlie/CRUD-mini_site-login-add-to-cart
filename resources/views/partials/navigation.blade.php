<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
       {{-- {{dd(Request::path())}}  --}}
       {{-- @if(Request::path() == 'category' ) active @endif --}}
        <li class="nav-item ">
          <a class="nav-link {{Request::path() == 'category' ? 'active' : "" }}" href="{{route('category.index')}}">Category list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::path() == 'product' ? 'active' : "" }}" href="{{route('product.index')}}">Product List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::path() == 'orders' ? 'active' : "" }}" href="{{route('orders.index')}}">Orders</a>
        </li>

        @if(!Auth::user())
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">Login</a>
        </li>
        @endif

        @if(Auth::user())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout')}}" tabindex="-1" aria-disabled="true"
            onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
            <form id="form-logout" method="POST" action="{{ route('logout')}}" style="display:none;">@csrf</form>
        </li>
        {{-- @endif --}}
      </ul>
      <form class="form-inline my-2 my-lg-0">
        {{-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> --}}
        <a class="btn btn-outline-success my-2 my-sm-0" href="/cart">Cart</a>
      </form>
      @endif
    </div>
  </nav>