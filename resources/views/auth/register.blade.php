<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('incl.assets')
    <title>Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="resources/css/app.css">
</head>

<body>
    <div class="min-h-screen flex justify-center items-center bg-cover bg-center" style="background-image: url( {{ asset('img/img.jpg') }} );">

        <div class="warpper bg-purple-800 bg-opacity-20 backdrop-blur-lg border border-white border-opacity-20 shadow-lg rounded-lg p-8 text-white">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1 class="text-center text-3xl mb-6">Register</h1>

                <div class="input-box relative mb-6">
                    <input type="text" name="name" placeholder="Name" id="name" class="w-full h-12 px-4 py-2 bg-transparent border-2 border-white border-opacity-20 rounded-full placeholder-white text-white" required>
                    <i class='bx bx-user absolute right-4 top-1/2 transform -translate-y-1/2 text-xl'></i>
                </div>

                <div class="input-box relative mb-6">
                    <input type="email" name="email" placeholder="Email" id="email" class="w-full h-12 px-4 py-2 bg-transparent border-2 border-white border-opacity-20 rounded-full placeholder-white text-white" required>
                    <i class='bx bx-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-xl'></i>
                </div>

                <div class="input-box relative mb-6">
                    <input type="password" name="password" placeholder="Password" id="password" class="w-full h-12 px-4 py-2 bg-transparent border-2 border-white border-opacity-20 rounded-full placeholder-white text-white" required>
                    <i class='bx bxs-lock-alt absolute right-4 top-1/2 transform -translate-y-1/2 text-xl'></i>
                </div>

                <div class="input-box relative mb-6">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" class="w-full h-12 px-4 py-2 bg-transparent border-2 border-white border-opacity-20 rounded-full placeholder-white text-white" required>
                    <i class='bx bxs-lock-alt absolute right-4 top-1/2 transform -translate-y-1/2 text-xl'></i>
                </div>

                <button type="submit" class="btn w-full h-12 bg-white text-gray-900 font-semibold rounded-full shadow-lg hover:text-indigo-800">Register</button>

                <div class="register-link text-center mt-6">
                    <p>Already have an account? <a href="{{ route('login') }}" class="font-semibold hover:underline">Login Now</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
