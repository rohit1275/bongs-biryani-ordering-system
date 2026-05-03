<!-- resources/views/components/product-card.blade.php -->
@props(['product'])

@php
    $fallbackImage = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80'; // general food fallback
    if ($product->category) {
        $cat = strtolower($product->category->name);
        if (str_contains($cat, 'biryani')) {
            $fallbackImage = 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?auto=format&fit=crop&w=800&q=80';
        } elseif (str_contains($cat, 'roll') || str_contains($cat, 'wrap')) {
            $fallbackImage = 'https://images.unsplash.com/photo-1626082895617-2c6ad3dfc904?auto=format&fit=crop&w=800&q=80';
        } elseif (str_contains($cat, 'starter') || str_contains($cat, 'kebab') || str_contains($cat, 'kabab')) {
            $fallbackImage = 'https://images.unsplash.com/photo-1599487405620-80d4638a16db?auto=format&fit=crop&w=800&q=80';
        } elseif (str_contains($cat, 'noodle') || str_contains($cat, 'chowmein')) {
            $fallbackImage = 'https://images.unsplash.com/photo-1612929633738-8fe44f7ec841?auto=format&fit=crop&w=800&q=80';
        }
    }
    $imageUrl = $product->image ? Storage::url($product->image) : $fallbackImage;
    $isBestSeller = $product->id % 3 == 0;
    $isTrending = $product->id % 4 == 0 && !$isBestSeller;
@endphp

<div x-data="{ added: false }" class="bg-theme-dark border border-gray-800/80 rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-theme-orange/10 transition-all duration-500 ease-out flex flex-col group relative transform hover:-translate-y-2">
    
    <!-- Image -->
    <div class="relative h-56 w-full overflow-hidden bg-gray-900 border-b border-gray-800">
        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
        
        <!-- Category & Labels -->
        <div class="absolute top-3 left-3 flex flex-col gap-2 relative z-10">
            @if($isBestSeller)
                <span class="bg-gradient-to-r from-theme-orange to-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg flex items-center gap-1 w-fit"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> Best Seller</span>
            @elseif($isTrending)
                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg flex items-center gap-1 w-fit"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> Trending</span>
            @endif

            @if($product->category)
                <span class="bg-theme-dark/80 backdrop-blur-md text-theme-gold text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-theme-gold/30 shadow-lg w-fit">{{ $product->category->name }}</span>
            @endif
        </div>
        
        <!-- Veg/Non-Veg mock -->
        <div class="absolute top-3 right-3 bg-white p-1 rounded shadow-lg flex items-center justify-center border border-gray-200">
            <div class="w-3 h-3 rounded-full {{ $product->id % 2 == 0 ? 'bg-green-600' : 'bg-red-600' }}" title="{{ $product->id % 2 == 0 ? 'Veg' : 'Non-Veg' }}"></div>
        </div>

        <!-- Overlay glow on hover -->
        <div class="absolute inset-0 bg-theme-orange/0 group-hover:bg-theme-orange/10 mix-blend-overlay transition-colors duration-500 pointer-events-none"></div>
    </div>
    
    <!-- Content -->
    <div class="p-5 flex-1 flex flex-col relative z-10 bg-theme-dark">
        <!-- Badges row -->
        <div class="flex items-center gap-3 mb-3 text-xs font-medium font-inter">
            <div class="flex items-center text-yellow-400 bg-yellow-400/10 px-2 py-0.5 rounded border border-yellow-400/20">
                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                4.{{ ($product->id % 5) + 4 }}
            </div>
            <div class="flex items-center text-gray-400 bg-gray-800 px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider">
                <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                25-30 MINS
            </div>
        </div>

        <div class="flex justify-between items-start mb-2 group-hover:text-theme-orange transition-colors duration-300">
            <h3 class="text-lg font-bold text-gray-100 font-poppins leading-tight flex-1 pr-2">{{ Str::limit($product->name, 22) }}</h3>
            <span class="text-lg font-extrabold text-theme-gold shrink-0 drop-shadow-md">₹{{ $product->price }}</span>
        </div>
        
        <p class="text-sm text-gray-400 mb-6 flex-1 font-inter">{{ Str::limit($product->description, 60) }}</p>
        
        <!-- Action Button -->
        <button 
            @click="
                addToCart({{ json_encode($product) }}); 
                added = true; 
                setTimeout(() => added = false, 2000)
            " 
            :class="added ? 'bg-green-500 text-white shadow-[0_0_20px_rgba(34,197,94,0.4)] border-green-500 scale-[0.98]' : 'bg-gray-800 text-white hover:bg-gradient-to-r hover:from-theme-orange hover:to-orange-500 hover:shadow-[0_0_25px_rgba(255,107,0,0.4)] border-gray-700 hover:border-transparent active:scale-[0.96]'"
            class="w-full py-3 font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-2 group/btn font-poppins relative overflow-hidden border focus:outline-none">
            
            <span x-show="!added" class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add to Cart
            </span>
            
            <span x-show="added" x-cloak class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Added!
            </span>
        </button>
    </div>
</div>
