<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#ERROR!</title>
</head>
<body>
    <?php
    
    $mensaje = "Usuario o password incorrectos";
    echo "<div style='width:100%; 
                      height: 100%;
                     margin-top:5rem;
                      display: flex;
                      justify-content: center;
                      align-items:center'>
    <div id='mensaje-alerta' style='
                        border: 2px solid #ccc;
                        padding: 20px; 
                        background-color: #f9f9f9;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-direction: column;
                        border: 1px solid #ccc;
                        padding: 10px;
                        background-color: rgba(55, 136, 242, 0.541);
                        border-radius: 10px;
                        border: 1px solid #green;
                        width:35%;
                        height: 15%;
                        font-size:20px
                        text-align: center;
                        margin-bottom: 30rem;
                        '>
    <p>$mensaje</p>
    <button onclick=\"window.location='../login.php'\" 
    style='width: 4rem; height: 2rem; background-color: #1fc64e'
    
    
    >OK</button>
  </div>
  </div>";
    
    
    
    
    
    ?>
</body>
</html>