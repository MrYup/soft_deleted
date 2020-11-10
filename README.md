# Soft delete
This is a soft delete trait for yii2

Require yiisoft/yii2


## Installation

```sh
composer require simple/soft-delete
```

# Notice
make sure the table that needs soft-delete 
has the column marks whether the row was deleted,
generally named like `deleted_at`,`is_deleted`

# Default setting
```
    column name:is_delete
    sorft delete value:1
    un-sorft-deleted value:0

```


# Usage 
```php
<?php
use SoftDelete\SoftDelete;
class tableModel extends Model{
    use SoftDelete;
    
}

?>


```
