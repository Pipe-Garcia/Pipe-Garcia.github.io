<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco nación - Resultado de la Solicitud Enviada</title>
    <link rel="icon" type="image/jpg" href="./assets/logos/BNA-favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007894;
            display: flex;
            justify-content: space-between;
            padding: 20px 200px;
        }
        header ul {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }
        header ul li {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 150px;
            height: 40px;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        header ul li img {
            width: 20px;
            height: 20px;
        }
        .header-hb {
            color: white;
            background-color: #00586d;
            width: auto;
        }
        .header-hb:hover {
            background-color: #03a8cd;
        }
        .header-sol {
            background-color: white;
            color: rgb(154, 153, 153);
            width: auto;
        }
        .header-sol:hover {
            background-color: #ededed;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: auto;
            margin-top: 25px;
        }
        .container {
            border: 2px solid #007894;
            border-radius: 6px;
            padding: 10px 15px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            font-family: 'Onest', sans-serif;
        }
        .back-site {
            background-color: skyblue;
            padding: 5px 10px;
            border-radius: 4px;
            margin: 25px 0px;
            font-size: 20px;
            font-family: 'Onest', sans-serif;
        }
        .back-site:hover {
            cursor: pointer;
            border: 2px solid #007894;
            background-color: white;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>

        <figure>
            <img src="./assets/logos/Logo_BNA-Header.svg" alt="logo-bna">
        </figure>

        <ul>
            <li class="header-sol">
                <p>Solicitud de Turnos</p>
                <img src="./assets/icons/header-calendar.svg" alt="calendar-logo">
            </li>
            <li class="header-hb">
                <p>Home Banking</p>
                <img src="./assets/icons/header-lock.svg" alt="lock-logo">
            </li>
        </ul>

    </header>

    <main>

        <div class="container">

            <h1>Banco Nación</h1>

            <p>¡Hola <b> <?php echo $_POST['nom-ape']; ?>! </b> </p>

            <p>
    
            <?php
        if (isset($_POST["servicios"])) {
            $servicios = $_POST["servicios"];
            if (!empty($servicios)) {
                echo "Ha seleccionado los siguientes servicios:<br>";
                echo "<ul>";
                foreach ($servicios as $servicio) {
                    echo "<li><strong> $servicio </strong></li>";
                }
                echo "</ul>";
            } else {
                echo "No ha seleccionado ningún servicio del Banco.";
            }
        }
        ?>

            </p>

            <p> Paquete seleccionado: <b> <?php echo $_POST['paquetes']; ?> </b> </p>

            <p> Le quedaría <?php
            if (isset($_POST["paquetes"])) {
                $paquete = $_POST["paquetes"];
                $monto = 0;
                $interes = 0;

                switch ($paquete) {
                    case "Paquete de $1.000 con el 5.0% interés":
                        $monto = 10000;
                        $interes = 5.0;
                        break;
                    case "Paquete de $5.000 con el 6.5% interés":
                        $monto = 50000;
                        $interes = 6.5;
                        break;
                    case "Paquete de $10.000 con el 8.0% interés":
                        $monto = 100000;
                        $interes = 8.0;
                        break;
                }

                echo "un crédito de <strong>$$monto pesos</strong>";
            }
            ?>
            </p>

            <p> Pago mensual: 
            
            <?php
                if (isset($_POST["pago"])) {
                    $pago = $_POST["pago"];
                    echo "<strong>$$pago</strong>";
                }
            ?>
            
            </p>

            <p> La duración es de: 
                
            <?php
            if (isset($monto) && isset($pago) && $pago > 0) {
                $duracion = 0;

                $interesDecimal = $interes / 100;
                $duracion = ceil(log($pago / ($pago - ($monto * $interesDecimal / 12))) / log(1 + ($interesDecimal / 12)));

                if ($duracion > 0) {
                    echo "<strong>$duracion meses</strong> con un porcentaje de intereses del <strong>$interes%</strong>";
                } else {
                    echo "Ud. debería realizar un pago mensual mayor!";
                }
            }
            ?>
        
            </p>

            <p> 
                
            <?php
            if (isset($_POST["publicaciones"])) {
                if ($_POST["publicaciones"] == "on" && isset($_POST["email"]) && !empty($_POST["email"])) {
                    $correoElectronico = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                    echo "Enviaremos nuestras publicaciones a <strong>$correoElectronico</strong>";
                } else {
                    echo "No desea recibir publicaciones";
                }
            }
            
            ?>
        
            </p>

            <p>Monto final:
                 
            <?php 
            
            $montoTotal = (($monto * $interesDecimal )+ $pago) * $duracion;

            echo "<strong> $montoTotal </strong>";

            ?>     
            
            </p>

            <p> ¡Gracias por utilizar nuestros servicios! </p>

        </div>

        <p class="back-site">Pulsa <a href="index.html">aquí</a> para regresar al sitio.</p>

    </main>
</body>
</html>