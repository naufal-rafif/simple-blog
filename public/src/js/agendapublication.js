const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');
const dropNav = document.getElementById('nav-dropdown')
const spanDropdown = document.querySelector('#nav-dropdown span')
const navDropItem = document.getElementById('nav-dropdown-item')

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('hamburger-active')
    navMenu.classList.toggle('hidden')
})

dropNav.addEventListener('click', () => {
    navDropItem.classList.toggle('hidden')
    spanDropdown.classList.toggle('rotate-90')
})

// Navbar
window.onscroll = function () {
    const header = document.querySelector('header')
    const fixedNav = header.offsetTop;


    if (window.pageYOffset > fixedNav) {
        // header.classList.add('navbar-fixed')
        navDropItem.classList.add('hidden')
        hamburger.classList.remove('hamburger-active')
        navMenu.classList.add('hidden')
    } else {
        // header.classList.remove('navbar-fixed')
        navDropItem.classList.add('hidden')
        hamburger.classList.remove('hamburger-active')
        navMenu.classList.add('hidden')
    }

}