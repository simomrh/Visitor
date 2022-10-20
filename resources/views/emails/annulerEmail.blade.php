<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Visitor') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/visitor.png') }}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

    <style>
       .logo{
           display: flex;
            width: 50px;
            margin: 0.5% 60% 0 1%;
       }

        img {
            display: flex;
            width: 500px;
            margin: 5% 25% 0 31%;
        }
        h5{
            margin: 0 25% 0 40%;
            font-size:25px;
        }
        p{
            margin: 0 25% 0 32%;
            font-size:16.5px;
        }

    </style>
</head>

<body>

    <img src="{{ asset('img/visitor.png') }}" class="logo">


    <img src="{{ asset('img/annuler.svg') }}">

    <br>
    <br>

    <h5> <strong>  tu as refusé ta présence </strong></h5> <br>
    <p> <strong>  pour vous aider essayez de nous contacter sur ce numéro 0000000000  </strong></p> <br>






    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!--<script type="text/javascript">
        $(document).on("click", ".btnConfirm", function(event) {
            event.preventDefault();
            form_data = $("#ConfirmerForm").serialize()
            $("#ConfirmerForm input").each(function(index, item) {
                $(item).next("span").text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var IdRD = $("input[id=IdRD]").val();
            $.ajax({
                url: "{{ url('Confirmer_rdv') }}" + '/' + IdRD,
                type: "PUT",
                data: form_data,
                success: function(data, textStatus, xhr) {
                    $('#Confirmer').html('');
                    if (xhr.status === 201) {
                        $('#Confirmer').html(
                            '<div class="alert alert-success" id="Confirmer" role="alert">' +
                            data
                            .success + '</div>');

                        $("#ConfirmerForm")[0].reset();
                        location.reload();
                    } else {
                        $('#Confirmer').html(
                            '<div class="alert alert-warning" id="Confirmer" role="alert">' +
                            data
                            .error + '</div>');
                    }
                },
                error: function(response) {
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#ConfirmerForm input").each(function(index, item) {
                        var id = $(item).attr('id');
                        if (errors.includes(id)) {
                            $('#' + id).next("span").text("field is required or invalid.");
                        }
                    });
                },
            });
        });
    </script>!-->
</body>

</html>
