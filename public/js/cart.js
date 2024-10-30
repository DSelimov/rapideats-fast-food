document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.add-to-cart-form');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const url = this.action;
            const formData = new FormData(this);

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const message = this.nextElementSibling;
                        message.classList.remove('hidden');
                        message.textContent = 'Pizza added to cart!';

                        setTimeout(() => {
                            message.classList.add('hidden');
                        }, 3000);
                    } else {
                        alert('Failed to add item to cart. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
});
