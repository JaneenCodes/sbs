$(function() {

    $(document).on('click', '.create-btn', function() {
        let domainUrl = window.location.origin; 

        $('#create-form').attr('action', domainUrl + '/bookings/store');
        $('#create-modal').modal('show');    
    });

    $(document).on('click', '.edit-btn', function () {
        let bookingId = $(this).attr('data-id'),
            bookingName = $(this).attr('data-name'),
            bookingType = $(this).attr('data-type'),
            bookingDescription = $(this).attr('data-description'),
            domainUrl = window.location.origin;

            $('#edit-form').attr('action', domainUrl +'/bookings/' + bookingId+ '/update')

            $('#edit-modal').find('#name').val(bookingName);
            $('#edit-modal').find('#type').val(bookingType);
            $('#edit-modal').find('#description').val(bookingDescription);

            $('#edit-modal').modal('show');
    });
   
    $(document).on('click', '.request-btn', function() {
        let bookingId = $(this).attr('data-id');
            domain = window.location.origin; 

        console.log(bookingId);
        $('#request-form').attr('action', domain + '/appointments/' + bookingId + '/store');   
        $('#request-modal').modal('show');    
    });
   
    $('#request-form').on('submit', function(e) {
        e.preventDefault();
    
        let name = $('#request-form').find('#name').val(),
            contact = $('#request-form').find('#contact').val(),
            address = $('#request-form').find('#address').val(),
            borrowed_at = $('#request-form').find('#borrowed_at').val(),
            returned_at = $('#request-form').find('#returned_at').val();

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: {name, contact, address, borrowed_at, returned_at},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() 
            {              
                $('#request-modal').modal('hide');
                window.location.href=domain + '/appointments';                                    
            },error: function(xhr, status, error) 
                {
                    let oData = xhr.responseJSON.errors,
                        html = '';

                        for (let i in oData) {
                            let element = oData[i];
                            html += '<li>' + element[0] + '</li>';                 
                        }    

                        $('#request-modal').find('.error-messages').prop('hidden', false);  
                        $('#request-modal').find('.error-messages').html(html);                    
                }                
        });
    });

    $(document).on('click', '.approve-btn', function(){
        let bookingId = $(this).attr('data-id'),
            domainUrl = window.location.origin; 

            window.location.href = domainUrl + '/appointments/' + bookingId + '/approve_book';  
    });

    $(document).on('click', '.decline-btn', function(){
        let bookingId = $(this).attr('data-id'),
            domainUrl = window.location.origin; 

            window.location.href = domainUrl + '/appointments/' + bookingId + '/decline_book';
    });

})