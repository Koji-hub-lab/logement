<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="relative">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
        <div class="absolute top-2 right-2 bg-blue-800 text-white text-xs font-bold px-2 py-1 rounded">
            {{ number_format($price, 0, ',', ' ') }} FCFA/mois
        </div>
    </div>
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $title }}</h3>
        <p class="text-gray-600 text-sm mb-2">{{ $location }}</p>
        <div class="flex items-center text-sm text-gray-500">
            <span class="flex items-center mr-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ $rooms }} pièces
            </span>
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                </svg>
                {{ $size }} m²
            </span>
        </div>
    </div>
</div>
