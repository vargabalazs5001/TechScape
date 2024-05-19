<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="feedb_send.php" method="post">
        <label for="">Név</label>
        <input type="text" name="name" id="name">
        <label for="">Email</label>
        <input type="email" name="email" id="email">
        <label for="">Megjegyzés</label>
        <textarea name="comment" id="comment" cols="50" rows="15"></textarea>
        <br>
        <br>
        <input type="submit" value="Küldés">
        <input type="submit" value="Mégse">
    </form>
</body>
</html>