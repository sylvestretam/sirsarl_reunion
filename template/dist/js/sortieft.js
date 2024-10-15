function showSorties(magasin)
{
    $('.magasin').val(magasin);
    back('.sect_list_magasin','.sect_list_sortie');
}

function showSortieFT(sortie_id)
{
    const sortie = getSortieFT(sortiesFT,sortie_id);
    // alert(sortie_id);
    
    $('.sortie_id').val(sortie_id);
    $('.date_sortie').val(sortie.date_sortie);
    $('.magasin').val(sortie.magasin);
    $('.food_trucker').val(sortie.food_trucker);

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
    
    $('.lignesortieft').html(text);

    back('.sect_list_sortie_ft','.sect_mod_sortie_ft');
}

let LIGNES_SORTIES_FT = {};

function addLigneSortieFT()
{
    let article = $('#articlesft').val();
    let quantite = $('#quantitesft').val();
    let unite = $('#unitesft').val();
    let valeur = $('#valeursft').val();

    if(quantite =="" || valeur == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        LIGNES_SORTIES_FT[article] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        $('.sortieft').val( JSON.stringify(LIGNES_SORTIES_FT) );
        writeLigneSortieFT(LIGNES_SORTIES_FT,'.lignesortieft');
    }
}

function removeLigneSortieFT(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete LIGNES_SORTIES_FT[idligne];
    if( Object.keys(LIGNES_SORTIES_FT).length > 0)
        $('.sortieft').val( JSON.stringify(LIGNES_SORTIES_FT) );
    else
        $('.sortieft').val( "" );   
}

function writeLigneSortieFT(lignes,tbody)
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
                    <button type="button" onclick="removeLigneSortieFT('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}