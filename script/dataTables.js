$(document).ready(function() {
    $('#heroTable').DataTable({
        "paginationType":"full_numbers",
        "lenghtMenu":[
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        language:{
            search:"_INPUT_",
            searchPlaceholder: "Search a hero",
        }

    });
} );