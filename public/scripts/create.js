$(function () {
    var console = window.console || { log: function () {} };
    var $body = $('body');

    var bannerRequestBlock = $('.banner-request-block').clone();
    $(".design-cart").click(function (e) {
        e.preventDefault();
        bq = bannerRequestBlock.clone();
        $('.banner-request-wrap').append(bq);
        $('body').animate({scrollTop: bq.offset().top});
    });
    $body.on('click', '.remove', function(e){
        e.preventDefault();
        if($('.banner-request-block').length > 1){
            $(this).parents('.banner-request-block').remove();
        }
    })
    var showError  =function(message, el){
        el.off('click');
        el.data('err') ? el.data('err').remove():null;
        var err = $("<span class='alert alert-danger'>");
        err.text(message);
        err.insertAfter(el);
        el.data('err', err);
        el.on('click', function(){
            $(this).data('err').remove();
        })
    }
    var validate = function () {
        var patternEmail = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        var patternPhone = /[0-9 -()+]+$/;
        var nameElem = $('.oname');
        var phoneElem = $('.ophone');
        var emailElem = $('.oemail');

        if (!nameElem.val()) {
            showError("Vui lòng nhập đầy đủ họ tên!", nameElem);
            return false;
        }
        if (!phoneElem.val()) {
            showError("Vui lòng nhập đầy đủ số điện thoại!", phoneElem);
            return false;
        }
        else if (emailElem.val() != '' && !patternEmail.test(emailElem.val())) {
            showError("Sai định dạng email!", emailElem);
            return false;
        }
        else if ((phoneElem.val().length < 10) || (!patternPhone.test(phoneElem.val())) || (phoneElem.val().length > 20)) {
            showError("Sai định dạng số điện thoại!", phoneElem);
            return false;
        }
        else {
            return true;
        }
    };

    // size item action
    var sizeItemHtml = $('.size-item-wrap .size-item').clone();
    $body.on('click', '.add-size', function(e){
        var block = $(this).parents('.banner-request-block');
        var sizeError = block.find('.size-item-error');
        e.preventDefault();
        sizeError.hide();
        var item = block.find('.size-item-wrap .size-item:last-child');
        if(parseInt(item.find('.x').val()) && parseInt(item.find('.y').val())){
            item.addClass('added');    
            block.find('.size-item-wrap').append(sizeItemHtml.clone());
        }else{
            sizeError.show();
            sizeError.text('Vui lòng nhập đầy đủ kích thước.')
        }
    });
    $body.on('click', '.size-item .close', function(){
        $(this).parents('.size-item').remove();
    });
    $body.on('change', 'input[type=file]', function(){
        var count = this.files.length;
        $(this).next('span').attr('count', count);
    });
    var formSubmited = 0;
    var formWaiting;
    var loader = $("<div class='loader'>");
    var overlay = $("<div class='order-form-overlay'>");
    var createOrder = function(){
        // validate
        if(validate()){
            processCart();
        }
    }
    var processCart = function(){
        formWaiting = $('.banner-request-block').length;
        if(formWaiting > formSubmited){
            loader.appendTo('body');
            overlay.appendTo('body');
            $('.banner-request-block').each(function(){
                $(this).find('form').ajaxForm({
                    success: function(){
                        formSubmited++;
                        if(formSubmited == formWaiting){
                            submitCustomerForm();
                            // window.location.reload();
                        }
                        // calc loader
                        loader.css('width', (formSubmited * 100 / formWaiting) + '%' );
                    }
                }).submit();
            })
        }
    }
    var submitCustomerForm = function(){
        // formSubmited = 0;
        // formWaiting = $('.banner-request-block').length;
        // overlay.remove();
        // loader.remove();
        $('#createOrderFinalStep').ajaxForm({
            data: {
                'code':'43453345',
                'name':$('.oname').val(),
                'phone':$('.ophone').val(),
                'email':$('.oemail').val(),
            },
            success: function(data){
                if(data.success){
                    alert("Tạo đơn hàng thành công!");
                }else{
                    alert("Có lỗi! Page sẽ reload");
                }
            }
        }).submit();
    }
    $('.createOrder').click(function(){
        createOrder();
    })
    $('#customerForm').sticky({
        topSpacing: 20
    })
});


