import $ from 'jquery';
import swal from 'sweetalert';

if (window.location.pathname === '/home') {
    const editBtn = $('button#edit');
    const saveBtn = $('button#save');
    const cancelBtn = $('button#cancel');
    const role = $('input[name="role"]').val()
    console.log(role);

<<<<<<< HEAD
    const editform = $('#editform');

    editBtn.on('click', e => {
        e.preventDefault();
        editform.find('input').prop('readonly', false);
        editform.find('input').removeClass('form-control-plaintext');
        editform.find('input').addClass('form-control');
=======
    const formAccount = $('form#putAccount');

    editBtn.on('click', e => {
        e.preventDefault();
        formAccount.find('input').prop('readonly', false);
        formAccount.find('input').removeClass('form-control-plaintext');
        formAccount.find('input').addClass('form-control');
>>>>>>> bd358fd3b06aa281ce952d817da5082e6790f06a
        editBtn.toggle();
        saveBtn.toggle();
        cancelBtn.toggle();
    });

<<<<<<< HEAD
    editform.on('submit', async e => {
        e.preventDefault();
        editform.find('input').prop('readonly', true);
        editform.find('input').removeClass('form-control');
        editform.find('input').addClass('form-control-plaintext');
=======
    formAccount.on('submit', async e => {
        e.preventDefault();
        formAccount.find('input').prop('readonly', true);
        formAccount.find('input').removeClass('form-control');
        formAccount.find('input').addClass('form-control-plaintext');
>>>>>>> bd358fd3b06aa281ce952d817da5082e6790f06a
        editBtn.toggle();
        saveBtn.toggle();
        cancelBtn.toggle();

        const data = {
<<<<<<< HEAD
            id: editform.find('input[name="id"]').val(),
            user_id: editform.find('input[name="user_id"]').val(),
            name: editform.find('input[name="name"]').val(),
            username: editform.find('input[name="username"]').val(),
            nim: editform.find('input[name="nim"]').val(),
            email: editform.find('input[name="email"]').val(),
            phone: editform.find('input[name="phone"]').val(),
            address: editform.find('input[name="address"]').val(),
            birth_date: editform.find('input[name="birth_date"]').val(),
=======
            id: formAccount.find('input[name="id"]').val(),
            user_id: formAccount.find('input[name="user_id"]').val(),
            name: formAccount.find('input[name="name"]').val(),
            username: formAccount.find('input[name="username"]').val(),
            nim: formAccount.find('input[name="nim"]').val(),
            email: formAccount.find('input[name="email"]').val(),
            phone: formAccount.find('input[name="phone"]').val(),
            address: formAccount.find('input[name="address"]').val(),
            birth_date: formAccount.find('input[name="birth_date"]').val(),
>>>>>>> bd358fd3b06aa281ce952d817da5082e6790f06a
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
<<<<<<< HEAD
        editform.find('input').prop('readonly', true);
        editform.find('input').removeClass('form-control');
        editform.find('input').addClass('form-control-plaintext');
=======
        formAccount.find('input').prop('readonly', true);
        formAccount.find('input').removeClass('form-control');
        formAccount.find('input').addClass('form-control-plaintext');
>>>>>>> bd358fd3b06aa281ce952d817da5082e6790f06a
        editBtn.toggle();
        saveBtn.toggle();
        cancelBtn.toggle();
    });
}

// Suggestion2
// add any script for support your page
const formPassword = $('form#changePassword');

// formPassword.on('submit', async e=>{
//     e.preventDefault();

//     const data = {
//         email: formPassword.find('input[name="email"]').val(),
//         user_id: formPassword.find('input[name="user_id"]').val(),
//         old_password: formPassword.find('input[name="old_password"]').val(),
//         new_password: formPassword.find('input[name="new_password"]').val(),
//         repeat_new_password: formPassword.find('input[name="repeat_new_password"]').val(),
//         _token: $('meta[name="csrf-token"]').attr('content'),
//         _method: 'PUT',
//     }

//     if (data.new_password != data.repeat_new_password){
//         swal('Error', 'The passwords is not match', 'error');
//         return;
//     }

//     const result = await new Promise((resolve, reject) => {
//         fetch('/', {
//             method: 'PUT',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             body: JSON.stringify(data)
//         }).then(response => {
//             if (response.status === 200) {
//                 resolve(response.json());
//             } else {
//                 reject(response.status);
//             }
//         }).catch(err => {
//             reject(err);
//         });
//     });
//     console.log(result);
// });

formPassword.on('keyup', (e)=>{
    e.preventDefault();

    const data = {
        // old_password: formAccount.find('input[name="old_password"]').val(),
        new_password: formPassword.find('input[name="new_password"]').val(),
        repeat_new_password: formPassword.find('input[name="repeat_new_password"]').val(),
        _token: $('meta[name="csrf-token"]').attr('content'),
        _method: 'PUT',
    };

    if (data.new_password != data.repeat_new_password){
        console.log('is not match');
        $(e.target).find('button').attr('disabled', true);
    } else {
        console.log('is match');
        $(e.target).find('button').attr('disabled', false);
    }
});
