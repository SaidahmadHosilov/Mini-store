<x-app-layout >
    <div class="container mx-auto p-6 max-w-5xl bg-white rounded-lg shadow-md my-5">
        <h1 class="text-3xl font-bold mb-8 text-center">Sizning savatchingiz</h1>

        @if($basketItems->isEmpty())
            <p class="text-center text-gray-500 text-lg">Savatchingiz bo'sh.</p>
        @else
            <form action="{{ route('basket.update') }}" method="POST" class="mb-6">
                @csrf
                @method('PUT')

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 border border-gray-300 text-left">Mahsulot</th>
                            <th class="py-3 px-6 border border-gray-300 text-center">Miqlor</th>
                            <th class="py-3 px-6 border border-gray-300 text-right">Narx (so'm)</th>
                            <th class="py-3 px-6 border border-gray-300 text-right">Jami (so'm)</th>
                            <th class="py-3 px-6 border border-gray-300 text-center">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($basketItems as $item)
                            <tr class="border-t border-gray-300">
                                <td class="py-4 px-6 border border-gray-300">{{ $item->product->name }}</td>

                                <td class="py-4 px-6 border border-gray-300 text-center">
                                    <input
                                        type="number"
                                        name="quantities[{{ $item->id }}]"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        class="w-20 border border-gray-300 rounded px-2 py-1 text-center"
                                    >
                                </td>

                                <td class="py-4 px-6 border border-gray-300 text-right">{{ number_format($item->product->price, 0, '', ' ') }}</td>

                                <td class="py-4 px-6 border border-gray-300 text-right">
                                    {{ number_format($item->product->price * $item->quantity, 0, '', ' ') }}
                                </td>

                                <td class="py-4 px-6 border border-gray-300 text-center">
                                    <form action="{{ route('basket.remove', $item->id) }}" method="POST" onsubmit="return confirm('Mahsulotni savatchadan olib tashlamoqchimisiz?');">
                                        @csrf
                                        <button type="submit" class="flex items-center justify-center text-red-600 hover:text-red-800 font-semibold">
                                            <!-- Trash icon SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                            </svg>
                                            O'chirish
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                        Miqdorlarni yangilash
                    </button>
                </div>
            </form>

            {{-- Yakuniy summa --}}
            <div class="text-right text-xl font-semibold my-6">
                Umumiy summa:
                <span class="text-green-600">
                    {{ number_format($basketItems->sum(fn($item) => $item->product->price * $item->quantity), 0, '', ' ') }} so'm
                </span>
            </div>

           {{-- To'lov summasi avtomatik hisoblanadi va yashirin input orqali yuboriladi --}}
            @php
            $basketTotal = $basketItems->sum(fn($item) => $item->product->price * $item->quantity);
            @endphp

            <form action="{{ route('basket.checkout') }}" method="POST" class="max-w-md mx-auto">
                @csrf

                {{-- To'lov summasi (readonly) --}}
                <label for="payment_amount" class="block mb-2 font-medium text-gray-700">
                    To'lov summasi (so'm):
                </label>
                <input
                    type="number"
                    id="payment_amount"
                    name="payment_amount"
                    value="{{ $basketItems->sum(fn($item) => $item->product->price * $item->quantity) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-4 bg-gray-100 cursor-not-allowed"
                    readonly
                >

                {{-- To'lov usuli --}}
                <label for="payment_method" class="block mb-2 font-medium text-gray-700">
                    To'lov usulini tanlang:
                </label>
                <select
                    id="payment_method"
                    name="payment_method"
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-6"
                    required
                >
                    <option value="">-- Tanlang --</option>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="transfer">Transfer</option>
                </select>

                {{-- Yuborish tugmasi --}}
                <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded text-lg hover:bg-green-700 transition">
                    Zakazni oformit qilish
                </button>
            </form>



        @endif
    </div>
</x-app-layout>
