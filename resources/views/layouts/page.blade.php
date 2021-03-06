@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="sidebar">
      @foreach($sidebarCards as $card)
        @if(collect($card['items'])->some(function($item) {
          return isset($item['show']) ? $item['show'] : true;
        }))
          <sidebar-card>
            <header slot="header">
              {{ $card['name'] }}
            </header>
            <div slot="body">
              @foreach($card['items'] as $link)
                @if(isset($link['show']) ? $link['show'] : true)
                  @component('components.card')
                    @slot('cardClass')
                      {{ $loop->last ? 'mb-3' : 'mb-2' }}
                    @endslot

                    @slot('cardBodyClass')
                      {{ URL::current() === $link['link'] ? 'bg-light' : '' }}
                    @endslot

                    <a class="text-black-50 text-center" href="{{ $link['link'] }}">
                      <h5 class="p-0 m-0 text-capitalize">
                        {{ $link['name'] }}
                      </h5>
                    </a>
                  @endcomponent
                @endif
              @endforeach
            </div>
          </sidebar-card>
        @endif
      @endforeach
    </div>
    <div class="main-content">
      @if(session()->has('message'))
        <div class="alert {{ session('messageType', false) ? 'alert-' . session('messageType') : 'alert-success' }}">
          {{ session('message') }}
        </div>
      @endif

      @yield('page_content')
    </div>
  </div>
@endsection
