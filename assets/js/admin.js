let buttons = document.querySelectorAll('.table')
let selected_table = document.querySelector('.selected-table');
let injection = document.querySelector('#injection')

buttons.forEach(function (button) {
   console.log(button)
   button.addEventListener('click', function (event) {
      let loader = document.createElement('div');
      loader.className = 'loader';
      selected_table.appendChild(loader);
      selected_table.style.userSelect = 'none';

      fetch('fetchTableData', {
         method: 'POST',
         headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
         },
         body: event.target.value
      })
         .then(res => res.text())
         .then(function (html) {
            injection.innerHTML = html
            selected_table.removeChild(loader)
            selected_table.style.userSelect = 'auto';
         })
         .catch(error => console.log(error))
   })
})