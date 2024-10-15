function showReceptions(magasin)
{
    $('.magasin').val(magasin);
    back('.sect_list_magasin','.sect_list_reception');
}

function showReception(reception_id)
{
    const reception = getReception(receptions,reception_id);
    // alert(JSON.stringify(reception));
    $('.reception_id').val(reception_id);
    $('.date_reception').val(reception.date_reception);
    $('.magasin').val(reception.magasin);

    writeLigneReception(reception.magasin,'.lignereception');
    let text ="";
    
    (reception.lignes_receptions).forEach(element => {
        let txt = 
            `<tr id="${element.article}">
                <td> ${element.article} </td>
                <td> ${element.quantite} </td>
                <td> ${element.unite} </td>
                <td> ${element.valeur} </td>
            </tr>`;
        text = text.concat(txt); 
    });
    
    $('.lignereception').html(text);

    back('.sect_list_reception','.sect_mod_reception');

}

let LIGNES_RECEPTIONS = {};

function addLigneReception()
{
    let article = $('#article').val();
    let quantite = $('#quantite').val();
    let unite = $('#unite').val();
    let valeur = $('#valeur').val();

    if(quantite =="" || valeur == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        LIGNES_RECEPTIONS[article] = {"quantite":quantite,"unite":unite,"valeur":valeur};
        $('.reception').val( JSON.stringify(LIGNES_RECEPTIONS) );
        writeLigneReception(LIGNES_RECEPTIONS,'.lignereception');
    }
}

function removeLigneReception(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete LIGNES_RECEPTIONS[idligne];
    if( Object.keys(LIGNES_RECEPTIONS).length > 0)
        $('.reception').val( JSON.stringify(LIGNES_RECEPTIONS) );
    else
        $('.reception').val( "" );
    
}

function writeLigneReception(lignes,tbody)
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
                    <button type="button" onclick="removeLigneReception('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}