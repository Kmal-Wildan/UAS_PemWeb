/**
 * UAS PEMWEB — Application JavaScript
 * Progres I: jQuery Ajax & UI interactions
 */

$(function () {
    // Setup CSRF token for all Ajax requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Sidebar toggle (mobile)
    $('#sidebarToggle').on('click', function () {
        $('#appSidebar').toggleClass('show');
    });

    // Close sidebar when clicking outside (mobile)
    $(document).on('click', function (e) {
        const sidebar = $('#appSidebar');
        const toggle = $('#sidebarToggle');

        if (sidebar.hasClass('show') &&
            !sidebar.is(e.target) && sidebar.has(e.target).length === 0 &&
            !toggle.is(e.target) && toggle.has(e.target).length === 0) {
            sidebar.removeClass('show');
        }
    });

    // Delete confirmation modal
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const url = $(this).data('url');

        $('#deleteItemName').text(name + ' (ID: ' + id + ')');
        $('#deleteForm').attr('action', url);

        const modal = new bootstrap.Modal('#deleteModal');
        modal.show();
    });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 5000);

    // Form submit loading state
    $('form').on('submit', function () {
        const btn = $(this).find('button[type="submit"]');
        if (btn.length && !btn.prop('disabled')) {
            btn.prop('disabled', true);
            const originalHtml = btn.html();
            btn.data('original-html', originalHtml);
            btn.html('<span class="spinner-border spinner-border-sm me-1"></span>Memproses...');
        }
    });
});
