Livewire.on('scrollToComment', id => {
    setTimeout(() => {
    const el = document.getElementById(id).getElementsByClassName('comment')[document.getElementById(id).getElementsByClassName('comment').length-1]
    form.scrollTo({
    top: el.offsetTop - 400,
    behavior: 'smooth'
    })
    }, 50);
});



Livewire.on('scrollTop', () => {
    form.scrollTo({
    top: 0,
    behavior: 'smooth'
    })
})
