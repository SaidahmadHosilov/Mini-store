<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="container mx-auto p-6">
        <div class="bg-blue-600 text-white py-4 px-6 rounded-lg shadow-lg flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-semibold">Cheklangan Muddatli Taklif!</h3>
                <p class="text-lg mt-2">Birinchi buyurtmangizda 20% chegirma oling. To‘lovda <strong>WELCOME20</strong> kodini kiriting.</p>
            </div>
            <a href="#" class="bg-yellow-400 text-black py-2 px-5 rounded-lg font-semibold hover:bg-yellow-500 transition duration-200">Hozir Xarid Qiling</a>
        </div>

        <section class="my-12">
            <h3 class="text-2xl font-semibold mb-6">Top tovarlar</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($latestProducts as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] ?? 'Product Image' }}" class="w-full h-48 object-cover">

                        <div class="p-4">
                            <h4 class="text-xl font-bold">{{ $product['name'] ?? 'Product Name' }}</h4>
                            <p class="text-gray-600">{{ $product['description'] ?? 'Product description here.' }}</p>
                            <span class="text-lg font-semibold text-green-500">{{ $product['price'] ?? '0.00' }} so'm</span>
                            {{-- <a href="#" class="mt-4 inline-block text-blue-500 hover:text-blue-700">View Details</a> --}}

                            <!-- Add to Cart button -->
                            <form action="{{ route('basket.add', $product['id']) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <!-- Some Products Section -->
        <section class="my-12">
            <h3 class="text-2xl font-semibold mb-6">Tovarlar</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] ?? 'Product Image' }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="text-xl font-bold">{{ $product['name'] ?? 'Product Name' }}</h4>
                            <p class="text-gray-600">{{ $product['description'] ?? 'Product description here.' }}</p>
                            <span class="text-lg font-semibold text-green-500">{{ number_format($product['price'] ?? 0, 2) }} so'm</span>
                            {{-- <a href="#" class="mt-4 inline-block text-blue-500 hover:text-blue-700">View Details</a> --}}

                            <!-- Add to Cart button -->
                            <form action="{{ route('basket.add', $product['id']) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

          <!-- Pagination links -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

</x-app-layout>
