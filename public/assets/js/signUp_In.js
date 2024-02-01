const form_item = document.getElementById('form-item');
function show(id) {
    var thisMenu = document.getElementById(`${id}`);
    if (!thisMenu.classList.contains('.form-active')) {
        const activeMenu = form_item.querySelector('.form-active');
        activeMenu.classList.remove('form-active');
        thisMenu.classList.add('form-active');
        $.ajax({
            type: "GET",
            url: thisMenu.getAttribute('data-bs-value'),
            success: function (response) {
                const form = document.getElementById('form-layout');
                form.innerHTML = response;
            }
        });
    }
}