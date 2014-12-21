function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}

$('[name=title], [name=name]').on('keyup', function ()
{
    var title = $(this).val();

    var slug = convertToSlug(title);

    $('[name=slug]').val(slug);

    $('.slug-preview').text(slug);

});