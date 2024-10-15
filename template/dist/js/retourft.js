function showRetours(magasin)
{
    $('.magasin').val(magasin);
    back('.sect_list_magasin','.sect_list_retour');
}

function showRetourFT(retour_id)
{
    const retour = getRetour(retoursFT,retour_id);
    // alert(retour_id);
    
    $('.retour_idrft').val(retour_id);
    $('.date_retourrft').val(retour.date_retour);
    $('.magasinrft').val(retour.magasin);
    $('.food_truckerrft').val(retour.food_trucker);

    let text ="";
    
    (retour.lignes_retours).forEach(element => {
        let txt = 
            `<tr id="${element.article}">
                <td> ${element.article} </td>
                <td> ${element.quantite} </td>
                <td> ${element.unite} </td>
                <td> ${element.valeur} </td>
            </tr>`;
        text = text.concat(txt); 
    });
    
    $('.ligneretourrft').html(text);

    back('.sect_list_retour_ft','.sect_mod_retour_ft');
}

let LIGNES_RETOURS_FT = {};

function addLigneRetourFT()
{
    let article = $('#articlerft').val();
    let quantite = $('#quantiterft').val();
    let unite = $('#uniterft').val();
    let valeur = $('#valeurrft').val();

    if(quantite =="" || valeur == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        LIGNES_RETOURS_FT[article] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        $('.retourft').val( JSON.stringify(LIGNES_RETOURS_FT) );
        writeLigneRetourFT(LIGNES_RETOURS_FT,'.ligneretourft');
    }
}

function removeLigneRetourFT(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete LIGNES_RETOURS_FT[idligne];
    if( Object.keys(LIGNES_RETOURS_FT).length > 0)
        $('.retourft').val( JSON.stringify(LIGNES_RETOURS_FT) );
    else
        $('.retourft').val( "" );   
}

function writeLigneRetourFT(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        let txt = 
            `<tr id="${element}">
                <td> ${element} </td>
                <td> ${lignes[element].quantite} </td>
                <td> ${lignes[element].unite} </td>
                <td> ${lignes[element].valeur} </td>
                <td> 
                    <button type="button" onclick="removeLigneRetourFT('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}