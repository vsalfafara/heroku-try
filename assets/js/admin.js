let buttons = document.querySelectorAll('.table')
let selected_table = document.querySelector('.selected-table')
let injection = document.querySelector('#injection')

let checkColumns = function () {
   let columns = document.querySelectorAll('.table-text-search')
   columns.forEach(function (input) {
      input.addEventListener('keyup', function (e) {
         if (e.keyCode === 13) {
            let formData = new FormData()
            table_hidden = document.querySelector('#table-name')

            formData.append('table', table_hidden.value)
            formData.append('searchTerm', e.target.value)

            fetch('filterTable', {
               method: 'POST',
               body: formData
            })
               .then(res => res.json())
               .then(data => console.log(data))
               .catch(error => console.log(error))
         }
      })
   })
}

buttons.forEach(function (button) {
   button.addEventListener('click', function (event) {
      let loader = document.createElement('div')
      loader.className = 'loader'
      selected_table.appendChild(loader)
      selected_table.style.userSelect = 'none'

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
            selected_table.style.userSelect = 'auto'
            checkColumns()
         })
         .catch(error => console.log(error))
   })
})

let search = document.querySelector('#search')

search.addEventListener('keyup', function (e) {
   if (table_hidden = document.querySelector('#table-name')) {
      if (e.keyCode === 13) {
         fetch('filterTable', {
            method: 'POST',
            body: table_hidden.value
         })
            .then(res => res.json())
            .then(data => console.log(data))
            .catch(error => console.log(error))
      }
   }
})