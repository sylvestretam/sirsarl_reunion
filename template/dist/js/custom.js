function showCourrier(numero)
{
    const courrier = getCourrier(numero);

    $('.objet').html(courrier.objet);
    $('.emmetteur').html(courrier.emmetteur);
    $('.date_reception').html(courrier.date_reception);

    $('.fichier').attr('src',`Files/Entrant/${courrier.adresse_fichier}`);

    back('.list','.mod');
}

function showExercice(code,exercice)
{
    const ammortissement = getAmmortissement(code,exercice);
    const immobilisation_exercice = getImmobilisation_exercice(code,exercice);

    $('.immobilisation').val(code);
    $('.exercice').val(exercice);

    $('.a_nouveau_ammort').val("");
    $('.dotation').val("");
    $('.a_nouveau').val("");
    $('.entree').val("");
    $('.sortie').val("");

    if( ammortissement != null){
        $('.a_nouveau_ammort').val(ammortissement.a_nouveau);
        $('.dotation').val(ammortissement.dotation);
    }

    if( immobilisation_exercice != null){
        $('.a_nouveau').val(immobilisation_exercice.a_nouveau);
        $('.entree').val(immobilisation_exercice.entree);
        $('.sortie').val(immobilisation_exercice.sortie);
    }

    back('.list_exercice','.mod_exercice');
}

