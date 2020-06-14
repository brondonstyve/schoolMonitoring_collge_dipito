@include('layout.css')
@include('layout/header')
@include('layout/imgcours')
@include('layout/borduredecours')
<div id="main-content" class="col-sm-12 col-md-9 col-sm-12 col-xs-12 pull-right">
        <main id="main" class="site-main layout-course" role="main">

@for ($i = 1; $i < 2; $i++)

@include('layout/listecours',['cours'=>$i])
@endfor

</div>
</main>
</div>
</div>
</section>
@include('flashy::message')
@include('layout/footer')
@include('layout/fin')
