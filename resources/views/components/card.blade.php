<div class="card {{ $cardClass ?? '' }}">
  @if(isset($header))
    <div class="card-header bg-secondary text-white font-weight-bold">
      <h4 class="m-0 p-0">
        {{ $header }}
      </h4>
    </div>
  @endif
  <div class="card-body {{ $cardBodyClass ?? '' }}">
    {{ $slot }}
  </div>
</div>
