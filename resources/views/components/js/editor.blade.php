<script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>

<script>
    let editorSettings = {
        selector:'.editor',
        menubar: false,
        rtl: true,
        content_style: 'body{direction:rtl; text-align:right}' + '.mce-content-body::before{left: unset;right: 1px}',
        height: 120,
        toolbar: [
            'ltr rtl | bold italic underline strikethrough |' +
            '| outdent indent | align lineheight | bullist numlist | forecolor backcolor'
        ],
        plugins : "directionality advlist autolink link image media lists preview  fullscreen",
        line_height_formats: '1 2 3 4 5 6 7 8 9',
        init_instance_callback: function(editor) {
            editor.on('change', function(e) {
                let id = $('.editor').attr('id');
                let content = tinymce.get(id).getContent();
                $('#'+id).val(content)
            });
        }
    }
    $(document).ready(function (){
        tinymce.init(editorSettings);
    });
</script>
