<h2>Краткая инструкция</h2>

<p>Для начала вам необходимо пройти <a href="<?php print Yii::app()->createUrl("user/registration/"); ?>">процедуру регистрации на портале</a>.
Процедура достаточно простая, поэтому описывать ее смысла нет.<br>
После регистрации вам станет доступны пункты меню для работы с треками:</p>
<?php print CHtml::image(Yii::app()->createUrl("/i/help/1.png")) ?>
<p>Затем в форме добавления трека необходимо заполнить трекинговый номер и при желании ссылку на заказ на aliexpress формата (http://www.aliexpress.com/snapshot/XXXXXX.html)</p>
<?php print CHtml::image(Yii::app()->createUrl("/i/help/2.png")) ?>
<p>
    После заполнения номера трека и ссылки на ali нажимаем кнопку <a href="#" class="btn" ><i class="icon-refresh" title="Получить данные с али"/></i></a> и получаем изображение
    и наименование заказа вашего товара. После чего нажимаем добавить и данные о вашем заказе будут автоматически обновляться каждые два часа :)
</p>