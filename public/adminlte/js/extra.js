$(document).on('expanded.pushMenu', function () {
    $('body').addClass('sidebar-expanded');
});

$(document).on('collapsed.pushMenu', function () {
    $('body').removeClass('sidebar-expanded');
});
