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
        <input type='text' id='search' placeholder="Search for a Starship by name or model" >
</div>
<div class='content' id='content'>



</div>
<script>
    $(document).ready(function () {
        const content = $("#content");
        const API = '<?=WS_URL?>';
        value = $(this).val();
        urlvar = API + '/starships/';
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
            urlvar = API + '/starships/?search=' + value;
            $.ajax({
                url: urlvar,
                success: function (response) {
                    updateResults(response);
                }
            })

        })

        function updateResults(response) {
            content.empty();
            starships = (JSON.parse(response));
            console.log(starships['previous']);
            if (typeof starships['previous'] !== 'undefined' && starships['previous'] != null) {
                $('#arrowleft').show();
                $('#arrowleft').attr('url', starships['previous']);
            } else {
                $('#arrowleft').hide();
            }
            if (typeof starships['next'] !== 'undefined' && starships['next'] != null) {
                $('#arrowright').show();
                $('#arrowright').attr('url', starships['next']);
            } else {
                $('#arrowright').hide();
            }
            if (typeof starships['results'] !== 'undefined') {
                starships['results'].forEach(function (starship) {
                    content.append(
                        "<div class='fragment borderleftyellow '><div class='widthpercent50'><p class='subtitle'><b>Starship</b></p><p class='title'><b>" +
                        starship['name'] + "</b></p><p class='text'>" + starship['model'] +
                        "</p></div><div class='widthpercent50'><div class='floatright'><p class='text textcenter'>Amount: <b id='amount_" +
                        starship['id'] + "'>" + starship['amount'] +
                        "</b></p><div class='rowm floatright'><div class='text decrease noselect' id='decrease_" +
                        starship['id'] + "'>-</div><input placeholder='Insert number' id='input_" +
                        starship['id'] +
                        "' type='text' class='amountinput'><div class='text increase noselect' id='increase_" +
                        starship['id'] + "'>+</div></div></div></div></div>");
                })
            } else {
                content.append("<p class='textcenter'>" + starships['detail'] + "</p>");
            }

            $('.decrease').on('click', function () {
                id = $(this).attr('id').substring($(this).attr('id').indexOf('_') + 1);
                amount = $('#input_' + id).val();
                urlvar = API + '/starships/amount/decrease/?amount=' + amount + '&id=' + id;
                urlget = API + '/starships/amount/get/?&id=' + id;
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
                urlvar = API + '/starships/amount/increase/?amount=' + amount + '&id=' + id;
                urlget = API + '/starships/amount/get/?&id=' + id;
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