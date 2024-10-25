
    $(document).ready(function() {
        // Tmeout to fade out the message after 5 seconds
        setTimeout(function() {
            $('#success-message').fadeOut('slow');
        }, 5000);


        // password change box hide/show
        // Initially hide the password fields
        $('#password_row').hide();

        // Toggle password fields based on checkbox status
        $('#password_change').change(function() {
            if($(this).is(':checked')) {
                $('#password_row').show();
            } else {
                $('#password_row').hide();
                // $('#password').val('');
                // $('#repeatPassword').val('');
            }
        });


        // reusable delete modal
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget); // Button that triggered the modal
            let entity_title = button.data('title'); // Extract the title
            let actionUrl = button.data('url');

            let modal = $(this);
            modal.find('#delete-confirm').text(entity_title);
            modal.find('#delete-entity-form').attr('action', actionUrl);

        });


        // reusable restore modal
        $('#restoreModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget); // Button that triggered the modal
            let entity_title = button.data('title'); // Extract the title
            let actionUrl = button.data('url');  // form action

            let modal = $(this);
            modal.find('#restore-confirm').text(entity_title);
            modal.find('#restore-entity-form').attr('action', actionUrl);
        });
    });