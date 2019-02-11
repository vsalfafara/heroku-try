let buttons = document.querySelectorAll('.table')
let selected_table = document.querySelector('.selected-table')
let injection = document.querySelector('#injection')
let loader = document.createElement('div')

function showLoader(){
   loader.className = 'loader'
   selected_table.appendChild(loader)
   selected_table.style.userSelect = 'none'
}

function hideLoader() {
   selected_table.removeChild(loader)
   selected_table.style.userSelect = 'auto'
}

let checkColumns = function () {
   let columns = document.querySelectorAll('.table-text-search')
   columns.forEach(function (input) {
      input.addEventListener('keyup', function (e) {
         if (e.keyCode === 13) {
            showLoader()

            let formData = new FormData()
            table_hidden = document.querySelector('#table-name')

            formData.append('table', table_hidden.value)
            formData.append('column', this.name)
            formData.append('searchTerm', e.target.value)

            fetch('filterTable', {
               method: 'POST',
               body: formData
            })
               .then(res => res.text())
               .then(function(html) {
                  let filter = document.querySelector('#filter')
                  let children = document.querySelectorAll('#filter >tr:not(#search-row)')
                  console.log(html)
                  children.forEach(child => child.parentNode.removeChild(child))
                  filter.insertAdjacentHTML('beforeend', html)
                  hideLoader()
               })
               .catch(error => console.log(error))
         }
      })
   })
}

buttons.forEach(function (button) {
   button.addEventListener('click', function (event) {
      showLoader()

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
            hideLoader()
            checkColumns()
         })
         .catch(error => console.log(error))
   })
})

// let search = document.querySelector('#search')

// search.addEventListener('keyup', function (e) {
//    if (table_hidden = document.querySelector('#table-name')) {
//       if (e.keyCode === 13) {
//          fetch('filterTable', {
//             method: 'POST',
//             body: table_hidden.value
//          })
//             .then(res => res.json())
//             .then(data => console.log(data))
//             .catch(error => console.log(error))
//       }
//    }
// })