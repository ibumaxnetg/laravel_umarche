<x-app-layout>
  <x-slot name="header">owner
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <x-flash-message status="session('status')" />
                <div class="flex justify-end mb-4">
                  <button onClick="location.href='{{ route('owner.products.create')}}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
                </div>

                <div class="flex flex-wrap">
                @foreach($ownerInfo as $owner)
                  @foreach($owner->shop->product as $product)
                <div class="w-1/4 p-2 md:p-4">
                    <a href="{{ route('owner.products.edit', ['product' => $product->id]) }}">
                        <div class="border rounded-md p-2 md:p4">
                            <div class="mb-4">
                                <div>
                                    <x-thumbnail filename="{{ $product->imageFirst->filename ?? '' }}" type="products" />
                                </div>
                                <div class="text-gray-700">{{ $product->name }}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
              @endforeach
              </div>
                {{-- $images->links() --}}
                <p><a href="/component-test1">てすと１</a></p>
                <p><a href="/component-test2">てすと2</a></p>
              </div>
          </div>
      </div>
  </div>

</x-app-layout>
