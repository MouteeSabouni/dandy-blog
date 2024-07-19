<?php
    $clients = 'Telenet, Juce, Urbantz, Cheqroom, SweepBright, Axelera.ai, SMSFactor, Teamleader, Yields, MinersAI, Combell, Disney, Amazon, EasyPay, Ecoinvent, FixForm, Flying Service, Helpper, Contractify, CrazyGames, We Invest, 3D Aim Trainer, Zapfloor, African Drive, Meet Roger, Axelera.ai, NS, Phished, The Insiders, GearJot, Yescapa, Edgar & Cooper, Flexmail, Doccle, Medexel, VDAB, MinersAI, Izix, Optimy, Phished, publiq, Meet Roger, Sustainable Impact, MobieTrain, Zapfloor, Creative Shelter, CitizenLab, StoryChief, KBC, Timeseer.ai, Tangent Works';
    $clients = explode(', ', $clients);
?>

<x-layouts.home>
    <x-slot:title>
        Home
    </x-slot:title>

    <div class="py-24 px-28 w-full font-extrabold text-white bg-soft-black"
        style="font-size: 55px; line-height: 65px">
        <div class="px-10 text-center">
            <span class="text-dandy-orange">Translation </span>brings the world together, making <span class="text-dandy-orange">communication</span> between individuals much easier and much much faster.
        </div>
    </div>

    <x-layouts.services-section />

    <div class="flex text-white bg-black bg-opacity-90 w-fit">
        <div class="px-28 mb-10 flex flex-col items-left">
            <p class="text-sm mt-16">
                CLIENTS WE LEFT BEHIND SMILING
            </p>
            <div class="mt-6 text-xl font-medium">
                @foreach ($clients as $client)
                    <span class="{{ ($loop->iteration % 3 === 0) ? 'text-dandy-orange' : 'text-white' }}">
                        {{ (!$loop->last) ? $client . ',' : $client }}
                    </span>
                @endforeach
                ... and about 150 more.
            </div>
        </div>
    </div>

    <div id="blog" class="flex flex-col items-left bg-white/85 px-28 text-sm pt-16 pb-10">
        OUR RECENT BLOG POSTS
    </div>

    <div class="flex space-x-6 bg-white/85 px-28 pb-10">
            @foreach($posts as $post)
            <div class="flex flex-col w-96">
                <a href="/posts/{{ $post->id }}">
                    <img src="/images/post-image.png" class="rounded-3xl w-full h-80 opacity-80 hover:scale-105 hover:animate-pulse" />
                </a>
                <x-posts.sm-card :$post />
            </div>
            @endforeach
    </div>
    <div class="pt-12 px-28 bg-dandy-tail">
        <div class="flex flex-col items-center">
            <div>
                <img src="/images/rkd.png" class="my-10 w-48 h-48">
            </div>
            <div class="text-3xl font-extrabold w-3/4 text-white text-center">
                Roduan, a software engineer with 5 years of xp, possesses incredible skills and understanding of various programming languages. Thus, your request to get advice from him is a request you'll never regret.
            </div>
            <div class="flex space-x-10 mt-10 mb-20 text-white">
                <a href="https://madewithlove.com/team/roduan-kareem-aldeen/" class="rounded-2xl font-bold px-4 py-2 hover:scale-110 border border-white border-2" target="_blank">
                    Read his posts
                </a>
                <a href="https://www.linkedin.com/in/roduankd/" target="_blank" class="rounded-2xl font-bold px-4 py-2 bg-white text-dandy-tail hover:scale-110">
                    Reach out
                </a>
            </div>
        </div>
    </div>

    <x-layouts.contact-us />

    <x-layouts.footer :$posts />

</x-layouts.home>
