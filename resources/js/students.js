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
        editModal.querySelector('input[name="name"]').value = data.name;
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

$('form#addStudentForm').on('submit', async e => {
    e.preventDefault()
    const data = $(e.target).serializeArray();

    // map data to object
    const dataObj = data.reduce((acc, cur) => {
        acc[cur.name] = cur.value;
        return acc;
    });

    dataObj._token = $('meta[name="csrf-token"]').attr('content');
    // remove dataObj.value
    delete dataObj.value;

    // console.log(dataObj);

    const result = await new Promise((resolve, reject) => {
        fetch('/students', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(dataObj)
        }).then(response => {
            if (response.status === 201) {
                resolve(response.json());
            } else {
                reject(response.status);
            }
        }).catch(err => {
            reject(err);
        });
    });

    console.log(result);

    if (result.status === 'success') {
        const formToggle = $('button[data-bs-target="#collapseAddStudent"]');

        formToggle.trigger('click');

        swal('Success', 'Student added successfully', 'success');
        $('#addStudentForm').trigger('reset');
        $('#addStudentForm #isRegistered').prop('checked', false);
        $('#addStudentForm #userId').attr('disabled', true);
        $('#addStudentForm #name').attr('disabled', false);

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${result.data.name}</td>
            <td>${result.data.nim}</td>
            <td>${result.data.address}</td>
            <td>${result.data.phone}</td>
            <td>${result.data.birth_date}</td>
            <td>
                <button class="btn btn-warning btn-sm" data-id="${result.data.id}" data-bs-target="#editModal" data-toggle="modal">Edit</button>
                <button class="btn btn-danger btn-sm" data-id="${result.data.id}" data-bs-target="#deleteModal" data-toggle="modal">Delete</button>
            </td>
        `;
        $('#studentTable tbody').prepend(row);
    }
});
