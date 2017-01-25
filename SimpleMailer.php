<?php
/**
 * Класс-письмо
 * @author rib
 */
class SimpleMailer {
    /**
     * @var IErrorsCollector собрщик ошибок
     */
    public static $errorsCollector;

    /**
     * @var string E-mail обратной связи (указывается в письме в поле "От")
     */
    public static $feedback_email;

    /**
     * @var string От кого (подпись)
     */
    public $from;

    /**
     * @var string[]|string Кому (e-mail)
     */
    public $to;
    /**
     * @var string Тема письма
     */
    public $subject;
    /**
     * @var string Текст письма
     */
    public $body;

    /**
     * Конструктор письма
     * @param string[]|string $to e-mail адрес(а) получателя
     * @param string $subject тема
     * @param string $body текст
     */
    public function __construct($to=null, $subject=null, $body=null) {
        $this->to=$to;
        $this->subject=$subject;
        $this->body=$body;
    }

    /**
     * Отправки письма по адресу
     * @param string $email_addr адрес отправки
     * @return void
     */
    protected function sendEmail($email_addr) {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From:  =?utf-8?B?'.base64_encode($this->from).'?=<'.self::$feedback_email.'>' . "\r\n";

        mail($email_addr,
            "=?utf-8?B?".base64_encode($this->subject)."?=",
            $this->body,
            $headers
        );
    }

    /**
     * Отправка письма
     * @return void
     */
    public function send() {
        $error=false;
        if ($this->from==null) {
            $error=true;
            self::$errorsCollector->addError('Не указана подпись письма.');
        }
        if ($this->to==null) {
            $error=true;
            self::$errorsCollector->addError('Не указан адрес письма.');
        }
        if ($this->subject==null) {
            $error=true;
            self::$errorsCollector->addError('Не указана тема письма.');
        }
        if ($this->body==null) {
            $error=true;
            self::$errorsCollector->addError('Не указан текст письма.');
        }

        if (!$error) {
            if (is_array($this->to)) {
                foreach ($this->to as $email) {
                    $this->sendEmail($email);
                }
            }
            else {
                $this->sendEmail($this->to);
            }
        }
        else {
            self::$errorsCollector->addError('Ошибка отправки сообщения');
            self::$errorsCollector->printErrors(false);
        }
    }
}
