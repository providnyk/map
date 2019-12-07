$(document).ready(() => {

    moment().locale('{!! $app->getLocale() !!}');

    // Ctrl-s pressed
    $(document).keydown(function(e) {
        if ((e.key == 's' || e.key == 'S' ) && (e.ctrlKey || e.metaKey))
        {
            e.preventDefault();
            $('form').submit();
            return false;
        }
        return true;
    });

});