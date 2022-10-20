<!DOCTYPE html>

<html>

<head>

    <title>Visitor</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    a{
  font: bold 11px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
</style>
</head>

<body>

    <h1>{{ $details['title'] }}</h1>

    <p>{{ $details['body'] }}</p>



   <!-- <input type="hidden" class="form-control" id="IdRD" name="{{ $details['id'] }}">!-->
    <p>veulliez Confirmer ou Annuler votre présence, <strong style="color: #3a86ff"> à partir deux buttons en dessous </strong> </p>

    <a href="{{url('/confirmerRDV', ['IdRD' => $details['id']])}}"  >confirmer</a>
    <a href="{{url('/refuserRDV' , ['IdRD' => $details['id']])}}"  >Annuler</a>
     <br>
     <p><strong> Nom de la societé</strong></p> <br>
     <p><strong> Adresse de la societé </strong></p> <br>
     <p> <strong> Telephone de la societé </strong></p> <br>

    <p>à bientôt!</p>
    <p>Merci</p>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


   <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('#VisiteurExist').on('change', function() {

                var IdVS = $(this).val();
                $.ajax({
                    url: "{{ url('getDetails') }}" + '/' + IdVS,
                    type: 'get',
                    success: function(response) {

                        $('input[id="NomVS"]').prop("readonly", true).val(response.NomVS);
                        $('input[id="CINVS"]').prop("readonly", true).val(response.CINVS);
                        $('input[id="GSMVS"]').prop("readonly", true).val(response.GSMVS);
                        $('input[id="EmailVS"]').prop("readonly", true).val(response.EmailVS);
                        $('input[id="SocieteVS"]').prop("readonly", true).val(response
                            .SocieteVS);
                        $('input[id="NomTP"]').prop("readonly", true).val(response.IdTP);
                    }
                });
            });
        });
        /*$(document).ready(function() {
            $('#IdDEP').on('change', function() {

                var IdDEP = $(this).val();


                $.ajax({
                    url: "{{ url('Dropdown') }}" + '/' + IdDEP,
                    type: 'get',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var idUSR = response['data'][i].idUSR;
                                var LoginUSR = response['data'][i].LoginUSR;

                                var option = "<option value='" + idUSR + "'>" + LoginUSR + "</option>";

                                $("#idUSR").append(option);
                                $('#idUSR').val(response['data'][i].idUSR);
                            }

                        }

                    }
                });

            });
        });*/
    </script>-->
</body>

</html>
