let formData = []

// ATTACH PREVENT DEFAULT TO ALL BUTTONS 
let buttons = document.querySelectorAll('.form-btn')

buttons.forEach(function (button) {
   button.addEventListener('click', function (event) {
      event.preventDefault()
      this.classList.add('clicked')
   })
})

// FORM DATA FOR VESSEL

let vessels = document.querySelectorAll('.vessel')

vessels.forEach(function (vessel) {
   vessel.addEventListener('click', function (event) {
      vessels.forEach(function (vessel) {
         vessel.classList.remove('clicked')
      })
      this.classList.add('clicked')

      formData['vessel'] = event.target.value
      console.info(formData)
   })
})

// FORM DATA FOR ROUTE

let routes = document.querySelectorAll('.route')

routes.forEach(function (route) {
   route.addEventListener('click', function (event) {
      routes.forEach(function (route) {
         route.classList.remove('clicked')
      })
      this.classList.add('clicked')

      formData['route'] = event.target.value
      console.info(formData)
   })
})

// FORM DATA FOR FARE

let fares = document.querySelectorAll('.fare')

fares.forEach(function (fare) {
   fare.addEventListener('click', function (event) {
      fares.forEach(function (fare) {
         fare.classList.remove('clicked')
      })
      this.classList.add('clicked')

      formData['fare'] = event.target.value
      console.info(formData)
   })
})

let sections = document.querySelectorAll('section')

let back = document.querySelector('#back')
let next = document.querySelector('#next')
let currentItem = 0;

back.addEventListener('click', function () {
   if (currentItem > 0) {
      sections[currentItem].classList.remove('originLeft')
      sections[currentItem].classList.add('originRight')
      sections[currentItem].classList.remove('reveal')

      currentItem--
      sections[currentItem].classList.add('originLeft')
      sections[currentItem].classList.add('reveal')
   }
})

next.addEventListener('click', function () {
   if (currentItem < 3) {
      sections[currentItem].classList.remove('originRight')
      sections[currentItem].classList.add('originLeft')
      sections[currentItem].classList.remove('reveal')

      currentItem++
      sections[currentItem].classList.add('originRight')
      sections[currentItem].classList.add('reveal')
   }
})
