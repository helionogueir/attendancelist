/**
 * Created by william.douglas on 15/09/2017.
 */
jQuery(document).ready(function() {
    jQuery("#btnSubmit").click(function(){

        var urlUpload = "index.php?option=com_attendancelist&view=upload";
        var $formUpload = document.getElementById("adminForm");
        var formData = new FormData($formUpload)
        var lista = jQuery("#attendancelist").val();
        var importfile = jQuery("#importfile").val();

        if(lista != '-' && importfile != '') {
            jQuery("#saida").html('Aguarde o processamento...<img src="/media/com_attendancelist/images/loading.gif">');
            jQuery.ajax({
                url: urlUpload,
                type: 'POST',
                data: formData,
                cache: false,
                dateType: 'text',
                contentType: false,
                processData: false,
                success: function (data) {
                    jQuery("#saida").html('');
                    jQuery("#saida").append(data);
                }
            });
        }else{
            alert('Todos os campos são obrigatórios');
        }
    });
});
