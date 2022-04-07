<div x-show="roleOpen" @click="roleOpen = false"
                class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

<div x-show="roleOpen"
    class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10"
    style="width: 20rem; display: none;">
    @if(!empty($roles))
    @foreach ($roles as $role)
        @if( $role['id'] == session()->get('current_role'))
            <a href="#" title="{{ $role['role_desc'] }}"
                class="flex items-center px-4 py-3 text-white bg-gray-900 cursor-not-allowed -mx-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-md font-bold mx-2">
                    {{ $role['role_name'] }}
                </p>
            </a>
        @else
            <a href="/roleplay/switch/{{ $role['id'] }}" title="{{ $role['role_desc'] }}"
                class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2  hover:font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm mx-2">
                    {{ $role['role_name'] }}
                </p>
            </a>
        @endif
    @endforeach
    @endif
    
</div>