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


var sweetModals = [];

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
        showConfirmButton: true,
        confirmButtonText: `Onayla`,
        showCancelButton: true,
        cancelButtonText: `Vazgeç`,
        preConfirm: (success) => {
            if(success==true){
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
            } //success==true
        }
    });/*.then((result) => {

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

    }); //then*/
} //sweetDel



// POPUP OLARAK HIZLI SAYFA GETİRME
function getPopupInfo(url){
    Swal.fire({
        title: false,
        icon: false,
        width: '61.80%',
        html: 'Loading...',
        position: 'top',
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        focusConfirm: false,
    });
    $.ajax({
        type: 'GET',
        dataType:'html',
        url: url,
    }).done( response => {
        $('#swal2-content').html(response);
    });

} //getPopupInfo




// PROJELERE YENİ VERİ BİLGİSİ EKLEMEK
function createNewProjectData(url){
    let formDatas = new FormData(document.getElementById('newDataForm'));
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        contentType: false,
        data: formDatas
    }).done((response)=>{
        console.log(response);
    });
} //createNewProjectData
















//

