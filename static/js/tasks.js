/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    8.06.2021 23:22
 */


// AJAX İLE PROJE DETAYLARINI POPUP ÜZERİNDEN AÇAR
function showTaskWithAjax(url){
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


