<?php
include('header.php');
?>




<div class='container2'>
    <div class='widthpercent50'>
        <div id='arrowleft' class='noselect'>Previous</div>
    </div>
    <div class='widthpercent50'>
        <div id='arrowright' class='noselect'>Next</div>
    </div>

</div>

<div class='textcenter'>
        <input type='text' id='search' placeholder="Search for a Vehicle by ID" >
</div>
<div class='content' id='content'>



</div>
<script>
    $(document).ready(function () {
        const content = $("#content");
        const API = '<?=WS_URL?>';
        value = $(this).val();
        urlvar = API + '/vehicles/';
        $.ajax({
            url: urlvar,
            success: function (response) {
                updateResults(response);
            }
        })
        $('#arrowright').on('click', function () {
            value = $(this).val();
            urlvar = $(this).attr('url');
            $.ajax({
                url: urlvar,
                success: function (response) {
                    updateResults(response);
                }
            })
        });
        $('#arrowleft').on('click', function () {
            value = $(this).val();
            urlvar = $(this).attr('url');
            $.ajax({
                url: urlvar,
                success: function (response) {
                    updateResults(response);
                }
            })
        });

        $('#search').on('input', function () {
            value = $(this).val();
            urlvar = API + '/vehicles/' + value;
            $.ajax({
                url: urlvar,
                success: function (response) {
                    updateResults(response);
                }
            })

        })

        function updateResults(response) {
            content.empty();
            
            vehicles = (JSON.parse(response));
            if(typeof vehicles['id'] !== 'undefined'){
                array=[];
                array['results']=[]
                array['results'].push(vehicles);
                vehicles=array;
            }
            if (typeof vehicles['previous'] !== 'undefined' && vehicles['previous'] != null) {
                $('#arrowleft').show();
                $('#arrowleft').attr('url', vehicles['previous']);
            } else {
                $('#arrowleft').hide();
            }
            if (typeof vehicles['next'] !== 'undefined' && vehicles['next'] != null) {
                $('#arrowright').show();
                $('#arrowright').attr('url', vehicles['next']);
            } else {
                $('#arrowright').hide();
            }
            if (typeof vehicles['results'] !== 'undefined') {
                vehicles['results'].forEach(function (vehicle) {
                    content.append(
                        "<div class='fragment borderleftyellow '><div class='widthpercent50'><p class='subtitle'><b>Vehicle</b></p><p class='title'><b>" +
                        vehicle['name'] + "</b></p><p class='text'>" + vehicle['model'] +
                        "</p></div><div class='widthpercent50'><div class='floatright'><p class='text textcenter'>Amount: <b id='amount_" +
                        vehicle['id'] + "'>" + vehicle['amount'] +
                        "</b></p><div class='rowm floatright'><div class='text decrease noselect' id='decrease_" +
                        vehicle['id'] + "'>-</div><input placeholder='Insert number' id='input_" +
                        vehicle['id'] +
                        "' type='text' class='amountinput'><div class='text increase noselect' id='increase_" +
                        vehicle['id'] + "'>+</div></div></div></div></div>");
                })
            } else {
                content.append("<p class='textcenter'>" + vehicles['detail'] + "</p>");
            }

            $('.decrease').on('click', function () {
                id = $(this).attr('id').substring($(this).attr('id').indexOf('_') + 1);
                amount = $('#input_' + id).val();
                urlvar = API + '/vehicles/amount/decrease/?amount=' + amount + '&id=' + id;
                urlget = API + '/vehicles/amount/get/?&id=' + id;
                $.ajax({
                    url: urlvar,
                    success: function (response) {
                        response = JSON.parse(response);

                        if (response['success']) {
                            $.bootstrapGrowl(response['detail'], {type:'success'});
                            $.ajax({
                                url: urlget,
                                success: function (response) {
                                    response = JSON.parse(response);
                                    $('#amount_' + id).html(response['amount']);
                                }
                            })
                        } else {
                            $.bootstrapGrowl(response['detail'], {type:'danger'});
                        }
                    }
                })
            });
            $('.increase').on('click', function () {
                id = $(this).attr('id').substring($(this).attr('id').indexOf('_') + 1);
                amount = $('#input_' + id).val();
                urlvar = API + '/vehicles/amount/increase/?amount=' + amount + '&id=' + id;
                urlget = API + '/vehicles/amount/get/?&id=' + id;
                $.ajax({
                    url: urlvar,
                    success: function (response) {
                        response = JSON.parse(response);

                        if (response['success']) {
                            $.bootstrapGrowl(response['detail'], {type:'success'});
                            $.ajax({
                                url: urlget,
                                success: function (response) {
                                    response = JSON.parse(response);
                                    $('#amount_' + id).html(response['amount']);
                                }
                            })
                        } else {
                            $.bootstrapGrowl(response['detail'], {type:'danger'});
                        }
                    }
                })
            });
        }

    });
</script>
<?php
include('footer.php');
?>