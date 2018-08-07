# ChatWorkAPI

## Usage

```php
$chatWorkApi = new ChatWorkAPI(CHATWORK_TOKEN);

$chatWorkApi->me();
$chatWorkApi->my()->status();
$chatWorkApi->my()->tasks();
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
