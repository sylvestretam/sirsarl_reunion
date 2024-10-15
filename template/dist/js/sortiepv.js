function showSortiePV(sortie_id)
{
    const sortie = getSortiePV(sortiesPV,sortie_id);
    
    $('.sortiepv_id').val(sortie_id);
    $('.date_sortiepv').val(sortie.date_sortie);
    $('.magasinpv').val(sortie.magasin);
    $('.pv').val(sortie.point_de_vente);

    let text ="";
    
    (sortie.lignes_sorties).forEach(element => {
        let txt = 
            `<tr id="${element.article}">
                <td> ${element.article} </td>
                <td> ${element.quantite} </td>
                <td> ${element.unite} </td>
                <td> ${element.valeur} </td>
            </tr>`;
        text = text.concat(txt); 
    });
    
    $('.lignesortiepv').html(text);

    back('.sect_list_sortie_pv','.sect_mod_sortie_pv');
}

let LIGNES_SORTIES_PV = {};

function addLigneSortiePV()
{
    let article = $('#articlepv').val();
    let quantite = $('#quantitepv').val();
    let unite = $('#unitepv').val();
    let valeur = $('#valeurpv').val();

    if(quantite =="" || valeur == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        LIGNES_SORTIES_PV[article] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        $('.sortiepv').val( JSON.stringify(LIGNES_SORTIES_PV) );
        writeLigneSortiePV(LIGNES_SORTIES_PV,'.lignesortiepv');
    }
}

function removeLigneSortiePV(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete LIGNES_SORTIES_PV[idligne];
    if( Object.keys(LIGNES_SORTIES_PV).length > 0)
        $('.sortiepv').val( JSON.stringify(LIGNES_SORTIES_PV) );
    else
        $('.sortiepv').val( "" );   
}

function writeLigneSortiePV(lignes,tbody)
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
                    <button type="button" onclick="removeLigneSortiePV('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}