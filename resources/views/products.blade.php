<x-app-layout>
    <div class="container mx-auto p-6">

        <!-- Discount Banner -->
        <div class="bg-blue-600 text-white py-4 px-6 rounded-lg shadow-lg flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-semibold">Cheklangan Muddatli Taklif!</h3>
                <p class="text-lg mt-2">Birinchi buyurtmangizda 20% chegirma oling. To‘lovda <strong>WELCOME20</strong> kodini kiriting.</p>
            </div>
            <a href="#" class="bg-yellow-400 text-black py-2 px-5 rounded-lg font-semibold hover:bg-yellow-500 transition duration-200">Hozir Xarid Qiling</a>
        </div>

        <!-- Latest Products Section -->
        <section class="my-12">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold">Tovarlar</h3>
                <button
                    class="bg-green-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-green-600 transition duration-200"
                    data-modal-toggle="create-product-modal">
                    Yaratish
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Fake Latest Products -->
                @foreach ($products as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] ?? 'Product Image' }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="text-xl font-bold">{{ $product->name }}</h4>
                            <p class="text-gray-600">{{ $product->description }}</p>
                            <span class="text-lg font-semibold text-green-500">{{ number_format($product->price, 2) }} so'm</span>

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
    </div>

    <!-- Create New Product Modal -->
    <div id="create-product-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Create New Product</h3>
                <button class="text-gray-500 hover:text-gray-700" data-modal-toggle="create-product-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Product Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Product Price</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image URL</label>
                    <input type="url" name="image" id="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-green-600">Save Product</button>
            </form>
        </div>
    </div>

    <script>
        // Modal Toggle Logic
        const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
        const modal = document.getElementById('create-product-modal');

        modalToggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.toggle('hidden');
            });
        });
    </script>
</x-app-layout>
