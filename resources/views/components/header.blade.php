
    <div class="bg-[#031224] rounded-b-[30px] pb-2">
        <nav class="flex items-center justify-between p-3 border-b-2 border-[#1e293b]">
            <!-- Logo Section -->
            <div class="flex items-center gap-1.5 ml-12">
                <i class='bx bx-landscape text-customGray text-2xl'></i>
                <a href="{{ url('/') }}" class="text-2xl">LifeTrack</a>
            </div>

            <!-- Navigation Links -->
            <div class="flex gap-4">
                <a href="{{ url('/dashboard') }}" class="text-linkGray hover:text-white transition">Dashboard</a>
                <a href="{{ route('transactions.index') }}" class="text-linkGray hover:text-white transition">Budget</a>
                <a href="{{ url('/events') }}" class="text-linkGray hover:text-white transition">Events</a>
                <a href="{{ route('apparels.index') }}" class="text-linkGray hover:text-white transition">Closet</a>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-4">
                <i class='bx bx-bell text-customGray bg-[#1e293b] p-nav rounded-2xl cursor-pointer text-2xl transition-colors duration-300 hover:bg-[#b461f4]'></i>
                <i class='bx bx-search text-customGray bg-[#1e293b] p-nav rounded-2xl cursor-pointer text-2xl transition-colors duration-300 hover:bg-[#b461f4]'></i>
                <a href="{{ route('profile.index') }}">
                    <i class='bx bxs-user-account text-customGray bg-[#1e293b] p-nav rounded-2xl cursor-pointer text-2xl transition-colors duration-300 hover:bg-[#b461f4]'></i>
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">
                        <i class='bx bx-log-out text-customGray bg-[#1e293b] p-nav rounded-2xl cursor-pointer text-2xl transition-colors duration-300 hover:bg-[#b461f4]'></i>
                    </button>
                </form>
            </div>
        </nav>

        {{$slot}}
            
    </div>

    

