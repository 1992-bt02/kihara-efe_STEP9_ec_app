<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カート
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            {{-- フラッシュメッセージ --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if (empty($lines))
                <div class="bg-white shadow rounded p-6 text-center text-gray-500">
                    カートに商品はありません。
                </div>
            @else
                <div class="bg-white shadow rounded overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">商品</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">価格</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">数量</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">小計</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($lines as $line)
                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $img = $line['image'];
                                            $exists = $img && file_exists(public_path($img));
                                        @endphp
                                        <img src="{{ $exists ? asset($img) : asset('images/placeholder.jpg') }}"
                                             alt="{{ $line['name'] }}"
                                             class="w-16 h-16 object-cover rounded" />
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $line['name'] }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-right whitespace-nowrap">
                                    ¥{{ number_format($line['price']) }}
                                </td>

                                {{-- 数量更新フォーム --}}
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.update', $line['id']) }}" method="post" class="flex items-center justify-center gap-2">
                                        @csrf
                                        @method('patch')
                                        <input type="number" name="qty" value="{{ $line['qty'] }}" min="0" class="w-20 rounded border-gray-300 text-center" />
                                        <button type="submit" class="inline-flex items-center px-3 py-2 rounded bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">更新</button>
                                    </form>
                                </td>

                                <td class="px-4 py-4 text-right font-semibold whitespace-nowrap">
                                    ¥{{ number_format($line['lineTotal']) }}
                                </td>

                                {{-- 削除ボタン --}}
                                <td class="px-4 py-4 text-right">
                                    <form method="POST" action="{{ route('cart.remove', $line['id']) }}" class="inline-flex" onsubmit="return confirm('カートから削除しますか？')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="inline-flex items-center px-3 py-2 rounded border text-sm text-gray-700 hover:bg-gray-50 transition">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        {{-- 合計表示 --}}
                        <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-right font-semibold">合計</td>
                            <td class="px-4 py-4 text-right font-bold">¥{{ number_format($total) }}</td>
                            <td class="px-4 py-4"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded border text-sm text-gray-700 hover:bg-gray-50 transition">
                        商品一覧に戻る
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>