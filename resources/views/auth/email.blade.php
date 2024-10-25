
<div class="container mx-auto mt-6">
    <h2 class="text-center text-2xl">Reset Password</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit" class="btn bg-teal-900 text-white">Send Password Reset Link</button>
    </form>
</div>

