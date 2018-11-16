<?php
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/user.php';
?>

<?php if (!User::userIsAuth()) {
    header('Location: inicio');

    $_SESSION['message'] = 'Parece que necesitas iniciar sesión antes de continuar...  ';
    die();
} ?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar Factura | <?php echo APP_NAME; ?></title>

	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <style type="text/css">
    /* Style the form */
#regForm {
  background-color: whitesmoke;
  margin: 10px auto;
  padding: 10px 10px;
  width: 85%;
  min-width: 300px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none; 
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

.table-ocean{
  
  color: white;
  padding: 0em 2em;

}

.table-ocean thead th{
  padding: 10px;
  background-color: #64ABFA;
  border-right: 1px solid white;
}
.table-ocean tbody tr th{
  margin: 10px;
}
.total-box{
  
}
.total-box ul{
  list-style-type: none;
}
  </style>




</head>
<body>
    <?php require_once 'includes/nav.php' ?>

<form id="regForm" action="generatePdf">

<h1 style="border-bottom: 1px dashed grey;">Crear nueva Factura</h1>

<!-- One "tab" for each step in the form: -->
<!-- PARTE CLIENTE -->
<div class="tab">

  <h5>Datos del Cliente</h5>
  <div> 

</div>
  <hr>
  <div class="form-row">
    <div class="col-md-6">
      <label>Nombre</label>
      <p><input type="text" class="form-control" placeholder="Nombre Completo..." ></p>
    </div>
    <div class="col-md-6">
      <label>Correo</label>
      <p><input type="email" class="form-control" placeholder="Correo..." ></p>
    </div>
    
    <div class="form-group col-md-12">

      <textarea class="form-control d-block" id="exampleFormControlTextarea1" rows="3"></textarea>
     </div>
  </div>

  <hr>
  <a href="">Seleccionar Cliente Existente</a>
</div>
<!-- FIN DATOS CLIENTE -->

<!-- PARTE DE PRODUCTOS -->
<div class="tab form-group">

    <p> Productos a Comprar:</p>
  
    <table class="table-ocean" style="margin-bottom: 30px;">

      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Producto</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Precio</th>
          <th>Añadir</th>
        </tr>
      </thead>

      <tbody class="productos-a-añadir">
        <tr>

          <td>
            <strong>1</strong>
          </td>
          
        <td>
          <input type="text" disabled class="form-control" placeholder="Producto">
        </td>
          
        
        <td>
          <input type="number" class="form-control" placeholder="Cantidad" >
        </td>
        
        <td>

        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">$</div>
            </div>
            <input type="number" min="0" class="form-control" name="">
        </div>
        </td>

        <td>
          <button class="btn btn-primary btn-sm"><i class="fas fa-box"></i>Seleccionar Producto</button>
        </td>
        
        </tr>
      </tbody>
       
    </div>

  </table>


 <div class="row">
    <div class="col-md-9">
  
    <div class="row">
      <div class="col-md-4">
        <a href="" class="btn btn-success btn-lg"><i class="fas fa-box"></i>Añadir Otro</a>
      </div>
      <div class="col-md-8">
        <h3>Añadir Nota</h3>
        <hr>
        <textarea class="form-control d-block" id="exampleFormControlTextarea1" rows="3"></textarea>
       
      </div>
    </div>
  </div>
  <div class="col-md-3 total-box">
    <ul>
      <li>
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">%</div>
            </div>
            <input type="number" placeholder="Descuento" min="0" class="form-control" name="" >
        </div>
      </li>
      
      <li><strong>Sub Total</strong></li>
      <li>$ 0 .00</li>

      <li><strong>Total</strong></li>
      <li>$ 0 .00</li>
    </ul>
  </div>
 </div>
</div> <!-- FIN DE TAB PRODUCTOS -->

<div style="overflow:auto;">
  <div style="float:right;">
    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
    <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
  </div>
</div>

<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center;margin-top:40px; display: none;">
  <span class="step"></span>
  <span class="step"></span>
</div>

</form>

    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <script type="text/javascript">
    
    var currentTab = 1; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form ...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      // ... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Crear";
      } else {
        document.getElementById("nextBtn").innerHTML = "Siguiente";
      }
      // ... and run a function that displays the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form... :
      if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid form-control";
          // and set the current valid status to false:
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish form-control";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active form-control", "");
      }
      //... and adds the "active" class to the current step:
      x[n].className += " active form-control";
    }

  </script>

</body>
</html>