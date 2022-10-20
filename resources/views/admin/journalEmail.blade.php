@extends('layouts.app')




@section('content')



<div class="card list">
    <div class="card-header list_title">
        <i class="fa-solid fa-table-list"></i> Emails Liste
    </div>
    <div class="card-body list_body">
        <a class="btn btn-outline-success float-start addBtn" href="">
            <i class="fa-solid fa-file-export"></i> Export CSV
        </a>
          <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
                data-target="#EmailModal">
                <i class="fa-solid fa-paper-plane"></i>  Email
            </button>
        <br> <br>
        <table class="table table-hover" id="EmailTable" style="width:100%">
            <thead class="bg-light">
                <tr>
                   <th scope="col"></th>
                   <th scope="col">Id RD</th>
                   <th scope="col">Id Visiteur</th>
                   <th scope="col">Contenu Email</th>
                   <th scope="col">Date Email</th>
                   <th scope="col">Errors Email</th>
                   <th scope="col">Confirmer</th>
                   <th scope="col">Annuler</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>



            </tbody>
        </table>

        <div class="modal fade" id="EmailModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="Email_title">Envoyer Email</span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">✗</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="EmailForm">
                        <div class="form_col">

                            <div class="form-group mb-2">
                                <label for="NomVS">Nom Emetteur</label>
                                <input type="text" class="form-control" id="Nom_Emetteur" name="Nom_Emetteur">
                                <span class="text-danger" id="error_Nom_Emetteur"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="CINVS">Email Emetteur </label>
                                <input type="text" class="form-control" id="Email_Emetteur" name="Email_Emetteur">
                                <span class="text-danger" id="error_Email_Emetteur"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="GSMVS">Objet </label>
                                <input type="telephone" class="form-control" id="Objet" name="Objet">
                                <span class="text-danger" id="error_Objet"></span>
                            </div>


                        </div>
                        <div class="form_col">
                            <div class="form-group mb-2">
                                <label for="EmailVS">Entete</label>
                                <input type="email" class="form-control" id="Entete" name="Entete">
                                <span class="text-danger" id="error_Entete"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label for="EmailVS">Corp</label>
                                <input type="email" class="form-control" id="Corp" name="Corp">
                                <span class="text-danger" id="error_Corp"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label for="EmailVS">Pieds</label>
                                <input type="email" class="form-control" id="Pieds" name="Pieds">
                                <span class="text-danger" id="error_Pieds"></span>
                            </div>


                        </div>
                        <div class="form-group" id="messageEmail">

                        </div>


                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnEnreg">Enregistrer</button>
                    <button type="button" class="btn btn-secondary btnAnnul" data-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>

@endsection


@push('scripts')
<script type="text/javascript">
    function format(d) {
        // `d` is the original data object for the row
        return (
            '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Crée par:</td>' +
            '<td>' +
            d.UserCr +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Crée le</td>' +
            '<td>' +
            d.DateCr +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Modifié par:</td>' +
            '<td>' + d.UserUp + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Modifié le:</td>' +
            '<td>' + d.DateUp + '</td>' +
            '</tr>' +
            '</table>'
        );
    }

    $(document).ready(function() {
        var table = $('#EmailTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            ajax: "{{ route('api.email') }}",
            processing: true,
            columns: [{
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: '',
                },
           {
                data: 'IdRD'
            },
            {
                data: 'IdVS'
            },
            {
                data:'ContenuEM'
            },
            {
                data:'DateEM'
            },
            {
                data: 'ErrorsEM'
            },
            {
                data:'Confirmer'
            },
            {
                data:'Annuler 	'
            },
            {
                data:'Rate'
            },
                {
                    defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#EmailEditModal"><i class="fa-solid fa-pen icon"></i></button>',
                },

            ],
            order: [
                [1, 'asc']
            ],
        });
        $('#EmailTable').on("click", ".edit", function(e) {
            e.preventDefault();

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            console.log(data);
            $('#IdDEP ').val(data[1]);
            $('#NomDEP ').val(data[2]);


        });
        $(document).on("click", ".btnUpdate", function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var IdDEP = $("input[id=IdDEP]").val();
            $.ajax({
                url: "{{ url('update_Email') }}" + '/' + IdDEP,
                type: "PUT",
                data: $("#EmailFormEdit").serialize(),
                success: function(data, textStatus, xhr) {
                    $('#messageEditDep').html('');
                    if (xhr.status === 201) {
                        $('#messageEditDep').html(
                            '<div class="alert alert-success" id="messageEditDep" role="alert">' +
                            data
                            .message + '</div>');

                        $("#EmailFormEdit")[0].reset();
                        table.ajax.reload();
                    } else {
                        $('#messageEditDep').html(
                            '<div class="alert alert-warning" id="messageEditDep" role="alert">' +
                            data
                            .error + '</div>');
                    }
                },
                error: function(response) {
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#EmailFormEdit input, #EmailFormEdit select").each(
                        function(index, item) {
                            var id = $(item).attr('id');
                            if (errors.includes(id)) {
                                $('#' + id).next("span").text(
                                    "field is required or invalid.");
                            }
                        });

                },
            });
        });

        $("#EmailTable").on("click", ".delete", function(e) {
            e.preventDefault();

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            console.log(data);
            $('#IdDEP ').val(data[1]);
        });
            $(document).on("click", ".btnDelete", function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var IdDEP = $("input[id=IdDEP]").val();
            $.ajax({
                type: "DELETE",
                url: "{{ url('delete_Email') }}/" + IdDEP,
                dataType: "JSON",
                success: function(data, textStatus, xhr) {
                    $('#messageDeleteDep').html('');
                    if (xhr.status === 201) {
                        $('#messageDeleteDep').html(
                            '<div class="alert alert-success" id="messageDeleteDep" role="alert">' +
                            data
                            .message + '</div>');
                       location.reload();
                    } else {
                        $('#messageDeleteDep').html(
                            '<div class="alert alert-warning" id="messageDeleteDep" role="alert">' +
                            data
                            .error + '</div>');
                    }
                },

            });
        });




        // Add event listener for opening and closing details
        $('#EmailTable tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
</script>
@endpush
