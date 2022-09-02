let params = new URLSearchParams(window.location.search);
if (document.getElementById('floatingModalSignature').value) {
    window.addEventListener('load', function () {
        let myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
        myModal.show();
    });
}

if (document.getElementById('exampleModalToggleEdit')) {
    const exampleModal = document.getElementById('exampleModalToggleEdit');
    exampleModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const sign = button.getAttribute('data-bs-sign');
        const url = button.getAttribute('data-bs-url');

        const link_id = button.getAttribute('data-bs-id_link');
        const material_id = button.getAttribute('data-bs-id_material');

        const modalSign = exampleModal.querySelector('#floatingModalSignatureEdit');
        const modalURL = exampleModal.querySelector('#floatingModalLinkEdit');

        const m_id = exampleModal.querySelector('#material_id');
        const l_id = exampleModal.querySelector('#link_id');

        modalSign.value = sign;
        modalURL.value = url;

        m_id.value = material_id;
        l_id.value = link_id;
    })
}