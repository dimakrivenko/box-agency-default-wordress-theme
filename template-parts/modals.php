
<!-- #modalCallback -->
<div class="modal fade" id="modalCallback" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal"></button>
            <h4 style="text-align: center; margin-bottom: 30px;">Оставьте заявку</h4>
            <form class="common-form" data-toggle="validator" role="form" data-focus="false" novalidate="true">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Имя">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Телефон" required>
                </div>
                <button class="btn btn-primary submit"><span>Отправить</span></button>
                <div class="privacy">
                    <label class="checkbox">
                        <input type="checkbox" name="privacy" checked="">
                        <i></i>
                    </label>
                    <p>Я даю согласие на обработку персональных данных и соглашаюсь c <a href="#" target="_blank">политикой конфиденциальности</a></p>
                </div>
                <input type="hidden" name="form_name" value="Форма в модали">
                <input type="hidden" name="modal_success" value="modalSuccess">
                <input type="hidden" name="ya_metrica_goal_name" value="">
                <input type="hidden" name="action" value="send_message">
                </form>
        </div>
    </div>
</div>

<!-- #modalSuccess -->
<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal"></button>
            <h4>Ваше сообщение успешно отправлено!</h4>
            <p>Мы свяжемся с вами в самое ближайшее время</p>
        </div>
    </div>
</div>