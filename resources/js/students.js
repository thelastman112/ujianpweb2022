import $ from 'jquery';

$('button#students_delete').each(function() {
    $(this).on('click', (e) => {
        const id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: `/students/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                console.log(response);
                $(e.target).closest('tr').remove();
            },
            error: (err) => {
                console.log(err.responseText);
            }
        });
    });
});

