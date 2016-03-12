(function ($) {
    tinymce.create('tinymce.plugins.TinyMCEGist', {
        init: function (ed, url) {

            ed.addButton('tinymce_gist', {
                tooltip: "Gist",
                cmd: 'dialog',
                image: url + '/images/icon.png'
            });

            ed.addCommand('dialog', function () {
                ed.windowManager.open({
                    title: 'Gist',
                    file: url + '/dialog.php',
                    width: 508,
                    height: 308,
                    inline: 1,
                    buttons: [{
                            text: "Cancel",
                            id: "cancel",
                            class: "cancel",
                            onclick: "close"
                        }]
                }, {
                    plugin_url: url
                });
            });
        }
    });

    // Register plugin
    tinymce.PluginManager.add('tinymce_gist', tinymce.plugins.TinyMCEGist);

})(jQuery);