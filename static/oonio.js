/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    5.04.2021 02:13
 */





//SUMMER NODE KULLANIMIÜ
$('.summernote').summernote({
    placeholder: 'buraya yazın...',
    tabsize: 2,
    height: 400,
   /* toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]*/
});

/*
* RETURN JSON
*       'status'    => true,
        'title'     => _tr('hesap silindi'),
        'message'   => _tr('belirtilen kullanıcı hesabı silindi'),
        'id'        => $id,
        'timer'      => ms
* */
// TABLO DA AJAX İLE SİLME İŞLEMİ
function sweetDel(title, desc, url){
    Swal.fire({
        title: title,
        icon: 'warning',
        text: desc,
        showCancelButton: true,
        confirmButtonText: `Onayla`,
        cancelButtonText: `Vazgeç`,
    }).then((result) => {

        if(result.isConfirmed){
            $.ajax({
                url: url,
                type: 'POST',
                data: null,
                dataType: 'json'
            }).done((response) => {
                Swal.fire({
                    position: 'top-end',
                    icon: (!response.status? 'error' : 'success'),
                    title: response.title,
                    text: response.message,
                    showConfirmButton: false,
                    timer: (!response.timer? 750 : response.timer)
                })
                if(response.status){
                    $('tr.row-item-'+response.id).fadeOut(250);
                }
            }); //done
        } //if(result.isConfirmed) )

    }); //then
} //sweetDel