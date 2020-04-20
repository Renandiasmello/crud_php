// Ao carregar o documento

$(document).ready(function () {

    $(".c-remover").click(function (event) {

        event.preventDefault();

        var url = $(this).attr("href");

        bootbox.confirm("Tem certeza que deseja excluir o registro?", function (result) {

            if (result) {

                document.location.href = url;

            }

        });

    });

});