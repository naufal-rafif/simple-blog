const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');
const dropNav = document.getElementById('nav-dropdown')
const spanDropdown = document.querySelector('#nav-dropdown span')
const navDropItem = document.getElementById('nav-dropdown-item')
const dropNav2 = document.getElementById('nav-dropdown-2')
const spanDropdown2 = document.querySelector('#nav-dropdown-2 span')
const navDropItem2 = document.getElementById('nav-dropdown-item-2')
const clickVisMis = document.getElementById('changeVisMis')
const btnChangeAbout = document.getElementById('change-class-about')
const btnCloseAbout = document.getElementById('close-class-about')
const btnCheckProgram = document.getElementById('btn-check-program')
const btnCheckProgram2 = document.getElementById('btn-check-program-2')
const changeProgramList = document.getElementById('change-program-list')
const changeProgramList2 = document.getElementById('change-program-list-2')
const floatingChange = document.getElementById('floating_change')
const closeModalPublikasi = document.getElementById('closeModalPublikasi')
const backgroundModalAgenda = document.getElementById('backgroundModalAgenda')
const backgroundModalPublikasi = document.getElementById('backgroundModalPublikasi')
const openGallery = document.getElementById('openGallery')
var base_url = window.location.origin

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('hamburger-active')
    navMenu.classList.toggle('hidden')
})

dropNav.addEventListener('click', () => {
    navDropItem2.classList.add('hidden')
    spanDropdown2.classList.remove('rotate-90')
    navDropItem.classList.toggle('hidden')
    spanDropdown.classList.toggle('rotate-90')
})
dropNav2.addEventListener('click', () => {
    navDropItem.classList.add('hidden')
    spanDropdown.classList.remove('rotate-90')
    navDropItem2.classList.toggle('hidden')
    spanDropdown2.classList.toggle('rotate-90')
})

// Navbar
window.onscroll = function () {
    const header = document.querySelector('header')
    const letters_logo = document.getElementById('letters-logo')
    const logo = document.getElementById('logo')
    const fixedNav = header.offsetTop;


    if (window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed')
        letters_logo.classList.remove('hidden')
        logo.classList.add('hidden')
        navDropItem.classList.add('hidden')
        hamburger.classList.remove('hamburger-active')
        navMenu.classList.add('hidden')
    } else {
        header.classList.remove('navbar-fixed')
        letters_logo.classList.add('hidden')
        logo.classList.remove('hidden')
        navDropItem.classList.add('hidden')
        hamburger.classList.remove('hamburger-active')
        navMenu.classList.add('hidden')
    }

}

btnChangeAbout.addEventListener('click', () => {
    document.getElementById('showAbout').classList.toggle('show')

    setTimeout(function () {
        document.getElementById('image-about').classList.add('hidden')
        document.getElementById('about-desc-2').classList.remove('hidden')
        document.getElementById('about_us_component').classList.add('hidden')
        document.querySelector('#about-desc-2 h1').classList.add('hidden')
        document.getElementById('showAbout').classList.toggle('show')
    }, 500);

})

btnCloseAbout.addEventListener('click', () => {
    document.getElementById('showAbout').classList.toggle('show')
    setTimeout(function () {
        document.getElementById('image-about').classList.remove('hidden')
        document.getElementById('about-desc-2').classList.add('hidden')
        document.getElementById('about_us_component').classList.remove('hidden')
        document.querySelector('#about-desc-2 h1').classList.remove('hidden')
        document.getElementById('showAbout').classList.toggle('show')
    }, 500);
})

