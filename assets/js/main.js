let formData = []

// ALL FORM BUTTONS 
let buttons = document.querySelectorAll('.form-btn')

// NAV BUTTONS 
let back = document.querySelector('#back')
let next = document.querySelector('#next')

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
let currentItem = 0;

// MODAL
let blur = document.querySelector('#blur')
let modal = document.querySelector('.modal')

// MODAL FORMs
let formVessel = document.querySelector('#vessel')
let formVoyageNumber = document.querySelector('#number')
let formDate = document.querySelector('#date')
let formAgent = document.querySelector('#ticketing-agent')
let formRoute = document.querySelector('#route')
let formFare = document.querySelector('#fare')

// MODAL BUTTONS
let edit = document.querySelector('#edit')

function checkVoyageDetailsValues() {
   if (vnumber.value &&
       year.value && 
       month.value &&
       day.value &&
       vagent.value) {
          let date = month.value + "|" + day.value + "|" + year.value
          formData['voyage'] ={
             'details': vnumber.value,
             'date': date,
             'agent': vagent.value
          }
          next.click()
      }
}

function insertValues(formData) {
   formVessel.value = formData['vessel']
   formVoyageNumber.value = formData['voyage']['details']
   formDate.value = formData['voyage']['date']
   formAgent.value = formData['voyage']['agent']
   formRoute.value = formData['route']
   formFare.value = formData['fare']
}

// ATTACH PREVENT DEFAULT TO ALL BUTTONS 
buttons.forEach(function (button) {
   button.addEventListener('click', function (event) {
      event.preventDefault()
      this.classList.add('clicked')
   })
})

// FORM DATA FOR VOYAGE DETAILS
vnumber.addEventListener('focusout', function(){
   checkVoyageDetailsValues()
})
year.addEventListener('focusout', function() {
   checkVoyageDetailsValues()
})
month.addEventListener('focusout', function(){
   checkVoyageDetailsValues()
})
day.addEventListener('focusout', function(){
   checkVoyageDetailsValues()
})
vagent.addEventListener('focusout', function(){
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
      console.info(formData)
      next.click()
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
      console.info(formData)
      next.click()
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
      console.info(formData)
      next.click()
   })
})

back.addEventListener('mouseover', function() {
   sections[currentItem].classList.remove('originLeft')
   sections[currentItem].classList.add('originRight')
})

next.addEventListener('mouseover', function() {
   sections[currentItem].classList.remove('originRight')
   sections[currentItem].classList.add('originLeft')
})

back.addEventListener('click', function () {
   if (currentItem > 0) {
      let self = this;
      // self.disabled = true;
      sections[currentItem].classList.remove('originLeft')
      sections[currentItem].classList.add('originRight')
      sections[currentItem].classList.remove('reveal')

      currentItem--
      sections[currentItem].classList.add('originLeft')
      sections[currentItem].classList.add('reveal')
      
      setTimeout(function() {
         sections[currentItem].classList.remove('originLeft')
         sections[currentItem].classList.add('originRight')
         // self.disabled = false;
      }, 800)
   }
})

next.addEventListener('click', function () {
   if (currentItem < 3) {
      let self = this;
      // self.disabled = true;
      sections[currentItem].classList.remove('originRight')
      sections[currentItem].classList.add('originLeft')
      sections[currentItem].classList.remove('reveal')

      currentItem++
      sections[currentItem].classList.add('originRight')
      sections[currentItem].classList.add('reveal')

      setTimeout(function() {
         sections[currentItem].classList.remove('originRight')
         sections[currentItem].classList.add('originLeft')
         // self.disabled = false;
      }, 800)
   }
   else {
      blur.classList.add('blur')

      modal.classList.remove('animation-out')
      modal.classList.add('animation-in')

      insertValues(formData)
   }
})

edit.addEventListener('click', function(e) {

   e.preventDefault();

   blur.classList.remove('blur')

   modal.classList.remove('animation-in')
   modal.classList.add('animation-out')
})