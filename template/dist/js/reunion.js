
$('.form_add_ru').click(()=>{
    
    let description = $('#description').val();
    let jour = $('#jour').val();
    let debut = $('#debut').val();
    let fin = $('#fin').val();

    const reservations_jour = reservations.filter(element=> element.jour == jour); 

    if(description == "" || jour == "" || debut == "" || fin == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        const DebutTime = new Date(jour+'T'+debut+':00');
        const FinTime = new Date(jour+'T'+fin+':00');

        let aux = 0;
        if( DebutTime < FinTime )
        {
            reservations_jour.forEach(element => {
                
                let STime = new Date(jour+'T'+element.debut);
                let FTime = new Date(jour+'T'+element.fin);

                if( STime < DebutTime && DebutTime < FTime )
                    aux = 1;

                if( STime < FinTime && FinTime < FTime )
                    aux = 1;

                if( STime > DebutTime && FinTime > FTime )
                    aux = 1;
            });


            if( aux == 0 )
            {
                $('form').submit();
                // $('.txt_message_error').html("La salle n'est pas prise");
                // $('.sect_error').removeClass('invisible');
            }
            else
            {
                $('.txt_message_error').html("La salle est déja prise");
                $('.sect_error').removeClass('invisible');
            }
        }
        else
        {
            $('.txt_message_error').html("La date de debut doit etre supérieur à la date de fin");
            $('.sect_error').removeClass('invisible');
        }
    }

})

// events= [
//     {
//     title          : 'All Day Event',
//     start          : new Date(y, m, 1),
//     backgroundColor: '#f56954', //red
//     borderColor    : '#f56954', //red
//     allDay         : true
//     },
//     {
//     title          : 'Long Event',
//     start          : new Date(y, m, d - 5),
//     end            : new Date(y, m, d - 2),
//     backgroundColor: '#f39c12', //yellow
//     borderColor    : '#f39c12' //yellow
//     },
//     {
//     title          : 'Meeting',
//     start          : new Date(y, m, d, 10, 30),
//     end            : new Date(y, m, d, 14, 0),
//     allDay         : false,
//     backgroundColor: '#0073b7', //Blue
//     borderColor    : '#0073b7' //Blue
//     },
//     {
//     title          : 'Lunch',
//     start          : new Date(y, m, d, 12, 0),
//     end            : new Date(y, m, d, 14, 0),
//     allDay         : false,
//     backgroundColor: '#00c0ef', //Info (aqua)
//     borderColor    : '#00c0ef' //Info (aqua)
//     },
//     {
//     title          : 'Birthday Party',
//     start          : new Date(y, m, d + 1, 19, 0),
//     end            : new Date(y, m, d + 1, 22, 30),
//     allDay         : false,
//     backgroundColor: '#00a65a', //Success (green)
//     borderColor    : '#00a65a' //Success (green)
//     },
//     {
//     title          : 'Click for Google',
//     start          : new Date(y, m, 28),
//     end            : new Date(y, m, 29),
//     url            : 'https://www.google.com/',
//     backgroundColor: '#3c8dbc', //Primary (light-blue)
//     borderColor    : '#3c8dbc' //Primary (light-blue)
//     }
// ];