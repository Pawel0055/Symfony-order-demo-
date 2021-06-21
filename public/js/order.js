$(document).ready(function () {
    $(".click").hover(function () {
        var id = $(this).children("#id").first().text();
        $.ajax({
            type: "POST",
            url: 'ajax',
            data: {
                id: id
            },
            dataType: "json",
            async: false,
            success: function (result) {
                //location.reload(true);
                //TOOLTIP
                //console.log(result);
                var str = " ";
                for (let i = 0; i < result.length; i++) {
                    str = str + result[i].name;
                    str = str + ' ';
                }
                //console.log(str);

                $('[data-toggle="tooltip"]').attr('data-original-title', str).tooltip();
                //$('[data-toggle="tooltip"]').tooltip();
                // str = "";
                // $("#myModal").modal('show');
                // $(".modal-body").append(`<p class="test3" style="color: black">COOO</p>`);

                //$(".click").attr('title', 'This is the hover-over text');
            }
        });
        //console.log(id);
    });
});