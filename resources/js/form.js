window.app = () => {
    return {
        form: document.getElementById('form'),

        test(el) {
            console.log('hello')

            form.scrollTop > 0 ? el.classList.add('w-full') : el.classList.remove('w-full')
        },

        test2(el) {
            console.log('hello')

            form.scrollTop !== form.scrollTopMax ? el.classList.add('w-full') : el.classList.remove('w-full')
        },

        scrollFunc(ev) {


            if (ev.target.scrollTop > 0) {
                document.getElementById('bg-top').classList.add('w-full')
            } else {
                document.getElementById('bg-top').classList.remove('w-full')
            }
            if (ev.target.scrollTop !== ev.target.scrollTopMax) {
                document.getElementById('bg-bottom').classList.add('w-full')
            } else {
                document.getElementById('bg-bottom').classList.remove('w-full')
            }



            if (ev.target.scrollTop >= ev.target.scrollTopMax) {
                window.livewire.emit('load_more_comments');
            };
        },
    }
}




