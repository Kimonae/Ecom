document.addEventListener("DOMContentLoaded", function () {

    if (typeof openUpdateModal !== "undefined" && openUpdateModal) {

        const modalElement = document.getElementById('addProductModal');

        if (modalElement) {
            const myModal = new bootstrap.Modal(modalElement);
            myModal.show();
        }
    }

});