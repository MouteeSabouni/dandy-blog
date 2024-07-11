<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpeg" href="https://madewithlove.com/blog/content/images/size/w256h256/2023/02/mwl-logo-square.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>{{ $_ENV['OWNER'] }} — Log in</title>
</head>
<body class="bg-soft-black">
    <div class="flex flex-col items-center mt-12">
            <img class="h-30 w-40 mt-12 mb-12" src="/images/logo-madewithlove-white.svg">

            <div class="w-1/2 mt-8">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="text-white flex flex-col items-center">
                            <p class="text-3xl font-extrabold mb-8">Log in</p>
                        </div>

                        <div class="space-y-3">
                            <div class="text-white flex flex-col items-center">
                                <x-forms.input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Your email"
                                    value="{{ old('email') }}"
                                    required />

                                @error('email')
                                    <span class="mt-2" role="alert">
                                        <p class="text-red-600">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-white flex flex-col items-center">
                                <x-forms.input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Your password"
                                    required />
                            </div>

                            <div class="text-white flex flex-col items-center">
                                <x-forms.button class="text-xl font-medium px-8 py-4 mt-6 mb-4" type="submit">Log in</x-forms.button>
                            </div>

                            <div class="flex flex-col items-center">
                                <p class="text-input-text">
                                    You don't have an account?<a href="/register" class="text-white"> Register now.</a>
                                    <br>
                                    Maybe later?<a href="/" class="text-white"> Go back to the home page.</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
