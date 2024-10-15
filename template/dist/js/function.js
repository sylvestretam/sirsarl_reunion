function back(active,future)
{
    $(active).addClass('invisible');
    $(future).removeClass('invisible');
}

function format(number)
{
    var options = {maximumFractionDigits:2};
    return number.toFixedDown(2);
}

function getCourrier(numero)
{
    return courriers.find(element=> element.numero == numero);
}
