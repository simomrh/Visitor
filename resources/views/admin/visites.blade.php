@extends('layouts.app')

@section('content')
<button class="btn btn-outline-success float-start addBtn" style="margin-top= 10%" data-toggle="modal">
    <i class="fa-solid fa-file-export"></i> Export CSV
    </button>
    <button class="btn btn-outline-success float-start addBtn" style="margin-top= 10%; margin-left:10px" data-toggle="modal">
        <i class="fa-solid fa-file-export"></i> Export XSL
        </button>
        <br> <br>
        <div class="card"  >
            <div class="card-header" >
                <i class="fa-solid fa-table-list"></i>    Visites Liste
            </div>
            <div class="card-body">
    <table class="table table-hover" id="VisitesTable" style="width:100%">
        <thead class="bg-light">
            <tr>
                <th > </th>
                <th > Id Vis </th>
                <th > Id VS </th>
                <th > Id RDV</th>
                <th >Id Dep </th>
                <th >Id USR </th>
                <th >Raison </th>
                <th >Valide </th>
                <th >Annule</th>
                <th >Check In</th>
                <th >Check Out</th>
                <th >Rate</th>
                <th >Action</th>
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
                    <form id="VisitesFormEdit">

                        <input type="hidden" class="form-control" id="IdVis" name="IdVis">
                        <div class="form_col">
                            <div class="form-group  mb-2">
                                <label for="IdVS">IdVS</label>
                                <input type="text" class="form-control" id="IdVS" name="IdVS" readonly>

                            </div>

                            <div class="form-group  mb-2">
                                <label for="IdRD">IdRD</label>
                                <input type="text" class="form-control" id="IdRD" name="IdRD" readonly>

                            </div>
                            <div class="form-group  mb-2">
                                <label for="IdDEP">IdDEP</label>
                                <input type="text" class="form-control" id="IdDEP" name="IdDEP" readonly>

                            </div>
                            <div class="form-group  mb-2">
                                <label for="LoginUSR">LoginUSR</label>
                                <input type="text" class="form-control" id="LoginUSR" name="LoginUSR" readonly>

                            </div>
                        </div>
                        <div class="form_col">
                            <div class="form-group  mb-2">
                                <label for="Check_In">Check In</label>
                                <input type="datetime-local" class="form-control" id="Check_In" name="Check_In">
                                <span class="text-danger" id="error_DateDeb"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="Check_Out">Check Out</label>
                                <input type="datetime-local" class="form-control" id="Check_Out" name="Check_Out">
                                <span class="text-danger" id="error_DateFin"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label> Actions : </label><br>
                                <label for="Valide"><input type="checkbox" id="Valide" name="Valide[]"
                                        value="1" > Valider
                                    Rendez-vous</label>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="Annule"> <input type="checkbox" id="Annule" name="Annule[]"
                                        value="1"> Anuuler </label>
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
            '<td>'+ d.UserUp +'</td>' +
            '</tr>' +
            '<tr>'+
            '<td>Modifié le:</td>' +
            '<td>'+ d.DateUp +'</td>' +
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

                {data: 'IdVis'},
                {data: 'IdVS'},
                {data: 'IdRD'},
                {data: 'IdDEP'},
                {data: 'idUSR'},
                {data: 'RaisonVis'},
                {data: 'Valide',
                render:function(data,type,row){
                if(row.Valide === 1 ){
                    return '<button class="btn btn-success">Oui</button>'
                }else{
                    return '<button class="btn btn-danger">Non</button>'
                }
               }
            },
                {data: 'Annule',
               render:function(data,type,row){
                if(row.Annule === 1 ){
                    return '<button class="btn btn-success">Oui</button>'
                }else{
                    return '<button class="btn btn-danger">Non</button>'
                }
               }
            },
                {data: 'Check_In'},
                {data: 'Check_Out'},
                {data: 'Rate',
                render:function(data,type,row){
                if(row.Rate === 1 ){
                    return '<button class="btn btn-success">Oui</button>'
                }else{
                    return '<button class="btn btn-danger">Non</button>'
                }
               }
            },
                {
                  defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#VisiteEditModal"><i class="fa-solid fa-pen icon"></i></button>',

                },



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
            $('#LoginUSR').val(data[5]);
            $('#Valide ').val(data[6]);
            $('#LoginUSR').val(data[7]);
            $('#Check_In').val(data[8]);
            $('#Check_Out').val(data[9]);
            $('#Rate').val(data[10]);


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
                            $('#' + id).next("span").text("field is required or invalid.");
                        }
                    });

                },
            });
        });


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



@endpush
