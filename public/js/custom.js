$(function() {

    $(document).on('click', '.create-btn', function() {
        let domainUrl = window.location.origin; 

        $('#create-form').attr('action', domainUrl + '/bookings/store');
        $('#create-modal').modal('show');    
    });
   
    // $('#create-form').on('submit', function(e) {
    //     e.preventDefault();
    
    //     let name = $('#create-form').find('#name').val(),
    //         quantity = $('#create-form').find('#quantity').val(),
    //         price = $('#create-form').find('#price').val(),
    //         supplier = $('#create-form').find('#supplier').val();

    //     $.ajax({
    //         url: $(this).attr('action'),
    //         type: "POST",
    //         data: {name, quantity, price, supplier},
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             if (response.success) {
    //                 $('#create-modal').modal('hide');
    //                 $.ajax({
    //                     url: '/products/list',
    //                     type: 'GET',
    //                     success: function(newList) {
    //                         $('#product-list').html(newList); 
    //                     },
    //                     error: function() {
    //                         alert('Error fetching updated product list.');
    //                     }
    //                 });
    //             } else {
    //                 alert('Error adding the product!');
    //             }
    //         }          
    //     });
    // });

})

