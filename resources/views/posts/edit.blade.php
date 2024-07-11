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
    <title>{{ env('owner') }} — Edit Post</title>
    <style>
        textarea::-webkit-scrollbar {
            width: 0px;
            }
        body {
            font-family: 'Ubuntu';
        }
    </style>
</head>
<body class="bg-soft-black">
    <div class="flex flex-col items-center mt-8">
            <img class="h-30 w-40 mt-8 mb-8" src="/images/logo-madewithlove-white.svg">

            <div class="w-3/4 mt-6">
                    <form method="POST" action="{{ $post->path() }}">
                        @csrf
                        @method('PATCH')

                        <div class="text-white flex flex-col items-center">
                            <p class="text-3xl font-extrabold mb-8">Edit Post</p>
                        </div>

                        <div class="space-y-3">
                            <div class="text-white flex flex-col items-center">
                                <x-forms.input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') ?? $post->title }}"
                                    required />

                                @error('title')
                                    <span class="mt-2" role="alert">
                                        <p class="text-red-600">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-white flex flex-col items-center">
                                <x-forms.input
                                    type="text"
                                    id="excerpt"
                                    name="excerpt"
                                    value="{{ old('excerpt') ?? $post->excerpt }}"
                                    required />

                                @error('excerpt')
                                    <span class="mt-2" role="alert">
                                        <p class="text-red-600">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-white flex flex-col items-center">
                                <textarea
                                    rows = "4"
                                    class="block resize-none overflow-auto bg-input-bg py-3 px-5 text-white placeholder:text-base placeholder:text-input-text sm:text-sm sm:leading-6 w-1/2 rounded-3xl h-full"
                                    type="text"
                                    id="body"
                                    name="body"
                                    required
                                    >{{ old('body') ?? $post->body }}</textarea>

                                @error('body')
                                    <span class="mt-2" role="alert">
                                        <p class="text-red-600">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-white flex flex-col items-center">
                                <x-forms.button class="text-xl font-medium px-8 py-4 mt-6 mb-4" type="submit">Save</x-forms.button>
                            </div>

                            <div class="flex flex-col items-center">
                                <p class="text-input-text">
                                    Changed your mind?<a href="javascript:history.back()" class="text-white ml-1">Go Back</a>
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
