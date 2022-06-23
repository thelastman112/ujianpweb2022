import $ from 'jquery';
import swal from 'sweetalert';

if (window.location.pathname === '/home') {
    const editBtn = $('button#edit');
    const saveBtn = $('button#save');
    const cancelBtn = $('button#cancel');
    const role = $('input[name="role"]').val()
    console.log(role);

    const editform = $('#editform');

    editBtn.on('click', e => {
        e.preventDefault();
        editform.find('input').prop('readonly', false);
        editform.find('input').removeClass('form-control-plaintext');
        editform.find('input').addClass('form-control');
        editBtn.toggle();
        saveBtn.toggle();
        cancelBtn.toggle();
    });

    editform.on('submit', async e => {
        e.preventDefault();
        editform.find('input').prop('readonly', true);
        editform.find('input').removeClass('form-control');
        editform.find('input').addClass('form-control-plaintext');
        editBtn.toggle();
        saveBtn.toggle();
        cancelBtn.toggle();

        const data = {
            id: editform.find('input[name="id"]').val(),
            user_id: editform.find('input[name="user_id"]').val(),
            name: editform.find('input[name="name"]').val(),
            username: editform.find('input[name="username"]').val(),
            nim: editform.find('input[name="nim"]').val(),
            email: editform.find('input[name="email"]').val(),
            phone: editform.find('input[name="phone"]').val(),
            address: editform.find('input[name="address"]').val(),
            birth_date: editform.find('input[name="birth_date"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PUT',
        };
        console.log(data);

        const result = await fetch('/home', {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(res => res.json())
        .then(res => {
            if (res.status === 'success') {
                swal('Success', res.message, 'success');
            } else {
                swal('Error', res.message, 'error');
            }
        })
        .catch(err => {
            console.log(err);
            swal('Error', 'Something went wrong', 'error');
        });

        console.log(result);
    });



    cancelBtn.on('click', e => {
        e.preventDefault();
        editform.find('input').prop('readonly', true);
        editform.find('input').removeClass('form-control');
        editform.find('input').addClass('form-control-plaintext');
        editBtn.toggle();
        saveBtn.toggle();
        cancelBtn.toggle();
    });
}

// Suggestion2
// add any script for support your page
