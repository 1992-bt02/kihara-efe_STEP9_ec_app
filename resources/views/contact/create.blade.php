<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お問い合わせ
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- 成功フラッシュ --}}
            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="name">お名前</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            class="w-full rounded border-gray-300"
                            required
                        >
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="email">メールアドレス</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            class="w-full rounded border-gray-300"
                            required
                        >
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1" for="message">内容</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            class="w-full rounded border-gray-300"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('products.index') }}"
                           class="px-4 py-2 rounded border text-sm text-gray-700 hover:bg-gray-50">
                            戻る
                        </a>
                        <button type="submit"
                                class="px-4 py-2 rounded border bg-indigo-100  text-indigo-800ttext-sm hover:bg-indigo-200 transition">
                            送信
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>