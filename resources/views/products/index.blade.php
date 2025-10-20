<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="border rounded p-3 shadow-sm max-w-md">
                        @php
                            $img = optional($product->mainImage)->path;
                            $exists = $img && file_exists(public_path($img));
                            $path = $exists ? asset($img) : asset('images/placeholder.jpg');
                        @endphp

                        {{-- 🔗 商品画像をクリックで詳細へ --}}
                        <a href="{{ route('products.show', $product) }}">
                            <img src="{{ $path }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover rounded mb-4 hover:opacity-90 transition">
                        </a>

                        {{-- 🔗 商品名もクリック可能 --}}
                        <h5 class="font-semibold text-lg mb-1">
                            <a href="{{ route('products.show', $product) }}"
                               class="text-gray-800 hover:text-blue-600 transition">
                                {{ $product->name }}
                            </a>
                        </h5>

                        <p class="text-sm text-gray-600 mb-2">{{ $product->description }}</p>
                        <p class="font-bold">{{ number_format($product->price) }} 円</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>