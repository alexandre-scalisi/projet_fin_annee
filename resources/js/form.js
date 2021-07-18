window.app = () => {
    return {
        form: document.getElementById('form'),

        test(el) {
            form.scrollTop > 0 ? el.classList.remove('hidden') : el.classList.add('hidden')
        },

        test2(el) {
            console.log(form)
            el.scrollTop !== (el.scrollHeight - el.clientHeight) ? el.classList.remove('hidden') : el.classList.add('hidden')
        },

        scrollFunc(ev) {


            if (ev.target.scrollTop > 0) {
                document.getElementById('bg-top').classList.remove('hidden')
            } else {
                document.getElementById('bg-top').classList.add('hidden')
                console.log('test')
            }
            if (ev.target.scrollTop !== ev.target.scrollTopMax) {
                document.getElementById('bg-bottom').classList.remove('hidden')
            } else {
                document.getElementById('bg-bottom').classList.add('hidden')
            }
            
            
            const maxScroll = ev.target.scrollHeight - ev.target.clientHeight;
            
            if (ev.target.scrollTop >= maxScroll) {
                document.getElementById('bg-bottom').classList.add('hidden')
                window.livewire.emit('load_more_comments');

            };
        },
    }
}




