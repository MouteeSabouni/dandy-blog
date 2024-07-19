<div id="services" class="py-12 px-28 text-gray-200 text-sm">
    HOW WE CAN ASSIST YOU
</div>
<div class="flex px-28 text-white space-x-4">
    <a href="/services/website-localization" class="service-1 text-dandy-orange font-extrabold text-2xl hover:opacity-100" style="letter-spacing: -0.4px">
        Website Localization
    </a>
    <a href="/services/media-subtitling" class="service-2 font-extrabold text-2xl opacity-60 hover:opacity-100" style="letter-spacing: -0.4px">
        Media Subtitling
    </a>
    <a href="/services/legal-translation" class="service-3 font-extrabold text-2xl opacity-60 hover:opacity-100" style="letter-spacing: -0.4px">
        Legal Translation
    </a>
    <a href="/services/medical-translation" class="service-4 font-extrabold text-2xl opacity-60 hover:opacity-100" style="letter-spacing: -0.4px">
        Medical Translation
    </a>
</div>
<div class="content-1 px-28 text-white mt-8 mb-12 w-10/12">
    Every owner wants to increase global reach and improve engagement of their website. And that's where we come in.
    We help with reach and engagement with, translating with language-specific SEO, and ensure legal compliance with local regulations.
</div>

<div class="content-2 px-28 hidden text-white mt-8 mb-12 w-10/12">
    Provide accurate and synchronized subtitles.
    Enhance accessibility by SDH for hearing-impaired viewers.
    Translate cultural nuances for better understanding.
    Improve viewer engagement with high-quality, error-free subtitles.
</div>

<div class="content-3 px-28 hidden text-white mt-8 mb-12 w-10/12">
    Translate contracts with precise legal terminology.
    Ensure accuracy in court documents.
    Maintain confidentiality and data security.
    Comply with international legal standards.
    Translate patents and intellectual property documents.
</div>

<div class="content-4 px-28 hidden text-white mt-8 mb-12 w-10/12">
    Translate medical records and patient information accurately.
    Ensure clear communication for international patients.
    Translate clinical trial documents.
    Comply with medical regulatory standards.
    Localize medical device instructions for various markets.
</div>

<button>
    <div class="px-28 mb-20">
        <div class="flex text-white bg-black bg-opacity-50 hover:scale-110 hover:bg-opacity-75 hover:border hover:border-dandy-orange w-fit px-4 py-2 transition-all rounded-3xl">
            <div class="flex items-center pr-4">
                <img src="/images/phone.svg" class="w-7 h-7"/>
            </div>
            <div class="flex flex-col items-start">
                <div>
                    Give us a call to discuss the details.
                </div>
                <div>
                    No sales pitch, no commitment.

                </div>
            </div>
        </div>
    </div>
</button>

<script>
    var numbers = [1, 2, 3, 4];
    numbers.forEach(function(number) {
        document.querySelectorAll(`.service-${number}`).forEach(function(element) {
            element.addEventListener('mouseover', function() {
                // First, hide all content elements
                numbers.forEach(function(otherNumber) {
                    document.querySelector(`.content-${otherNumber}`).classList.add('hidden');
                    document.querySelector(`.service-${otherNumber}`).classList.add('opacity-60');
                    document.querySelector(`.service-${otherNumber}`).classList.remove('text-dandy-orange');
                });
                // Then, show the clicked content element
                document.querySelector(`.content-${number}`).classList.remove('hidden');
                document.querySelector(`.service-${number}`).classList.remove('opacity-60');
                document.querySelector(`.service-${number}`).classList.add('text-dandy-orange');
            });
        });
    });
</script>
