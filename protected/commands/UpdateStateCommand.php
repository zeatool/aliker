<?php
/**
 * Created by PhpStorm.
 * User: QUO
 * Date: 28.10.13
 * Time: 20:45
 */
class UpdateStateCommand extends CConsoleCommand {
    public function run($args) {
        Yii::import('ext.RussianPost.RussianPostAPI');
        $client = new RussianPostAPI()
        ;
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->SetFrom('noreply@aliker.ru', 'Aliker.ru');
        $mail->Subject = "New state";

        $models=Products::model()->findAll('disabled=0');
        foreach ($models as $m)
        {

            /*$mail->ClearAddresses();
            $mail->MsgHTML($message);
            $mail->AddAddress($email);
            $mail->Send();*/
        }


    }
}


?>