if (btnCheckProgram2) {
    btnCheckProgram2.addEventListener('click', (e) => {
        const dataValue = e.target.dataset.val
        e.target.dataset.val = btnCheckProgram2.innerHTML
        btnCheckProgram2.innerHTML = dataValue
        document.getElementById('dot-program-desc-2').classList.toggle('hidden')
        document.getElementById('expanded-program-description-2').classList.toggle('hidden')
        const lengthImageUrl = document.getElementById('image-program-background-2').classList.length - 1
        const imageUrl = document.getElementById('image-program-background-2').classList[lengthImageUrl]
        document.getElementById('programList2Component').classList.toggle('show')

        setTimeout(function () {
            // document.getElementById('image-program-background-2').classList.remove(imageUrl)
            // document.getElementById('image-program-background-2').classList.add(imageUrl)
            document.getElementById('container-image-program-2').classList.toggle('padding-right')
            document.getElementById('container-image-program-2').classList.toggle('lg:w-3/5')
            document.getElementById('container-description-program-2').classList.toggle('lg:w-2/5')
            document.getElementById('container-description-program-2').classList.toggle('lg:w-full')
            document.getElementById('container-description-program-2').classList.toggle('lg:mt-8')
            document.getElementById('container-image-program-2').classList.toggle('lg:w-full')
            document.getElementById('container-image-program-2').classList.toggle('lg:pr-0')
            document.getElementById('container-image-program-2').classList.toggle('lg:pr-5')
            document.getElementById('container-description-program-2').classList.toggle('lg:w-full')
            document.getElementById('flex_on_click_program_1').classList.toggle('lg:w-2/3')
            document.getElementById('flex_on_click_program_1').classList.toggle('lg:w-3/5')
            document.getElementById('flex_on_click_program_2').classList.toggle('lg:w-1/3')
            document.getElementById('flex_on_click_program_2').classList.toggle('lg:w-2/5')
            document.getElementById('programList2Component').classList.toggle('show')
            document.getElementById('image-program-background-2').classList.toggle('square')
        }, 500);
    })
}


btnCheckProgram.addEventListener('click', (e) => {
    // const image = document.getElementById('image-program-background').dataset.image
    const dataValue = e.target.dataset.val
    e.target.dataset.val = btnCheckProgram.innerHTML
    btnCheckProgram.innerHTML = dataValue
    document.getElementById('programListComponent').classList.toggle('show')

    setTimeout(function () {
        document.getElementById('dot-program-desc').classList.toggle('hidden')
        document.getElementById('regular-program-description').classList.toggle('hidden')
        document.getElementById('full-program-description').classList.toggle('hidden')
        // document.getElementById('image-program-background').classList.toggle('square')
        document.getElementById('container-image-program').classList.toggle('padding-right')
        document.getElementById('container-image-program').classList.toggle('md:w-1/2')
        document.getElementById('container-image-program').classList.toggle('lg:pr-0')
        document.getElementById('container-image-program').classList.toggle('lg:pr-5')
        document.getElementById('container-image-program').classList.toggle('lg:pb-5')
        document.getElementById('container-description-program').classList.toggle('md:w-1/2')
        document.getElementById('container-description-program').classList.toggle('lg:mt-8')
        document.getElementById('programListComponent').classList.toggle('show')
        if (e.target.dataset.val == 'Selengkapnya') {
            let height = document.getElementById('image-program-background').offsetWidth * .6 + 'px'
            document.getElementById('image-program-background').style.height = height
            document.getElementById('change-program-list').style.height = document.getElementById('image-program-background').offsetWidth * .6 + 'px'
        } else {
            let height = document.getElementById('image-program-background').offsetWidth * 1 + 'px'
            document.getElementById('image-program-background').style.height = height
            document.getElementById('change-program-list').style.height = document.getElementById('image-program-background').offsetWidth * 1 + 'px'
        }
    }, 500);

})

changeProgramList.addEventListener('click', async (e) => {
    // console.log(e.target)
    if (e.target.classList[0] != 'image__list') {

        const getLastActive = document.querySelector('#change-program-list .active')
        getLastActive.classList.toggle('active')
        e.target.closest('.card-shadow').classList.add('active')
        const getValue = e.target.closest('.card-shadow').dataset.val
        const getImage = e.target.closest('.card-shadow').dataset.image
        const getName = e.target.closest('.card-shadow').dataset.name
        const getFull = e.target.closest('.card-shadow').dataset.full
        const getFirst = e.target.closest('.card-shadow').dataset.first
        document.getElementById('programListComponent').classList.toggle('show')
        // console.log(getLast)
        setTimeout(function () {
            document.getElementById('image-program-background').dataset.image = `${base_url}/src/img/program/reguler/${getImage}`
            document.getElementById('image-program-background').src = `${base_url}/src/img/program/reguler/${getImage}`
            document.getElementById('image-program-background').style.backgroundImage = `url(${base_url}/src/img/program/reguler/${getImage})`
            document.getElementById('regular-program-name').innerHTML = getName
            document.getElementById('regular-program-description').innerHTML = getFirst
            document.getElementById('full-program-description').innerHTML = getFull
            // document.getElementById('full-program-description').classList.toggle('hidden')
            // document.getElementById('regular-program-description').classList.toggle('hidden')
            document.getElementById('programListComponent').classList.toggle('show')
        }, 500);

    }
})

