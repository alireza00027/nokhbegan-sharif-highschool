function formatState (state) {
    if (!state.id) { return state.text; }
    let $state;
    if (state.id === 'ok') {
        $state = $(
            '<div class="d-flex align-items-center justify-content-start"><i class="fa fa-check text-success fs4 ml-2" /><span>' + state.text + '</span></div>'
        );
    } else if (state.id === 'nOk') {
        $state = $(
            '<div class="d-flex align-items-center justify-content-start"><i class="fa fa-times text-danger fs4 ml-2" /><span>' + state.text + '</span></span>'
        );
    } else {
        $state = $(
            '<div class="d-flex align-items-center justify-content-start"><i class="fa fa-ban text-secondary fs4 ml-2" /><span>' + state.text + '</span></span>'
        );
    }
    return $state;
}

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        dir: "rtl",
        minimumResultsForSearch: -1,
        templateResult: formatState,
    });
});
// $(function () {
//     $("#usersList").DataTable({
//         "language": {
//             "paginate": {
//                 "next": "بعدی",
//                 "previous" : "قبلی"
//             }
//         },
//         "ordering": false,
//         "lengthChange": false,
//         "info" : false,
//         "autoWidth": false,
//         "searching": false,
//     });
// });
