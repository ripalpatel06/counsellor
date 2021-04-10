(function ($) {
    SessionTimeout = function( options ) {
        var defaults = {
            selector: '#modal',
            keepAliveUrl: 'auth/extend-session',
            logoutUrl: 'auth/logout',
            warnAfter: 19,
            redirectAfter: 1
        };

        var opt = defaults;

        if (options) {
            opt = $.extend(defaults, options);
        }

        var sessionIsExtended = false;

        var warningTimer = function() {
            return setTimeout(function() {
                $(opt.selector).modal({
                    remote: opt.keepAliveUrl
                });
            }, opt.warnAfter);
        };

        var imminentTimer = function() {
            return setTimeout(function() {
                if (!sessionIsExtended) {
                    parent.window.location = opt.logoutUrl;
                }
            }, opt.redirectAfter);
        };

        var registerListeners = function() {
            $(opt.selector).on('shown.bs.modal', function (e) {
                sessionIsExtended = false;
                imminentTimer();
            });

            $(opt.selector).on('hide.bs.modal', function () {
                $.get(opt.keepAliveUrl);
                sessionIsExtended = true;
                warningTimer();
            });
        };

        var init = function() {
            registerListeners();
            warningTimer();
        };

        /**
         * Public API
         */
        return {
            init : init
        };
    };
}( jQuery ));