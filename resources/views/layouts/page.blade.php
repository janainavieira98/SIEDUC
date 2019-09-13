@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-4 col-lg-3">
        <div class="sidebar">
          @foreach($sidebarCards as $card)
            <sidebar-card>
              <header slot="header">
                {{ $card['name'] }}
              </header>
              <div slot="body">
                @foreach($card['items'] as $link)
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
                @endforeach
              </div>
            </sidebar-card>
          @endforeach
        </div>
      </div>
      <div class="col-12 col-md-8 col-lg-9">
        @if(session()->has('message'))
          <div class="alert {{ session('messageType', false) ? 'alert-' . session('messageType') : 'alert-success' }}">
            {{ session('message') }}
          </div>
        @endif

        @yield('page_content')
      </div>
    </div>
  </div>
@endsection
