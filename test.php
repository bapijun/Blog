<?php
/**
 * Created by PhpStorm.
 * User: wujun
 * Date: 2017/1/21
 * Time: 17:17
 */
$a=$_POST['name1'];
$b=$_POST['name2'];
?>


<html>
<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
    <input type='text' name='name1'>
    <input type='hidden' name='name2' value='value'>
    <input type='submit' value='提交'>
</form>
</html>
