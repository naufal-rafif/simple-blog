<script src="{!! asset('src/js/agendapublication.js') !!}" defer></script>
{{-- <script>
    const slider = document.querySelectorAll('.drag-slider');
    let isDown = false;
    let startX;
    let scrollLeft;
    for (let i = 0; i < slider.length; i++) {
        console.log(i)
        slider[i].addEventListener('mousedown', (e) => {
            isDown = true;
            slider[i].classList.add('active');
            startX = e.pageX - slider[i].offsetLeft;
            scrollLeft = slider[i].scrollLeft;
        });
        slider[i].addEventListener('mouseleave', () => {
            isDown = false;
            slider[i].classList.remove('active');
        });
        slider[i].addEventListener('mouseup', () => {
            isDown = false;
            slider[i].classList.remove('active');
        });
        slider[i].addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider[i].offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider[i].scrollLeft = scrollLeft - walk;
            console.log(walk);
        });
    }
    const lpjSection = document.getElementById('lpj')
    var splides = document.querySelectorAll('.splide');
    // 1. query slider elements: are there any splide elements?
    if (splides.length) {
        // 2. process all instances
        for (var i = 0; i < splides.length; i++) {
            var splideElement = splides[i];
            //3.1 if no options are defined by 'data-splide' attribute: take these default options
            var splideDefaultOptions =
            {
                // type: 'loop',
                rewind: true,
                arrows: true,
                perPage: 4,
                gap: '2rem',
                height: '20rem',
                pagination: false,
                breakpoints: {
                    1200: {
                        perPage: 4,
                        height: '18rem',
                        gap: '.7rem',
                    },
                    1080: {
                        perPage: 3,
                        height: '18rem',
                        gap: '.7rem',
                    },
                    720: {
                        perPage: 3,
                        height: '14rem',
                        gap: '.7rem',
                    },
                    640: {
                        perPage: 2,
                        height: '14rem',
                        gap: '.7rem',
                    },
                },
            }
            /**
            * 3.2 if options are defined by 'data-splide' attribute: default options will we overridden
            * see documentation: https://splidejs.com/guides/options/#by-data-attribute
            **/

            var splide = new Splide(splideElement, splideDefaultOptions);
            // 3. mount/initialize this slider
            splide.mount();
        }
    }

    lpjSection.addEventListener('click', (e) => {
        if (e.target.closest('.spanBerkas')) {
            e.target.closest('.spanBerkas').querySelector('div').classList.toggle('rotate-180')
            e.target.closest('.publication').querySelector('.card-slider').classList.toggle('hide')
        }
    })
</script> --}}