<div class="flex gap-4 mb-6">
    <div class="w-16 h-16 bg-gray-100 rounded-xl flex-shrink-0"></div>
    <div class="flex-1">
        <h4 class="font-semibold text-lg mb-1 poppins-bold">Seguirnos en redes</h4>
        <p class="text-gray-600 text-sm mb-2 montserrat-medium">+500 IG y +500 TikTok (una sola vez)</p>

        <div class="flex gap-2">
            @if($isInstagramClaimed ?? false)
                <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                    ✓ IG +500
                </button>
            @else
                <button type="button"
                   onclick="window.open('https://www.instagram.com/{{ $instagram ?? 'goodtrap' }}', '_blank'); setTimeout(() => @this.call('claimInstagramPoints'), 500);"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                    IG +500
                </button>
            @endif

            @if($isTiktokClaimed ?? false)
                <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                    ✓ TikTok +500
                </button>
            @else
                <button type="button"
                   onclick="window.open('https://www.tiktok.com/{{ $tiktok ?? 'goodtrap' }}', '_blank'); setTimeout(() => @this.call('claimTiktokPoints'), 500);"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                    TikTok +500
                </button>
            @endif
        </div>
    </div>
</div>
