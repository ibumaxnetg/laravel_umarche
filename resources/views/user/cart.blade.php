<x-app-layout>
  <x-slot name="header">user
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          カート
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">

                @if(count($products) > 0)
                    @foreach($products as $product)
                      <div class="md:flex md:items-center mb-2">
                        <div class="md:w-3/12">
                          @if($product->imageFourth->filename !== null)
                            <img src="{{ asset('storage/products/' . $product->imageFourth->filename )}}">
                          @else
                            <img src="">
                          @endif
                        </div>
                        <div class="md:w-4/12 md:ml-2">{{ $product->name }}</div>
                        <div class="md:w-3/12 fles justify-around">
                          <div>{{ $product->pivot->quantity }}</div>
                          <div>{{ number_format($product->pivot->quantity * $product->price )}}円(税込)</div>
                        </div>
                        <div class="md:w-2/12">
                          <form method="post" action="{{route('user.cart.delete', ['item' => $product->id ])}}">
                            @csrf
                            <button>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                            </button>
                          </form>
                        </div>
                      </div>
                    @endforeach
                    <div class="md:flex md:items-center mb-2">合計金額: {{ $totalPrice }}</div>
                @else
                  <div class="md:flex md:items-center mb-2">カートに商品が入っていません。</div>
                @endif
              </div>
                <div>
                  <p><a href="/component-test1">てすと１</a></p>
                  <p><a href="/component-test2">てすと2</a></p>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>