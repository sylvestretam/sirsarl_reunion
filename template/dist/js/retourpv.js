function showRetourPV(retour_id)
{
    const retour = getRetour(retoursPV,retour_id);
    // alert(retour_id);
    
    $('.retour_idrpv').val(retour_id);
    $('.date_retourrpv').val(retour.date_retour);
    $('.magasinrpv').val(retour.magasin);
    $('.pvrpv').val(retour.point_de_vente);

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
    
    $('.ligneretourpv').html(text);

    back('.sect_list_retour_pv','.sect_mod_retour_pv');
}

let LIGNES_RETOURS_PV = {};

function addLigneRetourPV()
{
    let article = $('#articlerpv').val();
    let quantite = $('#quantiterpv').val();
    let unite = $('#uniterpv').val();
    let valeur = $('#valeurrpv').val();

    if(quantite =="" || valeur == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        LIGNES_RETOURS_PV[article] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        $('.retourpv').val( JSON.stringify(LIGNES_RETOURS_PV) );
        writeLigneRetourPV(LIGNES_RETOURS_PV,'.ligneretourpv');
    }
}

function removeLigneRetourPV(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete LIGNES_RETOURS_PV[idligne];
    if( Object.keys(LIGNES_RETOURS_PV).length > 0)
        $('.retourpv').val( JSON.stringify(LIGNES_RETOURS_PV) );
    else
        $('.retourpv').val( "" );   
}

function writeLigneRetourPV(lignes,tbody)
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
                    <button type="button" onclick="removeLigneRetourPV('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}