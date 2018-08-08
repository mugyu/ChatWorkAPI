# ChatWorkAPI

## Usage

```php
$chatWorkApi = new ChatWorkAPI(CHATWORK_TOKEN);

$chatWorkApi->me();
$chatWorkApi->me()->room();
$chatWorkApi->me()->room()->file($file_id);
$chatWorkApi->me()->room()->files();
$chatWorkApi->me()->room()->menbers();
$chatWorkApi->me()->room()->message($message_id);
$chatWorkApi->me()->room()->messages();
$chatWorkApi->me()->room()->task($task_id);
$chatWorkApi->me()->room()->tasks();
$chatWorkApi->my()->status();
$chatWorkApi->my()->tasks();
$chatWorkApi->my()->room();
$chatWorkApi->my()->room()->file($file_id);
$chatWorkApi->my()->room()->files();
$chatWorkApi->my()->room()->menbers();
$chatWorkApi->my()->room()->message($message_id);
$chatWorkApi->my()->room()->messages();
$chatWorkApi->my()->room()->task($task_id);
$chatWorkApi->my()->room()->tasks();
$chatWorkApi->contacts();
$chatWorkApi->rooms();
$chatWorkApi->room($room_id)->file($file_id);
$chatWorkApi->room($room_id)->files();
$chatWorkApi->room($room_id)->menbers();
$chatWorkApi->room($room_id)->message($message_id);
$chatWorkApi->room($room_id)->messages();
$chatWorkApi->room($room_id)->task($task_id);
$chatWorkApi->room($room_id)->tasks();
```
