const clicking = e => {
    if (e.target.classList.contains('showDetail')) {
        const id = e.target.closest('tr').querySelector('td:first-child').innerText
        e.preventDefault()
        const xhr = new XMLHttpRequest()
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.querySelector('.userstable .detail_error').classList.remove('active')
                const response = JSON.parse(xhr.response)
                const detailDIV = document.querySelector('.userstable .detail_info')
                const address = response.address.city + ',' + response.address.street + ' ' + response.address.suite + ' ' + response.address.zipcode
                const coordinate = response.address.geo.lat + ',' + response.address.geo.lng
                detailDIV.querySelector('.detail_info__id span').innerHTML = response.id
                detailDIV.querySelector('.detail_info__name span').innerHTML = response.name
                detailDIV.querySelector('.detail_info__username span').innerHTML = response.username
                detailDIV.querySelector('.detail_info__email span').innerHTML = response.username
                detailDIV.querySelector('.detail_info__address span').innerHTML = address
                detailDIV.querySelector('.detail_info__latlng span').innerHTML = coordinate
                detailDIV.querySelector('.detail_info__phone span').innerHTML = response.phone
                detailDIV.querySelector('.detail_info__website span').innerHTML = response.website
                detailDIV.querySelector('.detail_info__company span').innerHTML = response.company.name
                detailDIV.querySelector('.detail_info__company-phrase span').innerHTML = response.company.catchPhrase
                detailDIV.querySelector('.detail_info__company-bs span').innerHTML = response.company.bs
            } else if (xhr.readyState === 4) {
                const detailError = document.querySelector('.userstable .detail_error')
                detailError.classList.add('active')
                detailError.innerHTML = "Ошибка получения данных"
            }
        }
        xhr.open('GET', 'https://jsonplaceholder.typicode.com/users/' + id);
        xhr.send()
    }
}

document.querySelector('.userstable').addEventListener('click', clicking)