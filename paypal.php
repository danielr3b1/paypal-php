<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" src="public/css/test.css" type="text/css"/>
    <title>Comprar por Paypal</title>
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    
    <!-- Paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=AZmWxPNw3GuDRUrhjZWDX9sQyGywq_UvfzTbBKLubKJfryOajnC7AZDwCmUvA3kV-j9ke5hjW-M8qh7s&currency=USD"></script>
</head>
<body style="background-color: #3972CF;">

  <?php
    $monto = $_GET["amount"];
  ?>

<section class="form-register">
    <h1>Realizar compra</h1>
    <label for="nombre">Nombres:</label>
    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese sus Nombres" required>
    <label for="nombre">Apellidos:</label>
    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese sus Apellidos" required>
    <label for="correo">Correo:</label>
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo" required>
    <label for="monto">Monto:</label>
    <input class="controls" type="text" name="monto" id="monto" placeholder="20" disabled value="<?= $monto?>">
    <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
    <div id="paypal-button-container"></div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Pago cancelado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.href='https://hostnation.store/carpetaPaypal/checkout/paypal.php?amount=200'">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>El pago ha sido cancelado.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='https://hostnation.store/carpetaPaypal/checkout/paypal.php?amount=200'">Volver</button>
      </div>
    </div>
  </div>
</div>
  <script>
    paypal.Buttons({
      style: {
          color:  'blue',
          shape:  'pill',
          label:  'pay',
          height: 40
      },
      createOrder: function(data, actions) {
          return actions.order.create({
              purchase_units:[{
                  amount: {
                    value: '<?= $monto?>'
                  }
              }]
          })
      },
      onApprove: function (data, actions) {
    actions.order.capture().then(function (detalles) {
        window.location.href="aprobado.php"
        });
      },
      onCancel:function (data) {
        $('#cancelModal').modal('show');
      }
    }).render("#paypal-button-container");
  </script>

</body>
</html>