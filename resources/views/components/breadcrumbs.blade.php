<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-secondary">
    @foreach($items as $title => $url)
      @php($active = $url == url()->current())
      <li class="breadcrumb-item text-capitalize {{ $active ? 'active' : '' }}">
        @if($active)
          <span>{{ $title }}</span>
        @else
          <a href="{{ $url }}">{{ $title }}</a>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
