document.addEventListener('DOMContentLoaded', function () {
    // Order view
    const orderBtn = document.getElementById('orderSearchToggleBtn');
    const orderForm = document.getElementById('orderSearchForm');
    if (orderBtn && orderForm) {
        orderBtn.addEventListener('click', function () {
            orderForm.classList.toggle('hidden');
        });
    }

    // Machine view
    const machineBtn = document.getElementById('machineSearchToggleBtn');
    const machineForm = document.getElementById('machineSearchForm');
    if (machineBtn && machineForm) {
        machineBtn.addEventListener('click', function () {
            machineForm.classList.toggle('hidden');
        });
    }

    // Mall view
    const mallBtn = document.getElementById('mallSearchToggleBtn');
    const mallForm = document.getElementById('mallSearchForm');
    if (mallBtn && mallForm) {
        mallBtn.addEventListener('click', function () {
            mallForm.classList.toggle('hidden');
        });
    }
});
