<button {{ $attributes->merge(['class' => 'relative group overflow-hidden px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:from-pink-600 hover:to-purple-600 transition-all duration-500']) }}>
    <span class="absolute inset-0 w-full h-full transform scale-105 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 blur-lg opacity-0 group-hover:opacity-100 transition duration-700"></span>
    <span class="relative z-10">
        {{ $slot }}
    </span>
</button>
