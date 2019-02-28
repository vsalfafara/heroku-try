let formData = []

// ALL FORM BUTTONS 
let buttons = document.querySelectorAll('.form-btn')

// NAV BUTTONS 
let back = document.querySelector('#back')
let next = document.querySelector('#next')
next.style.visibility = 'hidden'

// VESSEL
let vessels = document.querySelectorAll('.vessel')

// VOYAGE DETAILS
let vnumber = document.querySelector('#voyage-number')
let day = document.querySelector('#day')
let vagent = document.querySelector('#voyage-agent')

// ROUTE
let routes = document.querySelectorAll('.route')

// FARE
let fares = document.querySelectorAll('.fare')

// SECTIONS
let sections = document.querySelectorAll('section')

// SECTION COUNTER
let currentItem = 0

// MODAL
let modal = document.querySelector('.modal')
let modalContent = document.querySelector('.modal-content')

// MODAL FORMs
let formVessel = document.querySelector('#vessel')
let formVoyageNumber = document.querySelector('#number')
let formDate = document.querySelector('#date')
let formAgent = document.querySelector('#ticketing-agent')
let formRoute = document.querySelector('#route')
let formFare = document.querySelector('#fare')

// MODAL BUTTONS
let edit = document.querySelector('#edit')

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

function checkVoyageDetailsValues() {
   if (vnumber.value &&
      year.value &&
      month.value &&
      day.value &&
      vagent.value) {
      let date = day.value + "-" + month.value + "-" + year.value
      formData['voyage'] = {
         'details': vnumber.value,
         'date': date,
         'agent': vagent.value
      }
      // next.click()
      next.style.visibility = 'visible'
   }
}

function insertValues(formData) {
   formVessel.value = formData['vessel']
   formVoyageNumber.value = formData['voyage'].details
   formDate.value = formData['voyage'].date
   formAgent.value = formData['voyage'].agent
   formRoute.value = formData['route']
   formFare.value = formData['fare']

   let confirmVessel = document.querySelector('#confirm-vessel')
   let confirmNumber = document.querySelector('#confirm-number')
   let confirmDate = document.querySelector('#confirm-date')
   let confirmAgent = document.querySelector('#confirm-agent')
   let confirmRoute = document.querySelector('#confirm-route')
   let confirmFare = document.querySelector('#confirm-fare')

   confirmVessel.innerHTML = formVessel.value
   confirmNumber.innerHTML = formVoyageNumber.value
   confirmDate.innerHTML = formDate.value
   confirmAgent.innerHTML = formAgent.value
   confirmRoute.innerHTML = formRoute.value
   confirmFare.innerHTML = formFare.value
}

// ATTACH PREVENT DEFAULT TO ALL BUTTONS 
buttons.forEach(function (button) {
   button.addEventListener('click', function (event) {
      event.preventDefault()
      this.classList.add('clicked')
   })
})

// FORM DATA FOR VOYAGE DETAILS
vnumber.addEventListener('focusout', function () {
   checkVoyageDetailsValues()
})
year.addEventListener('focusout', function () {
   checkVoyageDetailsValues()
})
month.addEventListener('focusout', function () {
   checkVoyageDetailsValues()
})
day.addEventListener('focusout', function () {
   checkVoyageDetailsValues()
})

vagent.addEventListener('focusin', function () {
   this.value = agentName
})
vagent.addEventListener('focusout', function () {
   checkVoyageDetailsValues()
})

// FORM DATA FOR VESSEL
vessels.forEach(function (vessel) {
   vessel.addEventListener('click', function (event) {
      vessels.forEach(function (vessel) {
         vessel.classList.remove('clicked')
      })
      this.classList.add('clicked')

      formData['vessel'] = event.target.value
      // next.click()
      next.style.visibility = 'visible'
   })
})

// FORM DATA FOR ROUTE
routes.forEach(function (route) {
   route.addEventListener('click', function (event) {
      routes.forEach(function (route) {
         route.classList.remove('clicked')
      })
      this.classList.add('clicked')

      formData['route'] = event.target.value
      // next.click()
      next.style.visibility = 'visible'
   })
})

// FORM DATA FOR FARE
fares.forEach(function (fare) {
   fare.addEventListener('click', function (event) {
      fares.forEach(function (fare) {
         fare.classList.remove('clicked')
      })
      this.classList.add('clicked')

      formData['fare'] = event.target.value
      // next.click()
      next.style.visibility = 'visible'
   })
})

back.addEventListener('mouseover', function () {
   sections[currentItem].classList.remove('originLeft')
   sections[currentItem].classList.add('originRight')
})

next.addEventListener('mouseover', function () {
   sections[currentItem].classList.remove('originRight')
   sections[currentItem].classList.add('originLeft')
})

back.addEventListener('click', function () {
   if (currentItem > 0) {
      let self = this
      // self.disabled = true
      sections[currentItem].classList.remove('originLeft')
      sections[currentItem].classList.add('originRight')
      sections[currentItem].classList.remove('reveal')

      currentItem--
      sections[currentItem].classList.add('originLeft')
      sections[currentItem].classList.add('reveal')

      setTimeout(function () {
         sections[currentItem].classList.remove('originLeft')
         sections[currentItem].classList.add('originRight')
         // self.disabled = false
      }, 800)
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

      setTimeout(function () {
         sections[currentItem].classList.remove('originRight')
         sections[currentItem].classList.add('originLeft')
      }, 800)
   }
   else {

      modal.classList.add('show')

      modalContent.classList.remove('animation-out')
      modalContent.classList.add('animation-in')

      insertValues(formData)
   }
   next.style.visibility = 'hidden'
})

edit.addEventListener('click', function (e) {

   e.preventDefault()

   modalContent.classList.remove('animation-in')
   modalContent.classList.add('animation-out')
})

modalContent.addEventListener('animationend', function () {
   if (modalContent.classList.contains('animation-out'))
      modal.classList.remove('show')
})