# ChatWorkAPI

## Usage

```php
$chatWorkAPI = new ChatWorkAPI(CHATWORK_TOKEN);

$chatWorkAPI->me();
$chatWorkAPI->me()->room();
$chatWorkAPI->me()->room()->file($file_id);
$chatWorkAPI->me()->room()->files();
$chatWorkAPI->me()->room()->menbers();
$chatWorkAPI->me()->room()->message($message_id);
$chatWorkAPI->me()->room()->messages($force = FALSE);
$chatWorkAPI->me()->room()->messages($force = FALSE)->post($content, $self_unread = FALSE);
$chatWorkAPI->me()->room()->task($task_id);
$chatWorkAPI->me()->room()->tasks();
$chatWorkAPI->my()->status();
$chatWorkAPI->my()->tasks();
$chatWorkAPI->my()->room();
$chatWorkAPI->my()->room()->file($file_id);
$chatWorkAPI->my()->room()->files();
$chatWorkAPI->my()->room()->menbers();
$chatWorkAPI->my()->room()->message($message_id);
$chatWorkAPI->my()->room()->messages($force = FALSE);
$chatWorkAPI->my()->room()->messages($force = FALSE)->post($content, $self_unread = FALSE);
$chatWorkAPI->my()->room()->task($task_id);
$chatWorkAPI->my()->room()->tasks();
$chatWorkAPI->contacts();
$chatWorkAPI->rooms();
$chatWorkAPI->room($room_id);
$chatWorkAPI->room($room_id)->file($file_id);
$chatWorkAPI->room($room_id)->files();
$chatWorkAPI->room($room_id)->menbers();
$chatWorkAPI->room($room_id)->message($message_id);
$chatWorkAPI->room($room_id)->messages($force = FALSE);
$chatWorkAPI->room($room_id)->messages($force = FALSE)->post($content, $self_unread = FALSE);
$chatWorkAPI->room($room_id)->task($task_id);
$chatWorkAPI->room($room_id)->tasks();
```
