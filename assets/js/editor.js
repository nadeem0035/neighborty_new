(function() {
    $(function() {
        var $preview, editor, mobileToolbar, toolbar;
        Simditor.locale = 'en-US';
        toolbar = [ 'bold', 'italic', 'underline', '|', 'ol', 'ul', '|', 'indent', 'outdent', 'alignment'];
        mobileToolbar = ["bold", "underline", "ul", "ol"];
        if (mobilecheck()) {
            toolbar = mobileToolbar;
        }
        editor = new Simditor({
            textarea: $('#txt-content'),
            placeholder: 'Description',
            toolbar: toolbar,
            pasteImage: true,
            defaultImage: 'assets/images/image.png',
            upload: location.search === '?upload' ? {
                url: '/upload'
            } : false
        });
        $preview = $('#preview');
        if ($preview.length > 0) {
            return editor.on('valuechanged', function(e) {
                return $preview.html(editor.getValue());
            });
        }
    });

}).call(this);
