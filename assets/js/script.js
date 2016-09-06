/**
 * Created by ronal on 19/10/2015.
 */
(function($){
    $(document).ready(function(){
        $('#add_imgcandidat').on('click', function(e){
            e.preventDefault();
            var el = $(this).parent();
            var uploader = wp.media({
                title: 'Ajouter une photo',
                button:{
                    text: 'Choisir une photo'
                },
                multiple:false
            }).on('select', function() {
                var selection = uploader.state().get('selection');
                var attachement = selection.first().toJSON();
                if(attachement.mime == "image/jpeg" || attachement.mime == "image/png"){
                    $('input#imgcandidat', el).val(attachement.url);
                    $('img#view_imgcandidat', el).attr({'src': attachement.url, 'width': '250'});
                    $(this).text("Modifier l'image du candidat");
                }else{

                }
            }).open();
        });

        $('.datepickerbirth').inputmask("date", { placeholder:"__/__/____"});
    })
})(jQuery);