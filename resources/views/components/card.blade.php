<div class="card {{ $cardClass ?? '' }}" {{ isset($id) ? 'id='.$id : '' }}>
  @if(isset($header))
    <div class="card-header bg-secondary text-white font-weight-bold">
      {{ $breadcrumbs ?? '' }}
      <h4 class="m-0 p-0">
        {{ $header }}
      </h4>
    </div>
  @endif
  <div class="card-body {{ $cardBodyClass ?? '' }}">
    {{ $slot }}
  </div>
</div>
