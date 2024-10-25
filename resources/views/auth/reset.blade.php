
<div class="container mx-auto mt-6">
    <h2 class="text-center text-2xl">Reset Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="mb-4">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="mb-4">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="mb-4">
            <label for="password-confirm">Confirm Password</label>
            <input type="password" id="password-confirm" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn bg-teal-900 text-white">Reset Password</button>
    </form>
</div>

