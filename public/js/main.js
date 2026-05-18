document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('.text-red');

    deleteLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            if (!confirm('Are you sure you want to delete this item?')) {
                event.preventDefault();
            }
        });
    });
});
