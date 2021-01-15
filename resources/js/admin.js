/**
 * Redirects the page
 */
window.redirectPage = function (redirect_url) {
    if (redirect_url) {
        if (redirect_url.indexOf('#') === 0) {
            window.location.hash = redirect_url;
            window.location.reload();
        } else {
            window.location.replace(redirect_url);
        }
    } else {
        window.location.reload();
    }
};

$(document).ready(function () {
    console.log('Bruh.');

    // check all boxes when select all clicked
    $('input[type="checkbox"][data-all]').on('change', function (e) {
        e.preventDefault();
        var select_all_name = $(this).data('all');
        var is_checked = $(this).prop('checked');
        $('input[type="checkbox"][data-check="' + select_all_name + '"]').each(function () {
            $(this).prop('checked', is_checked);
        });
    });

    // uncheck select all when one box unchecked
    $('input[type="checkbox"][data-check]').on('change', function (e) {
        e.preventDefault();
        var is_checked = $(this).prop('checked');
        if (!is_checked) {
            var select_all_name = $(this).data('check');
            var select_all = $('input[type="checkbox"][data-all="' + select_all_name + '"]');
            if (select_all) {
                select_all.prop('checked', false);
            }
        }
    });

    //Iniate Select2 Plugin
    $('.select2-basic').select2({
        theme: 'bootstrap4',
    });

    // Index sort
    $('[data-sort-field]').click(function (e) {
        e.preventDefault();

        //find the parent form
        var parent_form_selector = $(this).closest('[data-form-sortable]').data('form-sortable');
        var parent_form = $('form' + parent_form_selector);
        if (parent_form) {

            var field = $(this).data('sort-field');
            var order = $(this).find('i').hasClass('fa-chevron-down') ? 'ASC' : 'DESC';

            parent_form.find('[name="orderby"]').val(field);
            parent_form.find('[name="order"]').val(order);
            parent_form.submit();
        }
    });

    // delete record
    $('.delete-link').click(function (e) {
        e.preventDefault();

        var request_url = $(this).data('request-url');
        var redirect_url = $(this).data('redirect-url');

        swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to undo this delete operation!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then(function (result) {
            if (result.value) {
                axios.delete(request_url)
                    .then(function (response) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'The record has been deleted',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(
                            function () {
                                redirectPage(redirect_url);
                            }
                        );
                    })
                    .catch(function (error) {
                        console.log(error.response.data);
                        var message = error.response.data.message;
                        swal.fire({
                            title: 'Error!',
                            text:  message || 'An error occurred while deleting',
                            icon: 'error',
                        });
                    })
            }
        });
    });
});
