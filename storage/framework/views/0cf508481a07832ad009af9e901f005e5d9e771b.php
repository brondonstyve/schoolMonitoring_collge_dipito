<script src="js/bootstrap1.js"></script>
<script src="js/sticky-kit.js"></script>
<script src="js/popper.js"></script>
<script src="js/custom.js"></script>

<script src="js/d3.js"></script>
<script src="js/c3.js"></script>
<script src="js/jQuery.js"></script>
<script src="js/chrono.js"></script>
<script src="js/admin/mesAjax.js"></script>
<script>
    $(document).on('click','#id_sek',function(e){
        url='/nb_sekuence';
        $.get(url,function(data){
            if (data.length==1) {
                $('#select').remove();
                var select=$('<select name="sekuence" id="select" class="form-control">')
                    var cc=0,sequence=0,parcoureur=0,trimestre=0;

                for (let index = 0; index < data[0].nbsequence; index++) {


                    if (parcoureur<2) {

                        select.append($(
                        '<option value="'+(index+1)+'">CC '+(++ cc)+'</option>'
                    ))
                    parcoureur=parcoureur+1;

                    } else {
                        select.append($(
                         '<option value="'+(index+1)+'">SEQUENCE '+( ++ sequence)+'</option>'
                        ))
                        parcoureur=parcoureur+1;
                        if (parcoureur==4) {
                            select.append($(
                              '<option value="trimestre'+( ++ trimestre )+'">TRIMESTRE '+( trimestre )+'</option>'
                             ))
                            parcoureur=0;
                        }
                    }



                }
                $('#selecteur').append(select);
            } else {
                alert('erreur');
            }
        })
    });

    function imprimer(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
   }

</script>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/compte/script.blade.php ENDPATH**/ ?>