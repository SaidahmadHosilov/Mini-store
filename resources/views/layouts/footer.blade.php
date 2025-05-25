<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center mb-6">
            <!-- Logo or Brand Name -->
            <div class="text-2xl font-bold">
                <a href="/" class="text-white hover:text-gray-400">E commerce</a>
            </div>

            <!-- Social Media Links -->
            <div class="space-x-4">
                <a href="#" class="text-white hover:text-gray-400">Facebook</a>
                <a href="#" class="text-white hover:text-gray-400">Twitter</a>
                <a href="#" class="text-white hover:text-gray-400">Instagram</a>
                <a href="#" class="text-white hover:text-gray-400">LinkedIn</a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Footer Navigation Links -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Quick Links</h5>
                <ul>
                    <li><a href="#" class="text-white hover:text-gray-400">Home</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400">Shop</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400">About</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400">Contact</a></li>
                </ul>
            </div>

            <!-- Legal Links -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Legal</h5>
                <ul>
                    <li><a href="#" class="text-white hover:text-gray-400">Privacy Policy</a></li>
                    <li><a href="#" class="text-white hover:text-gray-400">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Contact</h5>
                <ul>
                    <li><span class="text-white">Email:</span> <a href="mailto:info@yourbrand.com" class="text-white hover:text-gray-400">info@yourbrand.com</a></li>
                    <li><span class="text-white">Phone:</span> <a href="tel:+1234567890" class="text-white hover:text-gray-400">+123 456 7890</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h5 class="font-semibold text-lg mb-4">Newsletter</h5>
                <p class="text-white">Subscribe to our newsletter for the latest updates and offers.</p>
                <form action="#" method="POST" class="mt-4">
                    <input type="email" placeholder="Enter your email" class="px-4 py-2 rounded-md text-gray-800 focus:outline-none">
                    <button type="submit" class="bg-yellow-400 text-black px-4 py-2 rounded-md hover:bg-yellow-500 transition duration-200">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-6">
            <div class="text-center text-gray-400">
                &copy; {{ date('Y') }} YourBrand. All rights reserved.
            </div>
        </div>
    </div>
</footer>
