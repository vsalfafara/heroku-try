
let vessel
let monthValue = 0;
let yearValue = 0;

const button = document.querySelectorAll('.vessel')

button.forEach(value => value.addEventListener('click', function (e) {
   console.log(e.target.value)
}))

let month = document.querySelector('#month');

month.addEventListener('change', function (e) {
   monthValue = parseInt(e.target.value)
   checkChangeValue()
})

let year = document.querySelector('#year');

year.addEventListener('change', function (e) {
   yearValue = parseInt(e.target.value)
   checkChangeValue()
})

var checkChangeValue = function () {
   if (monthValue && yearValue) {
      let dayValue = getDaysInMonth(monthValue, yearValue)
      let day = document.querySelector('#day')

      while (day.firstChild) {
         day.firstChild.remove();
      }

      createOption(day, "disabled", false, "Day")

      for (i = 1; i <= dayValue; i++) {
         createOption(day, "value", i, i)
      }
   }
}

var getDaysInMonth = function (month, year) {
   return new Date(year, month, 0).getDate();
};

var createOption = function (tag, attribute, value, text) {
   var x = document.createElement("OPTION");
   x.setAttribute(attribute, value);
   var t = document.createTextNode(text);
   x.appendChild(t);
   tag.appendChild(x)
}