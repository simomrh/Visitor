@extends('layouts.app')




@section('content')

    <div class="card list">
        <div class="card-header list_title">
            <i class="fa-solid fa-table-list"></i> Départements Liste
        </div>
        <div class="card-body list_body">
            <a class="btn btn-outline-success float-start addBtn" href="{{ url('/exportDepartement') }}">
                <i class="fa-solid fa-file-export"></i> Export CSV
            </a>
            <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
                data-target="#DepartementInfoModal">
                <i class="fa-solid fa-plus"></i> Créer Département
            </button>
            <br> <br>
            <table class="table table-hover" id="DepartementTable" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">ID Département</th>
                        <th scope="col">Nom Département</th>
                        <th scope="col">Action</th>
                        <!--<th></th>!-->
                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="DepartementInfoModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titleDepartement">Ajouter Département</span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="departementForm">
                        <div class="form-group mb-2">
                            <label for="NomDEP">Nom Departement</label>
                            <input type="text" class="form-control" id="NomDEP" name="NomDEP">
                            <span class="text-danger" id="error_NomDEP"></span>
                        </div>

                        <div class="form-group" id="message">

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
    <div class="modal fade" id="DepartementEditModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titleDepartement"></span>Modification Deparetement</h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form id="DepartementFormEdit">
                        <input type="hidden" class="form-control" id="IdDEP" name="IdDEP">
                        <div class="form-group mb-2">
                            <label for="NomDEP">Nom Departement</label>
                            <input type="text" class="form-control" id="NomDEP" name="NomDEP">
                            <span class="text-danger" id="error_NomDEP"></span>
                        </div>

                        <div class="form-group" id="messageEditDep">

                        </div>

                        <!--<button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
                                                                                                    <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
                                                                                                  </button>-->
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnUpdate">Update</button>
                    <button type="button" class="btn btn-secondary btnAnnul" data-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="DepartementDelete" tabindex="-1" role="dialog" style=" float:center;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titleBT">Supprimer Departement</span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="blockedTimesEditForm">
                        <input type="hidden" class="form-control" id="IdDEP" name="IdDEP">

                          <strong>Veuillez confirmer la suppression</strong>

                        <!--<button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
                                                                                                                            <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
                                                                                                                          </button>-->
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btnDelete">Supprimer</button>
                    <button type="button" class="btn btn-secondary btnAnnul" data-dismiss="modal">Annuler</button>
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
            var table = $('#DepartementTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                ajax: "{{ route('api.departements') }}",
                processing: true,
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {
                        data: 'IdDEP'
                    },
                    {
                        data: 'NomDEP'
                    },
                    {
                        defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#DepartementEditModal"><i class="fa-solid fa-pen icon"></i></button>',
                    },
                    /*{

                        defaultContent: '<button class="btn btn-outline-danger delete" data-toggle="modal" data-target="#DepartementDelete"><i class="fa-solid fa-trash icon"></i></button>',

                    },*/
                ],
                order: [
                    [1, 'asc']
                ],
            });
            $('#DepartementTable').on("click", ".edit", function(e) {
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
                    url: "{{ url('update_departement') }}" + '/' + IdDEP,
                    type: "PUT",
                    data: $("#DepartementFormEdit").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#messageEditDep').html('');
                        if (xhr.status === 201) {
                            $('#messageEditDep').html(
                                '<div class="alert alert-success" id="messageEditDep" role="alert">' +
                                data
                                .message + '</div>');

                            $("#DepartementFormEdit")[0].reset();
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
                        $("#DepartementFormEdit input, #DepartementFormEdit select").each(
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

            $("#DepartementTable").on("click", ".delete", function(e) {
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
                    url: "{{ url('delete_departement') }}/" + IdDEP,
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
            $('#DepartementTable tbody').on('click', 'td.dt-control', function() {
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
    <script type="text/javascript">
        $(document).on("click", ".btnEnreg", function(event) {
            event.preventDefault();
            form_data = $("#departementForm").serialize()
            $("#departementForm input").each(function(index, item) {
                $(item).next("span").text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/store_departement",
                type: "POST",
                data: form_data,
                success: function(data, textStatus, xhr) {
                    $('#message').html('');
                    if (xhr.status === 201) {
                        $('#message').html(
                            '<div class="alert alert-success" id="message" role="alert">' + data
                            .success + '</div>');

                        $("#departementForm")[0].reset();
                        location.reload();
                    } else {
                        $('#message').html(
                            '<div class="alert alert-warning" id="message" role="alert">' + data
                            .error + '</div>');
                    }
                },
                error: function(error) {

                    console.log(error);
                },
            });
        });
    </script>
@endpush
