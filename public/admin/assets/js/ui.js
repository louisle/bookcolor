UI = {};
window.UI = UI;

$(document).ready(function() {
    $.fn.select2.defaults.set('language', 'vi');
    $('select.select2').each(function() {
        if (typeof $(this).data() !== 'undefined') {
            var option = $(this).data();
            $(this).select2(option);
        } else {
            $(this).select2();
        }
    });

    $('.slug-generator').on('input', function() {
        var viewer = $($(this).attr('data-bind'));
        viewer.val(CF.getSlug($(this).val()));
    });

    $('.remove-link').on('click', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');

        CF.ajax({
            confirm: true,
            url: url,
            success: function() {
                CF.reload();
            }
        });
    })
    // $('.validator').validator({

    // }).on('submit', function(e) {
    //     if (e.isDefaultPrevented()) {
    //         // handle the invalid form...
    //     } else {
    //         // everything looks good!
    //     }
    // });
    
    $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

    $('form').on('submit', function(){
        if(!validator.checkAll($(this))){
            return false;
        }
    });

    // tag input
    $('.tag-editor').tagsInput({
        width: 'auto'
    });

    // MCE
    tinymce.init({
        selector: 'textarea.editor',
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        menubar: false,
        image_advtab: true,
        content_css: [
            '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
        ],

        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        file_browser_callback: function(field_name, url, type, win) {
            // add input and force click
            var form = $("<form class='hidden' action='/admin/uploadimage' method='post'></fomr>");
            form.append("<input type='file' name='image' accept='.jpg,.jpeg,.png,.gif' />");
            form.appendTo('body');
            form.ajaxForm({
                success: function(json) {
                    if (json && json.success) {
                        $('#' + field_name).val(json.url);
                    } else {
                        alert(json.error);
                    }
                    form.remove();
                }
            });
            form.find('input').on('change', function() {
                $(this).parent('form').submit();
            });
            form.find('input').click();
        }
    });

    // link select
    $('#linkTypeSelect').on('change', function() {
        initSearchLinkResource();
    }); 

    var initSearchLinkResource = function(){
        if(typeof $('#linkTargetSelect').select2() !== 'undefined' ){
            //$('#linkTargetSelect').select2('destroy');
            if($('#linkTargetSelect option[selected]').length == 0)
                $('#linkTargetSelect').html('');
        }
        var optLink = {
            ajax: {
                url: $("#linkTypeSelect").val(),
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    console.log(params);
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    var results;
                    if(typeof data.blogs !== 'undefined')
                        results = data.blogs;
                    if(typeof data.articles !== 'undefined')
                        results = data.articles;
                    return {
                        results: results,
                        pagination: {
                            more: (params.page * 10) < data.total_result
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            minimumInputLength: 1,
            templateResult: function(object){
                return "<option value='"+object.id+"'>"+object.title+"</option>" ;
            },
            templateSelection: function(object){
                return object.title;
            },
            data: {id: 1, title: 'selected'}
        };

        $('#linkTargetSelect').select2(optLink);
    }
    initSearchLinkResource();
    

})