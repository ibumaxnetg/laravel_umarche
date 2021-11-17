<x-app-layout>
  <x-slot name="header">admin
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
エロクアント
@foreach($e_all as $e_owner)
<p>{{ $e_owner->name }} </p>
<p>{{ $e_owner->created_at->diffForHumans() }} </p>
@endforeach
クエリビルダ
@foreach($q_get as $q_owner)
<p>{{ $q_owner->name }} </p>
<p>{{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }} </p>
@endforeach

                  <p><a href="/component-test1">てすと１</a></p>
                  <p><a href="/component-test2">てすと2</a></p>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
