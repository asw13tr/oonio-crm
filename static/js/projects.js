/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    7.06.2021 00:36
 */

// ŞİFRELİ PROJE BİLGİLERİNİ ÇÖZER
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









// AJAX İLE PROJE DETAYLARINI POPUP ÜZERİNDEN AÇAR
function showProjectWithAjax(url){
    let popup = alertify.alert('','loading...', function(){})
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

    $.ajax({
        type: 'GET',
        dataType:'html',
        url: url,
    }).done( response => {
        popup.resizeTo('80%','80%').setContent(response);
    });
} //showProjectWithAjax











// PROJE BİLGİSİ EKLE/DÜZENLE FORMU POPUP İLE GETİRİLECEK.
function getDataProjectForm(url){
    let popup = alertify.confirm('loading...', function(){})
        .setting({
            autoReset:false,
            basic:true,
            modal:true,
            frameless:true,
            resizable:true,
            maximizable: false,
            pinnable:true,
            padding:false,
            resizable:true,
            transition:'slide',
            onclose: function(){
                this.setContent('loading...');
            }
        });

    $.ajax({
        type: 'GET',
        dataType:'html',
        url: url,
    }).done( response => {
        popup.resizeTo(400,475).setContent(response);
    });
} //getDataProjectForm









// PROJE BİLGİSİ VERİTABANINA EKLENECEK
function saveProjectData(e){
    e.preventDefault();
    let form = document.getElementById('formProjectData');
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
            aswToast('error', 'error', 2);
        }else{
            if(response.action=='create'){
                aswToast('yeni proje bilgisi kayıt edildi.', 'success', 2);
                document.querySelector('#datasTableBody').innerHTML += response.template;
            }else if(response.action=='update'){
                aswToast('veri güncellendi.', 'success', 2);
                document.querySelector('#datasTableBody tr.row-data-item-'+response.data_id).innerHTML = response.template;
            }else{

            }
            form.reset();
            alertify.confirm().close();
        }

    });
    return false;
}