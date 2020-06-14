@include('compte/entete_menu_bar', ['etat'=>'bulletin'])

<style>
@media print{
  .ne_pas_imprimer{
      display: none;
  }
}
</style>

@include('compte/corpsbulletin_titulaire')
@include('flashy::message')
@include('compte/script')

