<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 2018/12/28
 * Time: 14:39
 */
//猜数字游戏
//随机生成1-100的数字，
//用户在input 输入数字 与 生成的数字比较 根据比较在页面呈现出提示
session_start();

if(empty($_SESSION['num']) || empty($_GET['num']) ){
    $num = rand(1,100);
    //生成随机数，返回生成的数字  重新游戏/开始游戏
    $_SESSION['num'] = $num;
    $_SESSION['count'] = 0;
}else{
    //每猜一次加一次
    $count = $_SESSION['count'];
    $count++;
    $_SESSION['count'] = $count;
    if($count > 10){
        //结束游戏
        $message = 'low!';
        unset($_SESSION['num']);
        unset($_SESSION['count']);

    }else{
        $result = (int)$_GET['num']-$_SESSION['num'];
        if($result > 0){
            $message = '太大了';
        }elseif ($result < 0){
            $message = '小了';
        }else{
            $message = '对了';
            unset($_SESSION['num']);
            unset($_SESSION['count']);
        };
    };

};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>猜数字</title>
    <style>
        body {
            padding: 100px 0;
            background-color: #2b3b49;
            color: #fff;
            text-align: center;
            font-size: 2.5em;
        }
        input {
            padding: 5px 20px;
            height: 50px;
            background-color: #3b4b59;
            border: 1px solid #c0c0c0;
            box-sizing: border-box;
            color: #fff;
            font-size: 20px;
        }
        button {
            padding: 5px 20px;
            height: 50px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<h1>猜数字游戏</h1>
<p>Hi，我已经准备了一个0~100的数字，你需要在仅有的10机会之内猜对它。</p>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif ?>
<form action="index.php" method="get">
    <input type="number" min="0" max="100" name="num" placeholder="随便猜">
    <button type="submit">试一试</button>
</form>
</body>
</html>
