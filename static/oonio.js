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
function sweetDel(title, desc, url, trClassNamePrefix='tr.row-item-'){
    Swal.fire({
        title: title,
        icon: 'warning',
        text: desc,
        showConfirmButton: true,
        confirmButtonText: `Onayla`,
        showCancelButton: true,
        cancelButtonText: `Vazgeç`
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
                    $(trClassNamePrefix+response.id).fadeOut(250);
                }
            }); //done
        } //if(result.isConfirmed) )

    }); //then
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
function createNewProjectData(e){
    e.preventDefault();
    let form = document.getElementById('newDataForm');
    let formDatas = new FormData(form);

    $.ajax({
        url: form.action,
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        contentType: false,
        data: formDatas
    }).done((response)=>{
        if(response.status!=true){
            alert('işlem başarısız');
        }else{
            console.log(response);
            // TODO: Veri eklenince tabloyada eklenmeli.
            form.reset();
            document.querySelector('a.btnNewProjectData').click();
        }
    });
    return false;
} //createNewProjectData


function decryptProjectData(prcOrID, url, val){
    if(prcOrID!='show'){
        $('.row-data-item-'+prcOrID+' input.dataInput').val('');
        $('.row-data-item-'+prcOrID+' button.btnDecrypt').toggleClass('d-none');
    }else{
        $.ajax({
            url:url,
            type:'POST',
            data: {val:val},
            dataType:'JSON',
        }).done( response => {
            if(response.status==true){
                $('.'+response.className+' input.dataInput').val(response.value);
                $('.'+response.className+' button.btnDecrypt').toggleClass('d-none');
            }
        } );
    }
} // decryptProjectData






function copyToClipboard(id){
    var copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
} //copyToClipboard









//

