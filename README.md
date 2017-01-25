## Synopsis

Simple mail sender class for PHP projects. Uses `mail()` function. You need ty specify `SimpleMailer::$errorsCollector` that implements `IErrorsCollector` interface for colleciong errors due working of this class.

## Code Example

```php
$mailer=new SimpleMailer();
$mailer->from="Rib Selezen";
$mailer->to=array("first@email.com","second@email.com","third@email.com");
$mailer->subject="Test mailer";
$mailer->body="This is the body";
$mailer->send();
```
