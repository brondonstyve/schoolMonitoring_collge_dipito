@include('compte/entete_menu_bar', ['etat'=>'Bulletin trimestriel'])
@include('compte/corps_trimestre')
    @include('flashy::message')
    <style>
        @media print{
          .ne_pas_imprimer{
              display: none;
          }
        }
        </style>
@include('compte/script')
