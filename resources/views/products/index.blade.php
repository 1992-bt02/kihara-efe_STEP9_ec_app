<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="border rounded-lg p-4 shadow-sm">
                            <h5 class="font-semibold mb-1">{{ $product->name }}</h5>
                            <p class="text-sm text-gray-600 mb-2">{{ $product->description }}</p>
                            <strong class="text-gray-900">{{ number_format($product->price) }} 円</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>