document.addEventListener('click', (e) => {
    const target = e.target.closest('.link-to-profile')

    if(target){
        const id = target.dataset.id
        window.location.href = `/profile/${id}`
    }
})

document.addEventListener('click', (e) => {
    const target = e.target.closest('.link-to-ver')

    if(target){
        const id = target.dataset.id
        window.location.href = `/ver/${id}`
    }
})
