<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  @paddleJS
</head>
<body>
  <form action="/payment" method="POST">
    @csrf
    <button type="submit">Заказать</button>
  </form>
</body>
</html>