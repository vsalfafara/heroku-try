const vessel = document.querySelector('#vessel')
const voyage = document.querySelector('#voyage')
const date = document.querySelector('#date')
const create_report = document.querySelector('#create-report')
const report = document.querySelector('#report')

vessel.addEventListener('change', function () {
   fetchOptions('vessel_gid', this.value, 'ajaxvoyage', voyage)
})

voyage.addEventListener('change', function () {
   fetchOptions('voyage_num', this.value, 'ajaxdate', date)
})

function fetchOptions(post, value, target, element) {
   let form = new FormData
   form.append(post, value)

   fetch(target, {
      method: 'post',
      body: form
   })
      .then(res => res.text())
      .then(data => element.innerHTML = data)
}

create_report.addEventListener('click', function () {

   if (vessel.value && voyage.value && date.value) {
      let form = new FormData
      form.append("vessel_gid", vessel.value)
      form.append("voyage_num", voyage.value)
      form.append("voyage_date", date.value)

      fetch('ajaxreport', {
         method: 'post',
         body: form
      })
         .then(r => r.text())
         .then(function (data) {
            let report = document.querySelector('#report')

            while (report.firstChild)
               report.removeChild(report.firstChild)

            report.innerHTML = data
         })
   }
})