$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.show-person-microblogs').click( function() {
    //route format: /orders/{id}/add-tea-consumption
    $.post('/users/' +　$('h5[name="user-name"]').val() 　+　'/microblogs'), function( html ) {
        $('.show-person-info').append( html );
    };
});
