document.querySelectorAll(".edit")
    .forEach(function (el) {
        el.addEventListener("click", function () {
            console.log(this.getAttribute('data-id'));
        })
    });