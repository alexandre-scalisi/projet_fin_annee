window.app = function () {
    return {
        form: document.getElementById("form"),
        test: function (t) {
            form.scrollTop > 0 ? t.classList.remove("hidden") : t.classList.add("hidden")
        },
        test2: function (t) {
            t.scrollTop !== t.scrollHeight - t.clientHeight ? t.classList.remove("hidden") : t.classList.add("hidden")
        },
        scrollFunc: function (t) {
            t.target.scrollTop > 0 ? document.getElementById("bg-top").classList.remove("hidden") : document.getElementById("bg-top").classList.add("hidden"), t.target.scrollTop !== t.target.scrollTopMax ? document.getElementById("bg-bottom").classList.remove("hidden") : document.getElementById("bg-bottom").classList.add("hidden");
            var e = t.target.scrollHeight - t.target.clientHeight;
            t.target.scrollTop >= e && (document.getElementById("bg-bottom").classList.add("hidden"), window.livewire.emit("load_more_comments"))
        }
    }
};
