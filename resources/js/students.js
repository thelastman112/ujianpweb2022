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

