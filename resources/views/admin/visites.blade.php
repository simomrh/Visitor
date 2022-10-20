@extends('layouts.app')

@section('content')
    <!--<a class="btn btn-outline-success float-start addBtn" data-href="/exportVisite" id="export" onclick="exportTasks(event.target);" style="margin-top= 10%" data-toggle="modal">
        <i class="fa-solid fa-file-export"></i> Export CSV
    </a>!-->


    <br> <br>
    <div class="card list">
        <div class="card-header list_title">
            <i class="fa-solid fa-table-list "></i> Visites Liste
        </div>
        <div class="card-body">
            <a class="btn btn-outline-success float-start addBtn" href="{{ url('/exportVisite') }}">
                <i class="fa-solid fa-file-export"></i> Export CSV
            </a>
            <br>
            <table class="table table-hover cell-border" id="VisitesTable" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th> </th>
                        <th> ID Visite </th>
                        <th> ID Visiteur </th>
                        <th> ID RDV</th>
                        <th>ID Dep </th>
                        <th>ID USR </th>
                        <th>Raison </th>
                        <th>Annule</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Rate</th>
                        <th>Action</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="VisiteEditModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titleVisite"></span>Modification Visite</h5>
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
                    <form id="VisitesFormEdit">

                        <input type="hidden" class="form-control" id="IdVis" name="IdVis">
                        <div class="form_col">
                            <div class="form-group  mb-2">
                                <label for="IdVS">Visiteur</label>
                                <input type="text" class="form-control" id="IdVS" name="IdVS" readonly>

                            </div>

                            <div class="form-group  mb-2">
                                <label for="IdRD">Rendez-Vous</label>
                                <input type="text" class="form-control" id="IdRD" name="IdRD" readonly>

                            </div>
                            <div class="form-group  mb-2">
                                <label for="IdDEP">Département</label>
                                <input type="text" class="form-control" id="IdDEP" name="IdDEP" readonly>

                            </div>

                            <div class="form-group  mb-2">
                                <label for="idUSR">Utilisateur</label>
                                <input type="text" class="form-control" id="idUSR" name="idUSR" readonly>

                            </div>

                        </div>
                        <div class="form_col">
                            <div class="form-group  mb-2">
                                <label for="RaisonVis">Raison Visite</label>
                                <input type="text" class="form-control" id="RaisonVis" name="RaisonVis">
                                <span class="text-danger" id="error_RaisonVis"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="Check_In">Check In</label>
                                <input type="datetime-local" class="form-control" id="Check_In" name="Check_In">
                                <span class="text-danger" id="error_Check_In"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="Check_Out">Check Out</label>
                                <input type="datetime-local" class="form-control" id="Check_Out" name="Check_Out">
                                <span class="text-danger" id="error_Check_Out"></span>
                            </div>



                            <div class="form-group  mb-2">
                                <label for="Rate"> <input type="checkbox" id="Rate" name="Rate[]"
                                        value="1"> Rate </label>
                            </div>
                        </div>
                        <div class="form-group" id="messageEditVisite">

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
    
    <div class="modal fade" id="BloqueModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title"></span>Modification Visite</h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">✗</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form id="BloquerForm">

                        <input type="hidden" class="form-control" id="IdVis" name="IdVis">

                        <div class="form_col">
                            <label for="Valide"><input type="checkbox" id="Annule" name="Annule[]" value="1">
                                Bloquer
                                Visite</label>
                        </div>

                        <div class="form-group" id="Bloquer">

                        </div>

                        <!--<button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
                                                                                                    <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
                                                                                                  </button>-->
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnBloquer">Bloquer</button>
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
            var table = $('#VisitesTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                ajax: "{{ route('api.visites') }}",
                processing: true,
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },

                    {
                        data: 'IdVis'
                    },
                    {
                        data: 'IdVS'
                    },
                    {
                        data: 'IdRD'
                    },
                    {
                        data: 'IdDEP'
                    },
                    {
                        data: 'idUSR'
                    },
                    {
                        data: 'RaisonVis'
                    },
                    {
                        data: 'Annule',
                        render: function(data, type, row) {
                            if (row.Annule === 1) {
                                return '<button class="btn btn-success">Oui</button>'
                            } else {
                                return '<button class="btn btn-danger">Non</button>'
                            }
                        }
                    },
                    {
                        data: 'Check_In'
                    },
                    {
                        data: 'Check_Out'
                    },
                    {
                        data: 'Rate',
                        render: function(data, type, row) {
                            if (row.Rate === 1) {
                                return '<button class="btn btn-success">Oui</button>'
                            } else {
                                return '<button class="btn btn-danger">Non</button>'
                            }
                        }
                    },
                    {
                        defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#VisiteEditModal"><i class="fa-solid fa-pen icon"></i></button>',

                    },
                    {
                        defaultContent: '<button class="btn btn-outline-danger bloquer" data-toggle="modal" data-target="#BloqueModal"><i class="fa-solid fa-ban"></i></button>',

                    },
                    /*{
                        defaultContent: '<button class="btn btn-outline-danger delete" ><i class="fa-solid fa-trash icon"></i></button>',

                    },*/


                ],
                order: [
                    [1, 'asc']
                ],
            });
            $('#VisitesTable').on("click", ".edit", function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                console.log(data);
                $('#IdVis').val(data[1]);
                $('#IdVS').val(data[2]);
                $('#IdRD').val(data[3]);
                $('#IdDEP ').val(data[4]);
                $('#idUSR').val(data[5]);
                $('#RaisonVis').val(data[6]);
                $('#Valide ').val(data[7]);
                $('#Annule').val(data[8]);
                $('#Check_In').val(data[9]);
                $('#Check_Out').val(data[10]);
                $('#Rate').val(data[11]);


            });
            $(document).on("click", ".btnUpdate", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var IdVis = $("input[id=IdVis]").val();
                $.ajax({
                    url: "{{ url('update_visite') }}" + '/' + IdVis,
                    type: "PUT",
                    data: $("#VisitesFormEdit").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#messageEditVisite').html('');
                        if (xhr.status === 201) {
                            $('#messageEditVisite').html(
                                '<div class="alert alert-success" id="messageEditVisite" role="alert">' +
                                data
                                .message + '</div>');

                            $("#VisitesFormEdit")[0].reset();
                            table.ajax.reload();
                        } else {
                            $('#messageEditVisite').html(
                                '<div class="alert alert-warning" id="messageEditVisite" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },
                    error: function(response) {
                        var errors = Object.keys(response.responseJSON.errors);
                        $("#VisitesFormEdit input").each(function(index, item) {
                            var id = $(item).attr('id');
                            if (errors.includes(id)) {
                                $('#' + id).next("span").text(
                                    "field is required or invalid.");
                            }
                        });

                    },
                });
            });
            $('#VisitesTable').on("click", ".valider", function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                console.log(data);
                $('#IdVis').val(data[1]);
                $('#IdRD').val(data[3]);
                $('#idUSR').val(data[5]);
                $('#Valide ').val(data[7]);



            });
            $(document).on("click", ".btnValider", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var IdVis = $("input[id=IdVis]").val();
                var IdRD = $("input[id=IdRD]").val();
                var idUSR = $("input[id=idUSR]").val();
                $.ajax({
                    url: "{{ url('valider_visite') }}" + '/' + IdVis + '/' + IdRD + '/' + idUSR,
                    type: "PUT",
                    data: $("#validerForm").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#Valider').html('');
                        if (xhr.status === 201) {
                            $('#Valider').html(
                                '<div class="alert alert-success" id="Valider" role="alert">' +
                                data
                                .success + '</div>');

                            $("#validerForm")[0].reset();
                            table.ajax.reload();
                        } else {
                            $('#Valider').html(
                                '<div class="alert alert-warning" id="Valider" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },
                    error: function(response) {
                        var errors = Object.keys(response.responseJSON.errors);
                        $("#validerFrom input").each(function(index, item) {
                            var id = $(item).attr('id');
                            if (errors.includes(id)) {
                                $('#' + id).next("span").text(
                                    "field is required or invalid.");
                            }
                        });

                    },
                });
            });
            $('#VisitesTable').on("click", ".bloquer", function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                console.log(data);
                $('#IdVis').val(data[1]);
                $('#Annule ').val(data[8]);



            });
            $(document).on("click", ".btnBloquer", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var IdVis = $("input[id=IdVis]").val();
                $.ajax({
                    url: "{{ url('bloquer_visite') }}" + '/' + IdVis,
                    type: "PUT",
                    data: $("#BloquerForm").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#Bloquer').html('');
                        if (xhr.status === 201) {
                            $('#Bloquer').html(
                                '<div class="alert alert-success" id="Bloquer" role="alert">' +
                                data
                                .success + '</div>');

                            $("#BloquerForm")[0].reset();
                            table.ajax.reload();
                        } else {
                            $('#Bloquer').html(
                                '<div class="alert alert-warning" id="Bloquer" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },
                    error: function(response) {
                        var errors = Object.keys(response.responseJSON.errors);
                        $("#BloquerForm input").each(function(index, item) {
                            var id = $(item).attr('id');
                            if (errors.includes(id)) {
                                $('#' + id).next("span").text(
                                    "field is required or invalid.");
                            }
                        });

                    },
                });
            });

           /* $("#VisitesTable").on("click", ".delete", function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                console.log(data);
                $('#IdVis ').val(data[1]);
                swal.fire({
                    title: "Suppression",
                    text: "Veuillez confirmer la suppression",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirmer",
                    cancelButtonText: "Annuler",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        var IdVis = $("input[id=IdVis]").val();
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('delete_visite') }}/" + IdVis,
                            dataType: "JSON",
                            success: function(results) {
                                if (results.success === true) {
                                    swal.fire("Error!", results.success, "error");
                                } else {
                                    swal.fire("Done!", results.error, "success");

                                }
                                table.ajax.reload();
                            } //success
                        });
                    } else {
                        result.dismiss === Swal.DismissReason.cancel
                    }
                })



            });*/

            // Add event listener for opening and closing details
            $('#VisitesTable tbody').on('click', 'td.dt-control', function() {
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
    <script>
        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }
    </script>
@endpush
