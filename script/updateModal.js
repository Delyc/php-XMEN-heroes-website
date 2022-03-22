$(document).ready(function () {
    $('.editbtn').on('click', function() {
        $('#editmodal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data)
        $('#id').val(data[0]);
        $('#image').val(data[1]);
        $('#name').val(data[2]);
        $('#realName').val(data[3]);
        $('#shortBio').val(data[4]);
        $('#longBio').val(data[5]);
    })
} )