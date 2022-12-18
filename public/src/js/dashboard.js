const hamburgerMenu = document.getElementById('button-span')
const backgroundSidebar = document.getElementById('bg-sidebar')
const dropSidebar = document.getElementById('sidebarDropdown')
const dropSidebar2 = document.getElementById('sidebarDropdown2')
const dropName = document.getElementById('dropName')
const sidebarClose = document.getElementById('arrow-close-sidebar')
const checkboxEvent = document.getElementById('checkboxEvent')

if (hamburgerMenu) {
    hamburgerMenu.addEventListener('click', () => {
        document.querySelector('aside').classList.toggle('active')
    })
}

if (sidebarClose) {
    sidebarClose.addEventListener('click', () => {
        document.querySelector('aside').classList.toggle('active')
    })
}

if (backgroundSidebar) {
    backgroundSidebar.addEventListener('click', () => {
        document.querySelector('aside').classList.toggle('active')
    })
}

if (dropSidebar) {
    dropSidebar.addEventListener('click', () => {
        // console.log('hao')
        document.getElementById('arrow_program').classList.toggle('rotate-nav')
        document.getElementById('expand-program').classList.toggle('show')
    })
}

if (dropSidebar2) {
    dropSidebar2.addEventListener('click', () => {
        // console.log('hao')
        document.getElementById('arrow_program2').classList.toggle('rotate-nav')
        document.getElementById('expand-program2').classList.toggle('show')
    })
}

if (dropName) {
    dropName.addEventListener('click', () => {
        document.querySelector('header > .w-40').classList.toggle('show')
        document.querySelector('#dropName i').classList.toggle('rotate-nav')
    })
}

if (checkboxEvent != null) {
    checkboxEvent.addEventListener('click', () => {
        var el = document.getElementsByClassName('checkbox');
        for (var i = 0; i < el.length; i++) {

            if (el[i].checked == true) {
                if (checkboxEvent.checked == true) {
                    if (el[i].disabled != true) {
                        el[i].checked = true
                    }
                } else {
                    el[i].checked = false
                }
            } else {
                if (checkboxEvent.checked == false) {
                    el[i].checked = false
                } else {
                    if (el[i].disabled != true) {
                        el[i].checked = true
                    }
                }
            }
        }
    })
}


const closeAlert = document.getElementById('closeAlert')
if (closeAlert) {
    closeAlert.addEventListener('click', () => {
        closeAlert.parentElement.remove()
    })
}

const flashcard = document.getElementById('flashcard')

window.addEventListener('DOMContentLoaded', (event) => {
    if (document.querySelector('#flashcard > .relative').children[0]) {
        setTimeout(function () {
            document.querySelector('#flashcard > .relative').children[0].classList.remove('mr-0')
            document.querySelector('#flashcard > .relative').children[0].classList.add('mr-8')
            document.querySelector('#flashcard > .relative').children[0].classList.remove('translate-x-full')
        }, 500);
        setTimeout(function () {
            document.querySelector('#flashcard > .relative').children[0].classList.add('mr-0')
            document.querySelector('#flashcard > .relative').children[0].classList.remove('mr-8')
            document.querySelector('#flashcard > .relative').children[0].classList.add('translate-x-full')
        }, 3000);
    }
});

if (flashcard) {
    flashcard.addEventListener('click', (e) => {
        // console.log(e.target)
        if (e.target.classList[1] == 'bx-x-circle') {
            e.target.parentElement.classList.remove('mr-8')
            e.target.parentElement.classList.remove('translate-x-0')
            e.target.parentElement.classList.add('translate-x-full')
        }
    })
}