<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Wishlist - Ndoto App</title>
    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- Alpine -->
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Custom style -->
    <link rel="stylesheet" href="css/skilline.css" />
    <!-- Poppins font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <div x-data="{ open: false }" class="w-full text-gray-700 bg-cream">
        <div class="flex flex-col max-w-screen-xl px-8 mx-auto md:items-center md:justify-between md:flex-row">
            <div class="flex flex-row items-center justify-between py-6">
                <div class="relative md:mt-8">
                    <a href="#" class="text-lg relative z-50 font-bold tracking-widest text-gray-900 rounded-lg focus:outline-none focus:shadow-outline">Ndoto App</a>
                    <svg class="h-11 z-40 absolute -top-2 -left-3" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.2574 2.24264C37.6005 -0.100501 41.3995 -0.100505 43.7426 2.24264L76.7574 35.2574C79.1005 37.6005 79.1005 41.3995 76.7574 43.7426L43.7426 76.7574C41.3995 79.1005 37.6005 79.1005 35.2574 76.7574L2.24264 43.7426C-0.100501 41.3995 -0.100505 37.6005 2.24264 35.2574L35.2574 2.24264Z" fill="#65DAFF"/>
                    </svg>
                </div>
                <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'transform md:transform-none': !open, 'h-full': open }" class="h-0 md:h-auto flex flex-col flex-grow md:items-center pb-4 md:pb-0 md:flex md:justify-end md:flex-row origin-top duration-300 scale-y-0">
                <a class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline" href="#">Home</a>
                <a class="px-10 py-3 mt-2 text-sm text-center bg-white text-gray-800 rounded-full md:mt-8 md:ml-4" href="/login">Login</a>
                <a class="px-10 py-3 mt-2 text-sm text-center bg-yellow-500 text-white rounded-full md:mt-8 md:ml-4" href="/register">Sign Up</a>
            </nav>
        </div>
    </div>





<div class="container py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Item Details Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="relative pb-48">
                @if($item->image)
                    <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('image/' . $item->image) }}" alt="{{ $item->name }}">
                @else
                    <div class="absolute inset-0 h-full w-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $item->name }}</h1>
                <p class="mt-2 text-gray-600">{{ $item->note }}</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-2xl font-bold text-yellow-500">Tsh{{ number_format($item->price, 2) }}</span>
                    @if($item->is_unlimited == '1')
                        <span class="text-sm text-blue-600">Unlimited Stock</span>
                    @else
                        <span class="text-sm text-gray-600">{{ $item->quantity }} left</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Purchase Form -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Purchase Details</h2>
            <form action="{{ route('purchase.store', $item->id) }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Your Name</label>
                    <input type="text" name="username" id="username" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    <p class="mt-1 text-sm text-gray-500">This will be shown to the recipient</p>
                </div>

                <!-- Anonymity Toggle -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                           class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300 rounded">
                    <label for="is_anonymous" class="ml-2 block text-sm text-gray-700">
                        Make this purchase anonymous
                    </label>
                </div>

                <!-- Quantity Field -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" 
                           @if($item->is_unlimited != '1') max="{{ $item->quantity }}" @endif
                           value="1" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    @if($item->is_unlimited != '1')
                        <p class="mt-1 text-sm text-gray-500">Maximum available: {{ $item->quantity }}</p>
                    @endif
                </div>

                <!-- Message Field -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message (Optional)</label>
                    <textarea name="message" id="message" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                              placeholder="Add a personal message to your gift..."></textarea>
                </div>

                <!-- Total Price Display -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Price per item:</span>
                        <span class="font-semibold">Tsh{{ number_format($item->price, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-gray-600">Quantity:</span>
                        <span class="font-semibold" id="quantity-display">1</span>
                    </div>
                    <div class="border-t border-gray-200 mt-2 pt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total:</span>
                            <span class="text-lg font-bold text-yellow-500" id="total-price">
                                Tsh{{ number_format($item->price, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 bg-yellow-500 text-white text-sm font-semibold rounded-full hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transform transition hover:scale-105 duration-200">
                        Confirm Purchase
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const quantityDisplay = document.getElementById('quantity-display');
    const totalPriceDisplay = document.getElementById('total-price');
    const itemPrice = {{ $item->price }};

    function updateTotal() {
        const quantity = parseInt(quantityInput.value);
        quantityDisplay.textContent = quantity;
        const total = quantity * itemPrice;
        totalPriceDisplay.textContent = `Tsh${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    }

    quantityInput.addEventListener('input', updateTotal);
    updateTotal();
});
</script>
</body>
</html>