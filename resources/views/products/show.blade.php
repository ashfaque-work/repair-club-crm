<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Show Product') }}
		</h2>
	</x-slot>

	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h3>
                <p class="text-lg text-gray-600 mb-4">${{ $product->price }}</p>
                <p class="text-gray-700">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
