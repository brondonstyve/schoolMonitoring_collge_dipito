
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card blog-widget card-size1 color-md1">
            <div class="card-body">
                <div class="blog-image"><img src="images/img1.jpg" alt="img" class="img-responsive"></div>
                <h3>Statut Disciplinaire</h3>
                <span style="color: black">ABSENCES :
                    <span style="color: <?php if($remplisseur<=10): ?> green <?php else: ?> <?php if($remplisseur<=30): ?> Blue <?php else: ?> red <?php endif; ?> <?php endif; ?>">
                        <?php if($remplisseur<=10): ?> bonne <?php else: ?> <?php if($remplisseur<=30): ?> Attention <?php else: ?> Mauvaise <?php endif; ?> <?php endif; ?>
                    </span>
                </span>
<br><br>
                <span style="color: black">CONSEIL DE DISCIPLINE :<?php echo e(sizeOf($discipline)); ?>

                        <span> </span>
                </span>

            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card card-size2 color-md3">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div>
                        <h3 class="card-title">heures d'absence</h3>
                        <h6 class="card-subtitle">Vue détaillé de vos heures d'absence</h6>
                    </div>
                    <div class="ml-auto align-self-center">
                        <ul class="list-inline m-b-0">
                            <li>
                                <h6 class="text-muted text-info"><a href="">Total</a>
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-muted text-info"><a href=""><?php echo e($remplisseur); ?> <?php if($remplisseur==0): ?> heure <?php else: ?> heures <?php endif; ?></a>
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="campaign ct-charts">

                        <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive m-t-20">
                                        <?php if(sizeOf($liste)==0): ?>
                                        <h3 class="card-title">pas d'absence pour le moment</h3>
                                        <h5 class="card-title">bonne conduite.</h5>
                                        <?php else: ?>
                                        <table class="table stylish-table">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>nom matière</th>
                                                        <th>nom professeur</th>
                                                        <th>absence</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php for($i = 0; $i < sizeOf($liste); $i++): ?>
                                                    <tr class="">
                                                            <td><?php echo e($liste[$i]->created_at); ?></td>
                                                            <td> <?php echo e($liste[$i]->nom); ?></td>
                                                            <td> <?php echo e($liste[$i]->nom_prof); ?> </td>
                                                            <td> <?php echo e($liste[$i]->absence); ?></td>
                                                        </tr>
                                                    <?php endfor; ?>


                                                </tbody>
                                            </table>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                 <span style="font-size: 10px"><?php echo e($liste->links()); ?></span>
                </div>
                <div class="row text-center" style="float: right">
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





</div>
</div>


</body>

</html>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/compte/corpsDiscipline.blade.php ENDPATH**/ ?>