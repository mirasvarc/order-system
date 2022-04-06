<div class="top-buttons">
    <a href="/admin"><i class="fa fa-user"></i></a>
    <a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="fa fa-arrow-right-from-bracket"></i>
    </a>
</div>


<form id="logout-form" method="POST" action="{{ route('logout') }}">
    @csrf
</form>
