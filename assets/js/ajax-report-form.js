const vessel = document.querySelector('#vessel')
const voyage = document.querySelector('#voyage')
const date = document.querySelector('#date')
const create_report = document.querySelector('#create-report')
const generate_pdf = document.querySelector('#generate-pdf')
const report = document.querySelector('#report')

vessel.addEventListener('change', function () {
	fetchOptions('vessel_gid', this.value, 'ajaxvoyage', voyage)
})

voyage.addEventListener('change', function () {
	fetchOptions('voyage_num', this.value, 'ajaxdate', date)
})

function fetchOptions(post, value, target, element) {
	let form = new FormData()
	form.append(post, value)

	fetch(target, {
		method: 'post',
		body: form
	})
		.then((res) => res.text())
		.then((data) => (element.innerHTML = data))
}

create_report.addEventListener('click', function (e) {
	e.preventDefault()
	if (vessel.value && voyage.value && date.value) {
		let form = new FormData()
		form.append('vessel_gid', vessel.value)
		form.append('voyage_num', voyage.value)
		form.append('voyage_date', date.value)

		fetch('ajaxreport', {
			method: 'post',
			body: form
		})
			.then((r) => r.text())
			.then(function (data) {
				let report = document.querySelector('#report')

				while (report.firstChild)
					report.removeChild(report.firstChild)

				report.innerHTML = data
			})
	}
})

generate_pdf.addEventListener('click', function () {
	let form = document.createElement("form");
	form.setAttribute("method", 'post');
	form.setAttribute("action", base_url + 'pdfgen/generatereport');
	form.setAttribute("target", '_blank');

	let data = []
	data['vessel_gid'] = vessel.value
	data['voyage_num'] = voyage.value
	data['voyage_date'] = date.value

	for (var key in data) {
		var hiddenField = document.createElement("input");
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", key);
		hiddenField.setAttribute("value", data[key]);
		form.appendChild(hiddenField);
	}

	document.body.appendChild(form);
	form.submit()
})
