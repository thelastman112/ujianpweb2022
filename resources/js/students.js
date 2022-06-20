import $ from 'jquery';
import swal from 'sweetalert';

$('button#students_delete').each(function() {
    $(this).on('click', async (e) => {
        const id = $(this).data('id');
        // $.ajax({
        //     url: `/students/${id}`,
        //     type: 'DELETE',
        //     data: {
        //         _token: $('meta[name="csrf-token"]').attr('content')
        //     },
        //     success: (response) => {
        //         $(e.target).closest('tr').remove();
        //     },
        //     error: (err) => {
        //         console.log(err.responseText);
        //     }
        // });

        // await fetch(`/students/${id}`, {
        //     method: 'DELETE',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     body: {
        //         _token: $('meta[name="csrf-token"]').attr('content')
        //     }
        // }).then(response => {
        //     if (response.status === 200) {
        //         $(e.target).closest('tr').remove();
        //     }
        // }).catch(err => {
        //     console.log(err.responseText);
        // });

        // using xhr
        const xhr = new XMLHttpRequest();
        xhr.open('DELETE', `/students/${id}`);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.onload = () => {
            if (xhr.status === 200) {
                $(e.target).closest('tr').remove();
                swal('Success', 'Student deleted successfully', 'success');
            }
        }
        xhr.send({
            _token: $('meta[name="csrf-token"]').attr('content')
        });
    });
});

const editToggle = $('button[data-bs-target="#editModal"]');
editToggle.each(function() {
    $(this).on('click', async e => {
        // $('input[name="name"]').val()
        const dataId = e.target.getAttribute('data-id');
        console.log(dataId);
        // fetch(`/students/${dataId}/edit`)

        const data = await new Promise((resolve, reject) => {
            fetch(`/students/${dataId}/edit`)
                .then(response => {
                    if (response.status === 200) {
                        return response.json();
                    }
                    reject(response.status);
                })
                .then(data => {
                    resolve(data);
                })
                .catch(err => {
                    reject(err);
                });
        }).catch(err => {
            console.log(err);
        });

        const editModal = document.getElementById('editModal');
        editModal.querySelector('input[name="nim"]').value = data.nim;
        editModal.querySelector('input[name="phone"]').value = data.phone;
        editModal.querySelector('input[name="address"]').value = data.address;
        editModal.querySelector('input[name="birth_date"]').value = data.birth_date;

        editModal.addEventListener('hide.bs.modal', e => {
            e.target.querySelector('form').reset();
        });
    });
});

$('#addStudentForm #isRegistered').on('change', e => {
    const userId = $('#addStudentForm #userId');
    const name = $('#addStudentForm #name');
    if (e.target.checked) {
        userId.attr('disabled', false);
        name.attr('disabled', true);
    } else {
        userId.attr('disabled', true);
        name.attr('disabled', false);
    }
});
