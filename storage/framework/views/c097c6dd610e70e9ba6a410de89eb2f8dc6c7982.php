<?php echo $__env->make('compte/entete_menu_bar', ['etat'=>'Cours'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('compte/corpscoursProf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('flashy::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('compte/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script>
    $(document).on('click','#new_course',function(e){
        $('#matiere').remove();
        var classe=$(this).data('classe');
        var url='matieres/cours';
        var option=$('<select name="matiere" id="matiere" class="form-control" required>');
        $('#classe').val(classe);
        $('#classeh').val(classe);

        $.get(url,{classe:classe},function(e){
            for (let index = 0; index < e.length; index++) {
                option.append(
                    '<option value="'+e[index].id+'">'+e[index].nom+'</option>'
                );
                $('#-1').append(option);
            }


        })
    })

    $(document).on('click','#img_supp',function(e){
       var id=$(this).data('id');
       $('#id_supp').val(id);

    })

    $(document).on('click','#supp_conf',function(i){
            var url='supprimer cours';
            var id=$('#id_supp').val();
            $.get(url,{id:id},function(data){
                if(data==true){
                    $('#'+id).remove();
                    alert('suppression réalisé avec succès');
                }
            })
        })
</script>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/index/coursProf.blade.php ENDPATH**/ ?>