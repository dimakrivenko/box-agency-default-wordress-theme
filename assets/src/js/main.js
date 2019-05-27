(function($) {

	// Получения одного параметра search в URL
    function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

	$(document).ready(function() {
		// Маска телефона
    	$("input.form-control[name=phone]").mask("+7 (999) 999-99-99");

        // Lazy load image
        $(".lazy").lazyload();
        $(".lazy").lazyload({
            event : "sporty"
        });

        // Переход по якорям
        $('.scroll-to').click(function(e){
            const el = $(this).attr('href');

            if (window.location.href === globalParams.site_url + '/') {
                e.preventDefault();

                if (document.querySelector(el) !== null) {
                    $('html, body').animate({
                        scrollTop: $(el).offset().top
                    }, 500);
                }
            } else {
                window.location.href = globalParams.site_url + '/' + el;
            }
            
            return false;
        });

        // Формы
        (function(){
            // Отправка формы
            $('.common-form').validator().on('submit', function(e) {
        		var form = $(this),
                    formData = form.serializeArray(),
                    formName = form.find('input[name="form_name"]').val(),
                    formModalSuccess = form.find('input[name="modal_success"]').val(),
        			formGoal = form.find('input[name="ya_metrica_goal_name"]').val(),
        			formPrivacy = form.find('input[name="privacy"]').prop("checked");

                setTimeout(function () {
                    form.find('.form-group').removeClass('has-error');
                }, 3000);

                formData.push({ name: 'from_site', value: window.location.origin + window.location.pathname });

                if (getUrlParameter('utm_source') !== undefined) {
                    formData.push({ name: 'utm_source', value: getUrlParameter('utm_source') });
                }

                if (getUrlParameter('utm_medium') !== undefined) {
                    formData.push({ name: 'utm_medium', value: getUrlParameter('utm_medium') });
                }

                if (getUrlParameter('utm_campaign') !== undefined) {
                    formData.push({ name: 'utm_campaign', value: getUrlParameter('utm_campaign') });
                }

                if (getUrlParameter('utm_content') !== undefined) {
                    formData.push({ name: 'utm_content', value: getUrlParameter('utm_content') });
                }

                if (getUrlParameter('utm_term') !== undefined) {
                    formData.push({ name: 'utm_term', value: getUrlParameter('utm_term') });
                }

                // console.log(formData)

        		if (!e.isDefaultPrevented()) {
                    e.preventDefault();


                    if(formPrivacy) {
                        form.find('.submit').addClass('loading').prop("disabled", true);
                        $.ajax({
                            type: "POST",
                            url: globalParams.ajax_url,
                            data: formData,
                            success: function(res) {
                                console.log(res);

                                form.trigger('reset');
                                form.find('.submit').removeClass('loading').prop("disabled", false);

                                if (res === 'email_sending_success') {
                                    $('.modal').modal('hide');

                                    if (formModalSuccess !== undefined && formModalSuccess !== '') {
                                        setTimeout(function () {
                                            $('.modal#' + formModalSuccess).modal('show');
                                        }, 500);
                                        setTimeout(function () {
                                            $('.modal#' + formModalSuccess).modal('hide');
                                        }, 5000);
                                    } else {
                                        alert('Сообщение успешно отправлено!');
                                    }

                                    // Yandex metrika send goals
                                    const ya_metrika_id = globalParams.ya_metrika_id;

                                    if (ya_metrika_id !== null && ya_metrika_id !== undefined && ya_metrika_id !== '') {
                                        if (formGoal !== undefined && formGoal !== '') {
                                            ym(Number(ya_metrika_id), 'reachGoal', formGoal);
                                        }
                                    }
                                } else {
                                    form.find('.info').addClass('is-active is-error').html('Во время отправки произошла ошибка');

                                    setTimeout(function() {
                                        form.find('.info').removeClass('is-active is-error').html('');
                                    }, 4000);
                                }

                            }
                        });
                        return false;
                    } else {
                        alert('Без согласия на обработку данных мы не может принять заявку');
                    }
        		}
        	});
        })();

	});

})(jQuery)