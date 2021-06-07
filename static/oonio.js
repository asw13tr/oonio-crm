/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    5.04.2021 02:13
 */



function aswToast(title, status, time, callback=null){
    alertify.set('notifier','position', 'top-right');
    alertify.notify(title, status, time, callback);
}





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
function sweetDel(title, desc, url, trClassNamePrefix='tr.row-item-'){
    let popup = alertify.confirm(title, desc,
        function(){
            $.ajax({
                url: url,
                type: 'POST',
                data: null,
                dataType: 'json'
            }).done((response) => {
                if(response.status){
                    aswToast(response.title, (!response.status? 'error' : 'success'), 3);
                    $(trClassNamePrefix+response.id).fadeOut(250);
                }else{

                }
            }); //done
        }, // ok butonu
        function(){
            // vazgeçildi
        }).setting({
                autoReset:true,
                basic:false,
                modal:true,
                frameless:false,
                resizable:false,
                maximizable: false,
                pinnable:false,
                padding:true,
                transition:'fade',
                defaultFocus: 'ok',
                onclose: function(){
                    this.setContent('');
                }
            });
} //sweetDel



// POPUP OLARAK HIZLI SAYFA GETİRME
function getPopupInfo(url){
    let popup = alertify.confirm('','loading...', function(){})
        .setting({
            autoReset:true,
            basic:true,
            modal:true,
            frameless:true,
            resizable:true,
            maximizable: true,
            pinnable:true,
            padding:true,
            resizable:true,
            transition:'slide',
            onclose: function(){
                this.setContent('loading...');
            }
        });

    $.ajax({type: 'GET', dataType:'html', url: url}).done( response => {
        popup.resizeTo('61.80%','61.80%').setContent(response);
    });

} //getPopupInfo











function copyToClipboard(id){
    var copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
} //copyToClipboard










//

