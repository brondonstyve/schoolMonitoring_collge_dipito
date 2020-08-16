<?php echo $__env->make('compte/entete_menu_bar', ['etat'=>'Cours'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('compte/corpscoursDetails', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('compte/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script>
    $(document).on('submit','#kuestion_form',function(e){
        e.preventDefault();
        data=$(this).serialize();
        console.log(data);
        var url=$(this).attr('action');
        $.post(url,data,function(data){

            if (data==1) {
            alert('votre réponse à été ajouté avec succès');
            window.location.reload();
            } else {
            alert('érreur');
            }
        })
    })

    $(document).on('click','#reponse',function(e){
        var id=$(this).data('id');
        var kuestion=$(this).data('kuestion');
        $('#'+id+' #reponse').replaceWith(' <a href="#" class="badge badge-info" data-toggle="modal" id="fermer" data-id="'+id+'" data-kuestion="'+kuestion+'">Fermer</a>')
        $(' #div_reponse').remove();
        $('#ret_re').remove();
        $('#ret_rep').remove();
        $('#rep').remove();
        $('#'+id).append(
            '<form id="form_rep" action="reponse">'+
            '<div class="form-group" id="rep">'+
                '<div class="">'+
                    '<strong>réponse:</strong>'+
                    '<textarea name="comment" id="" rows="1"  class="form-control" placeholder="réponse" required></textarea>'+
                '</div>'+
                '<input type="hidden" name="kuestion" id="kuestion" value="">'+
                '<button type="submit" class="badge badge-infos">Répondre</button>'+
            '</div>'+
            '</form>'
        );

        $('#kuestion').val($(this).data('kuestion'));
    })

    $(document).on('click','#fermer',function(e){
        var id=$(this).data('id');
        var kuestion=$(this).data('kuestion');
        $('#'+id+' #fermer').replaceWith('<a href="#" class="badge badge-info" data-toggle="modal" id="reponse" data-id="'+id+'" data-kuestion="'+kuestion+'">Répondre</a>')
        $('#rep').remove();
        $('#ret_re').remove();
        $('#ret_rep').remove();
        $(' #div_reponse').remove();
    })

    $(document).on('submit','#form_rep',function(e){
        e.preventDefault();
        var data=$(this).serialize();
        var url=$(this).attr('action');
        console.log(data);
        $.post(url,data,function(data){

            if (data==1) {
            alert('votre réponse à été ajouté avec succès');
            } else {
            alert('érreur');
            }
        })

    });

    $(document).on('click','#repon',function(e){
        var kuestion=$(this).data('kuestion');
        var id=$(this).data('id');
        var id_fermer=$(this).data('id_fermer');
        var repo=$(this).data('repo');
        var url='suite de reponses';
        $('#div_reponse').remove();
        $('#rep').remove();
        $('#ret_re').remove();
        $('#ret_rep').remove();
        $.get(url,{kuestion:kuestion},function(data){


            if (data.length==0) {
                $('#'+id).append('<div id="ret_rep">'+
                    '<h6 style="color: red">Aucune réponse pour le moment</h6>'+
                    '</div>')
            }else{
                $('#'+repo).append(
                '<div id="div_reponse">'+
                    '<h6 style="text-align: center;color: blue" id="ret_re">les réponses</h6>'
            );

            for (let index = 0; index < data.length; index++) {
                $('#'+repo+' #div_reponse').append(
                    '<div id="ret_reponse'+data[index].id+'">'+
                '<div class="d-flex" style="right:50%">'+
                '<div class="p-2"><span class="round text-white d-inline-block text-center rounded-circle bg-info" >'+
                 '<img src="storage/avatar/'+data[index].photo+'" alt="user" width="50"></span></div>'+
                '<div class="comment-text w-100 p-3">'+
                 '<h5>'+data[index].nom+' '+data[index].prenom+'</h5>'+
                 '<p class="mb-1 overflow-hidden">'+data[index].message+'</p>'+
                 '<a href="#" class="badge badge-info" data-toggle="modal" id="reponse" data-id="'+id+'" data-kuestion="'+kuestion+'">Répondre</a>'+
                 '<?php if($utilisateur->type=="enseignant"): ?>'+
                    '<a href="#" data-toggle="modal">'+
                    '<img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-id="'+data[index].id+'" data-supp="ret_reponse'+data[index].id+'" width="20px" id="reponse_supp">'+
                    '</a>'+
                 '<?php endif; ?>'+
                 '<div class="comment-footer">'+
                 '</div>'+
                 '</div>'+
                 '</div>'+
                '</div>');
            }
            }

            $('#'+id_fermer+' #repon').replaceWith('<a href="#" class="badge badge-primary" data-toggle="modal" id="fermer_repon" data-id="'+id+'" data-id_fermer="'+id_fermer+'" data-repo="'+repo+'" data-kuestion="'+kuestion+'">Fermer</a>');

        })
    })

    $(document).on('click','#fermer_repon',function(e){
        $('#ret_rep').remove();
        $('#div_reponse').remove();
        var kuestion=$(this).data('kuestion');
        var id=$(this).data('id');
        var id_fermer=$(this).data('id_fermer');
        var repo=$(this).data('repo');
        $('#'+id_fermer+' #fermer_repon').replaceWith('<a href="#" class="badge badge-primary" data-toggle="modal" id="repon" data-id="'+id+'" data-id_fermer="'+id_fermer+'" data-repo="'+repo+'" data-kuestion="'+kuestion+'">Réponses</a>');

    })

    $(document).on('click','#kuestion_supp',function(e){
        var id=$(this).data('id');
        var url='supp_kuestion';
        var ret=$(this).data('supp');
        var conf=confirm('voulez vous vraiment supprimer cette question?');
        if (conf) {
            $.get(url,{id:id},function(data){
            if (data==1) {
                $('#'+ret).remove();
                $('#text').val(parseInt($('#text').val()-1));
            }
        });
        }
    })

    $(document).on('click','#reponse_supp',function(e){
        var id=$(this).data('id');
        var url='supp_reponse';
        var ret=$(this).data('supp');
        var conf=confirm('voulez vous vraiment supprimer cette reponse?');
        if (conf) {
            $.get(url,{id:id},function(data){
            if (data==1) {
                $('#'+ret).remove();
            }
        });
        }
    })
</script>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/index/coursDetails.blade.php ENDPATH**/ ?>