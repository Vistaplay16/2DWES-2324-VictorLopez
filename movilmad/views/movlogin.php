<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - MovilMad</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    <h1>MOVILMAD</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">
		
		<form id="" name="form" action="../controllers/login.php" method="post" class="card-body">
		
		<div class="form-group">
			Email <input type="text" name="email" placeholder="email" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>
    </div>
    </div>
    </div>
    <script>
        document.forms['form'].addEventListener('submit', function(event){
            var email=document.getElementsByName('email')[0].value
            var pss=document.getElementsByName('password')[0].value
            console.log(email, pss)
            if(email=="" || pss==""){
                event.preventDefault();
                alert('Tienes que rellenar todos los datos');
            }
        })
    </script>

    
</body>
</html>


