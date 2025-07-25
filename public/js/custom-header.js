document.addEventListener('DOMContentLoaded', function() {
    var dropdownElement = document.querySelector('.nav-item.dropdown');
    if (dropdownElement) {
        dropdownElement.addEventListener('mouseenter', function() {
            var dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.add('show');
            }
        });
        dropdownElement.addEventListener('mouseleave', function() {
            var dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});