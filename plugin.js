(function ($) {

    // Register plugin
    tinymce.PluginManager.add('tinymce_gist', function (editor, url) {
        
        function showDialog() {
            var win = editor.windowManager.open({
                title: "Gist",
                file: url + '/dialog.php',
                width: 600,
                height: 300,
                inline: 1,
                buttons: [{
                        text: "Close",
                        id: "close",
                        class: "close",
                        onclick: "close"
                }]
            }, {
                plugin_url: url,
                editor: editor
            });
        }

        editor.addButton('tinymce_gist', {
            image: url + '/images/icon.png',
            tooltip: 'Gist',
            onclick: showDialog
        });

    });

})(jQuery);