changeProgramList2.addEventListener('click', async (e) => {
    if (e.target.classList[0] != 'image__list') {
        const getLastActive = document.querySelector('#change-program-list-2 .active')
        getLastActive.classList.toggle('active')
        e.target.classList.add('active')
        const getValue = e.target.dataset.val
        const lengthIndexClass = document.getElementById('image-program-background-2').classList.length - 1
        const imageClassName = document.getElementById('image-program-background-2').classList[lengthIndexClass]

        document.getElementById('programList2Component').classList.toggle('show')

        setTimeout(function () {
            // document.getElementById('container-image-program-2').classList.toggle('show')
            // document.getElementById('container-image-program-2').classList.toggle('hide')

            // document.getElementById('image-program-background-2').classList.remove(imageClassName)
            document.getElementById('image-program-background-2').dataset.image = `${base_url}/src/img/program/tahfizhcamp/${e.target.dataset.image}`
            document.getElementById('image-program-background-2').style.backgroundImage = `url(${base_url}/src/img/program/tahfizhcamp/${e.target.dataset.image})`
            document.getElementById('programList2Component').classList.toggle('show')
        }, 500);

        // document.getElementById('programList2Component').classList.toggle('show')
    }
})

floatingChange.addEventListener('click', (e) => {
    document.getElementById('floating_1').classList.toggle('floating_1')
    document.getElementById('floating_2').classList.toggle('floating_2')
    document.getElementById('floating_3').classList.toggle('floating_3')
    document.getElementById('floatAutoClose').classList.toggle('hidden')
})

document.getElementById('floatAutoClose').addEventListener('click', () => {
    document.getElementById('floating_1').classList.toggle('floating_1')
    document.getElementById('floating_2').classList.toggle('floating_2')
    document.getElementById('floating_3').classList.toggle('floating_3')
    document.getElementById('floatAutoClose').classList.add('hidden')
    // console.log('clicked')
})

closeModalPublikasi.addEventListener('click', () => {
    document.getElementById('modalPublikasi').classList.remove('show')
    document.getElementById('modalPublikasi').classList.add('hide')
    setTimeout(function () { document.getElementById('modalPublikasi').classList.toggle('hidden') }, 500);
})


// document.getElementById('image-program-background').addEventListener('dblclick',()=>{
//     console.log('hai')
// })

function imageZoom(e) {
    document.getElementById('imageZoom').src = e.dataset.image;
    document.getElementById('modalImageZoom').classList.toggle('hidden')
    document.getElementById('modalImageZoom').classList.add('show')
    document.getElementById('modalImageZoom').classList.remove('hide')
}

document.getElementById('modalImageZoom').addEventListener('click', (e) => {
    if (e.target.id == 'backgroundModalImage') {
        document.getElementById('modalImageZoom').classList.remove('show')
        document.getElementById('modalImageZoom').classList.add('hide')
        setTimeout(function () { document.getElementById('modalImageZoom').classList.toggle('hidden') }, 500);
    }
})

document.getElementById('modalAgenda').addEventListener('click', (e) => {
    // console.log(e.target)
    if (e.target.id == 'modalAgendaClose') {
        document.getElementById('modalAgenda').classList.remove('show')
        document.getElementById('modalAgenda').classList.add('hide')
        setTimeout(function () { document.getElementById('modalAgenda').classList.toggle('hidden') }, 500);
    }
})

document.getElementById('modalPublikasi').addEventListener('click', (e) => {
    if (e.target.id == 'modalPublikasiClose') {
        document.getElementById('modalPublikasi').classList.remove('show')
        document.getElementById('modalPublikasi').classList.add('hide')
        setTimeout(function () { document.getElementById('modalPublikasi').classList.toggle('hidden') }, 500);
    }
})


function growHeight() {
    document.getElementById('btn-vismis-selengkapnya').classList.toggle('hidden')
    document.getElementById('btn-vismis-span-selengkapnya').classList.toggle('hidden')
    var growDiv = document.getElementById('all-vismis');
    if (growDiv.clientHeight <= 200) {
        var wrapper = document.querySelector('.wrapper-vismis');
        growDiv.style.height = wrapper.clientHeight + "px";
    } else {
        growDiv.style.height = '200px';
    }
}


// async function showProgram()
// {    
//     const response = await fetch(`${base_url}/api/v1/program/regular`, {
//         headers: {
//             "Content-Type": "application/json",
//             "X-Requested-With": "XMLHttpRequest"
//         }
//     });
//     const program = await response.json();
//     document.getElementById('regular-program-description').innerHTML = program[0].firstsubstr
//     document.getElementById('expanded-program-description').innerHTML = program[0].lastsubstr
// }

