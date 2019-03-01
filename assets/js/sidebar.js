
// ASIDE
let overlay = document.querySelector('#overlay')
let body = document.querySelector('body')
let aside = document.querySelector('aside')
let sideOpen = document.querySelector('#side-open')
let sideClose = document.querySelector('#side-close')

sideOpen.addEventListener('click', function () {
   overlay.classList.add('overlay')
   aside.classList.remove('side-hide')
   body.classList.add('overflow-hide')
})
sideClose.addEventListener('click', function () {
   overlay.classList.remove('overlay')
   aside.classList.add('side-hide')
   body.classList.remove('overflow-hide')
})