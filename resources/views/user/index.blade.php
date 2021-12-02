<x-app-layout>
  <x-slot name="header">user
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">

                <div class="flex flex-wrap">
                      @foreach($products as $product)
                          <div class="w-1/4 p-2 md:p-4">
                              {{-- <a href="{{ route('owner.products.edit', ['product' => $product->id]) }}"> --}}
                                  <div class="border rounded-md p-2 md:p4">
                                      <div class="mb-4">
                                          <div>
                                              <x-thumbnail filename="{{ $product->imageFirst->filename ?? '' }}" type="products" />
                                          </div>
                                          <div class="text-gray-700">{{ $product->name }}</div>
                                      </div>
                                  </div>
                              {{-- </a> --}}
                          </div>
                    @endforeach
                </div>

                <p><a href="/component-test1">てすと１</a></p>
                  <p><a href="/component-test2">てすと2</a></p>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
