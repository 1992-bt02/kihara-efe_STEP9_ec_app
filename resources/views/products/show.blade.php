<x-app-layout>
  <div class="max-w-4xl mx-auto p-6">
    {{-- フラッシュメッセージ --}}
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
        {{ session('error') }}
      </div>
    @endif

    {{-- パンくず / 戻るリンク --}}
    <div class="mb-4">
      <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">&larr; 商品一覧へ戻る</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      {{-- 画像 --}}
      <div>
        @php
          $img = optional($product->mainImage)->path;
          $exists = $img && file_exists(public_path($img));
        @endphp
        <img
          src="{{ $exists ? asset($img) : asset('images/placeholder.jpg') }}"
          alt="{{ $product->name }}"
          class="w-full aspect-square object-cover rounded shadow"
        >
      </div>

      {{-- 情報＋カートフォーム --}}
      <div>
        <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>

        <div class="text-gray-600 mb-4">{{ $product->description }}</div>

        <div class="text-xl font-semibold mb-6">{{ number_format($product->price) }}円</div>

        {{-- 在庫表示（在庫カラムがある場合） --}}
        @isset($product->stock)
          <div class="mb-4 text-sm {{ $product->stock > 0 ? 'text-gray-600' : 'text-red-600' }}">
            在庫：{{ $product->stock > 0 ? $product->stock.' 点' : '在庫切れ' }}
          </div>
        @endisset

        @if(!isset($product->stock) || $product->stock > 0)
          <form method="POST" action="{{ route('cart.add', $product) }}" class="space-y-4">
            @csrf

            <div class="flex items-center gap-3">
              <label for="qty" class="text-sm text-gray-600">数量</label>

              {{-- 数量フィールド（1〜99） --}}
              <input id="qty" name="qty" type="number" value="1" min="1" max="99"
                     class="w-24 border rounded px-3 py-2">

              {{-- 手早い選択ボタン群（任意） --}}
              <div class="flex gap-2">
                @foreach([1,2,5] as $q)
                  <button type="button"
                          onclick="document.getElementById('qty').value={{ $q }}"
                          class="px-2 py-1 text-sm border rounded hover:bg-gray-50">
                    ×{{ $q }}
                  </button>
                @endforeach
              </div>
            </div>

            <div class="flex items-center gap-3">
              <button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                カートに入れる
              </button>
              <a href="{{ route('cart.index') }}" class="text-blue-600 underline">
                カートを見る
              </a>
            </div>
          </form>
        @else
          <button class="px-5 py-2 bg-gray-400 text-white rounded cursor-not-allowed" disabled>
            在庫切れ
          </button>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>