<div>
    <td class="p-4">
        <div class="flex items-center gap-3">
            <div>
                <h4 class="font-semibold poppins-bold">{{ __('Seguirnos en redes') }}</h4>
                <p class="text-sm text-gray-500 montserrat-regular">{{ __('Sigue nuestras cuentas de Instagram y TikTok para ganar puntos GT.') }}</p>
            </div>
        </div>
    </td>
    <td class="p-4 text-center">
        <span class="font-bold text-black poppins-bold">500 GT Points</span>
    </td>
    <td class="p-4 text-center">
        <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
            {{ __('Automático') }}
        </span>
    </td>
    <td class="p-4 text-center">
        @if($isInstagramClaimed ?? false)
            <button disabled class="bg-[#5170ff] text-white px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                Completado
            </button>
        @else
            <button type="button"
                onclick="window.open('https://www.instagram.com/{{ $instagram ?? 'goodtrap' }}', '_blank'); setTimeout(() => @this.call('claimInstagramPoints'), 500);"
                class="bg-[#5170ff] hover:bg-[#3b5bdc] text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                IG +500
            </button>
        @endif

        @if($isTiktokClaimed ?? false)
            <button disabled class="bg-[#5170ff] text-white px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                Completado
            </button>
        @else
            <button type="button"
                onclick="window.open('https://www.tiktok.com/{{ $tiktok ?? 'goodtrap' }}', '_blank'); setTimeout(() => @this.call('claimTiktokPoints'), 500);"
                class="bg-[#5170ff] hover:bg-[#3b5bdc] text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                TikTok +500
            </button>
        @endif
    </td>
</div>
