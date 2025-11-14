<div class="bg-gradient-to-br from-[#5170ff] to-[#6b8aff] rounded-2xl p-4 sm:p-6 text-white shadow-lg w-full">
    {{-- Header con avatar y nombre --}}
    <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
        <div class="flex-shrink-0">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-white/20 flex items-center justify-center text-xl sm:text-2xl font-bold backdrop-blur-sm">
                {{ $user->initials() }}
            </div>
        </div>

        <div class="flex-1 min-w-0">
            <h3 class="text-lg sm:text-xl font-bold truncate open-sans-bold">{{ $user->student_name }}</h3>
            <p class="text-xs sm:text-sm text-white/80 truncate open-sans-regular">{{ $ageCategory }} · {{ $years }} - {{ $level }}</p>
        </div>
    </div>

    {{-- Puntos GT --}}
    <div class="mb-3 sm:mb-4">
        <p class="text-xs sm:text-sm font-medium text-white/80 mb-1">GT Points</p>
        <div class="flex items-end gap-2 flex-wrap">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold">{{ number_format($points, 0, ',', '.') }}</h2>
            <span class="inline-flex items-center px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-[10px] sm:text-xs font-semibold bg-[#4ade80] text-white mb-0.5 sm:mb-1">
                progreso
            </span>
        </div>
    </div>

    {{-- Barra de progreso --}}
    <div class="space-y-1.5 sm:space-y-2">
        <div class="flex justify-between text-[10px] sm:text-xs text-white/80">
            <span class="truncate">Hacia {{ number_format($nextMilestone, 0, ',', '.') }} pts</span>
            <span class="ml-2 flex-shrink-0">{{ number_format($progressPercentage, 1) }}%</span>
        </div>

        <div class="w-full bg-white/20 rounded-full h-2 sm:h-2.5 overflow-hidden backdrop-blur-sm">
            <div
                class="bg-[#4ade80] h-2 sm:h-2.5 rounded-full transition-all duration-500 ease-out"
                style="width: {{ $progressPercentage }}%"
            ></div>
        </div>
    </div>
</div>
