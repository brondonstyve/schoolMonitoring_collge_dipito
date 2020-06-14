<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="js/jQuery.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App css -->
        <link href="css/admin/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/admin/style.css" rel="stylesheet" type="text/css">
        <link href="css/admin/metismenu.css" rel="stylesheet" type="text/css">

        <script src="js/admin/modernizr.js"></script>
    <title>test</title>
</head>
<body>
    <table align="center" border="1" style="font-size: 20px">
        <thead>

        </thead>
        <tbody id="tbody">
            @foreach ($collection as $item)
            <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nom }}</td>
                    <td>{{ $item->classe }}</td>
                    <td>
                        <a href="">edit</a>
                        <a href="">suprimer</a>
                        <a href="">modifier</a>
                    </td>
            </tr>

            @endforeach

        </tbody>
    </table>


    <table>
        <form action="{{ route('test_inserer_path') }}" method="post" id="form-insert">
            <tr>
                <input type="text" name="nom" id="" size="20px" placeholder="matiere">
                <input type="text" name="classe" id="" size="20px" placeholder="classe">
            </tr>
            <tr>
                <td>
                    <input type="submit" value="envoyer">
                </td>
            </tr>
        </form>
    </table>










</body>

</html>

<script type="text/javascript ">
    //------------------token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //-----------------add matiere

    $('#form-insert').on('submit',function(e) {
      e.preventDefault();
      var data = $(this).serialize();
      var url  = $(this).attr('action');
      var post = $(this).attr('method');
      $.ajax({
          type : post,
          url  : url,
          data : data,
          dataTy:'json',
          success:function(data){
                alert('ok');
          }
      })

    })

    </script>

            <script src="js/admin/popper.js"></script>
            <!-- Popper for Bootstrap -->
            <script src="js/admin/bootstrap.js"></script>
            <script src="js/admin/metisMenu.js"></script>
            <script src="js/admin/waves.js"></script>
            <script src="js/admin/jquery_005.js"></script>

            <!-- Counterjs  -->
            <script src="js/admin/jquery_004.js"></script>
            <script src="js/admin/jquery_002.js"></script>

            <!-- App js -->
            <script src="js/admin/jquery_003.js"></script>
            <script src="js/admin/jquery.js"></script>

