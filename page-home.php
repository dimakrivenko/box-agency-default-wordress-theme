<?php
/* Template Name: Главная страница */

get_header(); ?>

<section class="l-page">
	<div class="page-content">
		<div class="container">
	        <div class="row" style="margin-bottom: 100px;">
	            <div class="col-md-12">
	            	Главная страница
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-md-6">
	            	<button class="btn btn-primary" data-toggle="modal" data-target="#modalCallback">Модаль "Обратный звонок"</button>
	            	<br>
	            	<br>
	            	<button class="btn btn-primary" data-toggle="modal" data-target="#modalSuccess">Модаль "Спасибо"</button>
	            </div>
	            <div class="col-md-6">
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
	                    <div class="info"></div>
	                    <input type="hidden" name="form_name" value="Форма 1">
	                    <input type="hidden" name="modal_success" value="modalSuccess">
	                    <input type="hidden" name="ya_metrica_goal_name" value="goal1">
	                    <input type="hidden" name="action" value="send_message">
					</form>
	   			</div>
	        </div>
	    </div>
    </div>
</section>

<?php get_footer(); ?>