<footer class="px-28 bg-black py-12">
    <div class="flex justify-between">
        <div class="flex">
            <span style="font-size: 55px" class="font-bold text-love-red pb-12">We work with</span>
            <img class="h-20 w-20 ml-3" src="https://madewithlove.com/blog/content/images/size/w256h256/2023/02/mwl-logo-square.png">
        </div>
        <a href="#top">
            <img src="/images/arrow-circle-up.svg" class="w-16 h-16 animate-bounce">
        </a>
    </div>
    <div class="flex justify-between">
        <div class="flex flex-col items-center mr-20">
            <p class="text-white font-bold text-2xl mb-6">OUR PARTNERS</p>
            <img src="/images/sainsbury.png" class="object-contain w-32 h-14">
            <img src="/images/spotify.png" class="object-contain w-32 h-14">
            <img src="/images/prime.png" class="object-contain w-32 h-14">
            <img src="/images/waitrose.png" class="object-contain w-32 h-14">
        </div>
        <div class="flex flex-col -ml-16">
            <p class="text-zinc-400 font-bold mb-8">WHAT WE OFFER</p>
            <div class="flex flex-col space-y-5">
                <a href="/services/website-localization" class="service-1 text-white hover:opacity-60">
                    Website Localization
                </a>
                <a href="/services/media-subtitling" class="service-2 text-white hover:opacity-60" style="letter-spacing: -0.4px">
                    Media Subtitling
                </a>
                <a href="/services/legal-translation" class="service-3 text-white hover:opacity-60" style="letter-spacing: -0.4px">
                    Legal Translation
                </a>
                <a href="/services/medical-translation" class="service-4 text-white hover:opacity-60" style="letter-spacing: -0.4px">
                    Medical Translation
                </a>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-zinc-400 font-bold mb-8">WHY WE STAND OUT</p>
            <div class="flex flex-col space-y-5">
                <p class="service-1 text-white">
                    Friendly teams
                </p>
                <p class="service-3 text-white" style="letter-spacing: -0.4px">
                    Loyalty to our clients
                </p>
                <p class="service-4 text-white" style="letter-spacing: -0.4px">
                    Diversity always welcome
                </p>
                <p class="service-4 text-white" style="letter-spacing: -0.4px">
                    Commitment is a priority
                </p>
                <p class="service-2 text-white" style="letter-spacing: -0.4px">
                    Love exists everywhere
                </p>
            </div>
        </div>
        <div class="flex flex-col w-96">
            <p class="text-zinc-400 font-bold mb-8">ON OUR BLOG</p>
            @foreach($posts as $post)
            <a class="text-white hover:font-bold hover:-ml-3 hover:text-lg transition-all" href="/posts/{{ $post->id }}">{{ $post->excerpt }}</a>
            <div class="py-2">
                <hr>
            </div>
            @endforeach
        </div>
    </div>
</footer>