async function setProgramRegulerHeight() {
    // console.log('hai')
    const height = document.getElementById('container-image-program').offsetHeight
    document.getElementById('heightRegulerProgram').style.height = height + 'px'
}

async function setProgramReguler2Height() {
    // console.log('hai')
    var imageList = document.querySelectorAll('.image__list')
    if (imageList.length > 5) {
        const height = document.getElementById('container-image-program-2').offsetHeight
        document.getElementById('change-height-list').style.height = height + 'px'
    }
}

const date = new Date();
let year = date.getFullYear();
document.getElementById('this_year').innerHTML = year


// const flashcard = document.getElementById('flashcard')

// window.addEventListener('DOMContentLoaded', (event) => {
//     if (document.querySelector('#flashcard > .relative').children[0]) {
//         setTimeout(function () {
//             document.querySelector('#flashcard > .relative').children[0].classList.remove('mr-0')
//             document.querySelector('#flashcard > .relative').children[0].classList.add('mr-8')
//             document.querySelector('#flashcard > .relative').children[0].classList.remove('translate-x-full')
//         }, 500);
//         setTimeout(function () {
//             document.querySelector('#flashcard > .relative').children[0].classList.add('mr-0')
//             document.querySelector('#flashcard > .relative').children[0].classList.remove('mr-8')
//             document.querySelector('#flashcard > .relative').children[0].classList.add('translate-x-full')
//         }, 3000);
//     }

//     // showProgram();
//     setProgramRegulerHeight();
//     setProgramReguler2Height();
// });

// if (flashcard) {
//     flashcard.addEventListener('click', (e) => {
//         // console.log(e.target)
//         if (e.target.classList[1] == 'bx-x-circle') {
//             e.target.parentElement.classList.remove('mr-8')
//             e.target.parentElement.classList.remove('translate-x-0')
//             e.target.parentElement.classList.add('translate-x-full')
//         }
//     })
// }
window.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('feedbackPesan')
    if (document.getElementById('feedbackPesan')) {
        // console.log('sini')
        document.getElementById('modalAgenda').classList.toggle('hidden')
        document.getElementById('modalAgenda').classList.add('show')
        document.getElementById('modalAgenda').classList.remove('hide')
        setTimeout(function () {
            document.getElementById('modalAgenda').classList.toggle('hidden')
            document.getElementById('modalAgenda').classList.add('show')
            document.getElementById('modalAgenda').classList.remove('hide')
        }, 2000);
    }
})

document.getElementById('change-height-list').style.height = document.getElementById('image-program-background-2').offsetWidth * 1 + 'px'
window.addEventListener('resize', () => {
    document.getElementById('change-height-list').style.height = document.getElementById('image-program-background-2').offsetWidth * 1 + 'px'
});

document.getElementById('kirimPesan').addEventListener('click', (e) => {
    if (document.getElementById('emailInput').value == '' && document.getElementById('whatsappInput').value == '') {
        document.getElementById('emailError').classList.remove('hidden')
        document.getElementById('emailError').innerHTML = 'email dan whatsapp harus diisi salah satu'
        document.getElementById('whatsappError').classList.remove('hidden')
        document.getElementById('whatsappError').innerHTML = 'email dan whatsapp harus diisi salah satu'
    } else if (document.getElementById('nameInput').value == '') {
        document.getElementById('emailError').classList.add('hidden')
        document.getElementById('whatsappError').classList.add('hidden')
        document.getElementById('nameError').classList.remove('hidden')
        document.getElementById('nameError').innerHTML = 'nama harus diisi'
    } else if (document.getElementById('messageInput').value == '') {
        document.getElementById('emailError').classList.add('hidden')
        document.getElementById('whatsappError').classList.add('hidden')
        document.getElementById('messageError').classList.remove('hidden')
        document.getElementById('messageError').innerHTML = 'pesan harus diisi'
    } else {
        if (document.getElementById('emailInput').value != '') {
            if (validateEmail(document.getElementById('emailInput').value)) {
                document.getElementById('insertForm').submit()
            } else {
                document.getElementById('emailError').classList.remove('hidden')
                document.getElementById('emailError').innerHTML = 'teks bukan merupakan tipe email'
            }
        } else {
            document.getElementById('insertForm').submit()
        }
    }
})

function validateEmail(val) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(val);
}