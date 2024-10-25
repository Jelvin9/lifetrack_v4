@extends ('layouts.layout')

@section('header')
<x-header>
</x-header>
@endsection

@section('content')

<div class="relative max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg text-center">
    <!-- Edit Icon -->
    <div class="absolute top-4 right-4">
        <a href="{{ route('profile.edit') }}">
            <i class='bx bx-edit text-2xl text-gray-600 hover:text-gray-800'></i>
        </a>
    </div>

    <!-- Profile Picture -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('storage/' . $user->userinfo->profile_pic) }}" alt="Profile Picture"
            class="w-36 h-36 rounded-full border-4 border-gray-300 object-cover shadow-md">
    </div>

    <!-- User Info -->
    <div class="space-y-2">
        <h1 class="text-2xl font-semibold">{{ $user->userinfo->full_name }}</h1>
        <p class="text-gray-600">{{ $user->userinfo->email }}</p>
        <p class="text-gray-600">{{ $user->userinfo->phone_number }}</p>
        <p class="text-gray-500">{{ $user->userinfo->bio }}</p>
    </div>
</div>



@endsection