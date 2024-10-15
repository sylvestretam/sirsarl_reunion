function showPresence(date_jour)
{
    
    const presence = getPresence(presences_fts,date_jour);
    // alert(JSON.stringify(presence));
    $('.date_jour').val(date_jour);
    $('.effectif').val((presence.lignes).length);
    $('.presents').val((presence.presents).length);
    $('.absents').val((presence.absents).length);

    let text ="";
    presence.lignes.forEach(element => {
        let txt = 
            `<tr id="">
                <td> ${element.date_presence} </td>
                <td> ${element.Food_Trucker.noms} </td>
                <td> ${element.status} </td>
            </tr>`;
        text = text.concat(txt);
    });
    
    $(".lignepresence").html(text);

    back('.sect_list_presence','.sect_list_ligne_presence');
}

let PRESENCES= {};

$('.rad_status').change(function(){

    if($(this).is(':checked')){
        const ft = $(this).attr('name');
        const st = $(this).val();

        PRESENCES[ft] = {"status":st};
        $('.ligne_presence').val(JSON.stringify(PRESENCES));
    }

})