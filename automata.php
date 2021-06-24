<?php
include '../dat/cdb/db.php';
$txt=$_REQUEST['txt'];


   
$dir = "php/".$txt."/";
if (!file_exists($dir)) 
mkdir($dir, 0777, true);


//------------------------------------------------------------------------------db

//echo  'Archivo : db.php listo';
   
    $archivo = fopen($dir."db.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo, "<?php \r\n");
fwrite($archivo, '
$servidor  ="localhost"; 
$usuario   ="yaprendo_test";  
$clave     ="us1317mx$";
$basedatos ="yaprendo_ProyectoDan";
$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
	die("No se ha podido conectar a la base de datos");
}else
	echo mysqli_connect_error($db_connection);
');
fwrite($archivo,"?>\r\n");

fflush($archivo);
fclose($archivo);
}

//------------------------------------------------------------------------------landing


//echo  'Archivo : landing.php listo';
   
    $archivo = fopen($dir."landing.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo, "<?php \r\n");
fwrite($archivo, '
$servidor  ="localhost"; 
$usuario   ="yaprendo_test";  
$clave     ="us1317mx$";
$basedatos ="yaprendo_ProyectoDan";
$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
	die("No se ha podido conectar a la base de datos");
}else
	echo mysqli_connect_error($db_connection);
	

// sql Crea la tabla usando Lenguaje PHP
$sql = "CREATE TABLE Landing (
IdL INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Nombres VARCHAR(50) NOT NULL,
Apellidos VARCHAR(50) NOT NULL,
Correo VARCHAR(50),
Movil VARCHAR(20),
Msj VARCHAR(250),
Fecha TIMESTAMP,
Tipo INT(6) ,
Estado INT(6) 
)";

// Se verifica si la tabla ha sido creado
if ($db_connection->query($sql) === TRUE) {
    echo "la tabla Landing ha sido creado";
} else {
    echo "Hubo un error al crear la tabla Landing: " . $conn->error;
}
 
// Cerramos la conexi杌妌
$db_connection->close();	

');
fwrite($archivo," ?>");

fflush($archivo);
fclose($archivo);
}

 //------------------------------------------------------------------------------ landing2 
 
$txt1="Landing";
$consulta1 = "SELECT * FROM ".$txt1;
$resultado1=mysqli_query($db_connection, $consulta1);

$info_campo1 = mysqli_fetch_fields($resultado1);
$fila1 = mysqli_fetch_array($resultado1);
$field_cnt1 = $resultado1->field_count;

echo "</br>";
echo "</br>";

// INSERT INTO  
$cadena2="";
$sql1 = "INSERT INTO ".$txt1."(";   $primary1="";
$bus1=0;
   foreach ($info_campo1 as $valor) {
      $cadena2.=$valor->name.", ";
      if($bus1==1)
      $bus1=$valor->name;
      
      if($primary1==""){
      $primary1=$valor->name;
      $bus1=1;
      }
   } 
   $myString1 = substr($cadena2, 0, -2);
  $sql1.= $myString1.")";
  $c1="'";
  $p1=".";
  $sql1.=" VALUES (";
     foreach ($info_campo1 as $valor) {
      $cadena3.=' '.$c1.'"'.$p1.'$'.$valor->name.$p1.'"'.$c1.', ';
   } 
   $myString1 = substr($cadena3, 0, -2);
   $sql1.=$myString1.")";
   $insert_value =$sql1;
   

   
$archivo = fopen($dir."landing2.php","w+b");
if( $archivo == false ) {
echo "Error al crear el archivo";
    }
    else
    {
        

fwrite($archivo, "<?php \r\n");
fwrite($archivo, "include 'db.php'; \r\n");
       //REQUEST
foreach ($info_campo1 as $valor) {
     $recibe1= "$".$valor->name."= $"."_REQUEST['".$valor->name."'];";
     fwrite($archivo,$recibe1."\r\n");
   } 
fwrite($archivo, "\r\n");  
$c1="'";
$frac1= ' date_default_timezone_set("America/Mexico_City"); $script_tz = date_default_timezone_get(); $date = date("Y-m-d"); $time = date("H:i:s", time()); $Fecha= $date." ". $time; ';
fwrite($archivo, " \r\n");
fwrite($archivo, $frac1."\r\n");
$frac2='$resultado=mysqli_query($db_connection, "'.$consulta1.' WHERE '.$bus1.' LIKE '.$c1.'".$'.$bus1.'."'.$c1.'" ); ';
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, $frac2."\r\n");


$frac3='if (mysqli_num_rows($resultado)>0) {';
fwrite($archivo, " \r\n");
fwrite($archivo, $frac3."\r\n");
$frac4='header("Location: index.php?'.$primary1.'='.$c.'".$'.$primary1.'."'.$c1.'");  ';

fwrite($archivo, " \r\n");
fwrite($archivo, $frac4."\r\n");
$frac5='} else {  ';
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, $frac5."\r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, '$insert_value ="');
fwrite($archivo, $sql1);
$frac6='";';
fwrite($archivo, $frac6."\r\n");
fwrite($archivo,"\r\n");
fwrite($archivo, "\r\n");
fwrite($archivo,'$retry_value = mysqli_query($db_connection,$insert_value);');
fwrite($archivo, "\r\n");
fwrite($archivo,"\r\n");


fwrite($archivo,'$cuerpo="#: '.$c1.'".$'.IdL.'."'.$c1.' Nombres:'.$c1.'".$'.Nombres.'."'.$c1.' Movil: '.$c1.'".$'.Movil.'."'.$c1.'  Correo:'.$c1.'".$'.Correo.'."'.$c1.' Password: ( ayudar ) Como puedes ayudar? '.$c1.'".$'.Msj.'."'.$c1.' ";');
fwrite($archivo,"\r\n");
fwrite($archivo,'mail("jimmyvillatoro77@gmail.com","Prospecto",$cuerpo,"Dale seguimiento");');
//mail($subs_correo,'Gracias por Unirte al proyecto Mis Fieles ',$cuerpo,'Tus datos de acceso:');
//fwrite($archivo,'');


fwrite($archivo,"\r\n");
	
$frac7='$resultado=mysqli_query($db_connection, "SELECT '.$primary1.'  FROM  '.$txt1.'  WHERE '.$bus1.' = '.$c1.'".$'.$bus1.'."'.$c1.'" ); ';

fwrite($archivo, $frac7."\r\n");
fwrite($archivo, " \r\n");

$frac8=' while ($row =mysqli_fetch_array($resultado))   
$'.$primary1.'=$row['.$primary1.']; ';
fwrite($archivo, $frac8."\r\n");
fwrite($archivo, " \r\n");

$frac9=' header("Location: landing4.php?'.$primary1.'='.$c1.'".$'.$primary1.'."'.$c1.'"); ';

fwrite($archivo, $frac9."\r\n");
fwrite($archivo, " \r\n");


$frac10='mysqli_free_result($retry_value);';

fwrite($archivo, $frac10."\r\n");
fwrite($archivo, "}\r\n");

$frac11='mysqli_free_result($resultado);';
fwrite($archivo,$frac11."\r\n");
$frac12= 'mysqli_close($db_connection);';
fwrite($archivo,$frac12."\r\n");
fwrite($archivo,"?>");

fflush($archivo);
fclose($archivo);
}
//------------------------------------------------------------------------------ landing3 
//echo  'Archivo : '.$txt.'landing3.php listo';
   
    $archivo = fopen($dir."landing3.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
fwrite($archivo, '<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">');
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo,'<title>'.$txt1.'</title>
<meta name="keywords" content="">
<meta name="description: formulario Landing" content="">
<meta name="author: Jimmy Villatoro" content="">
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />');
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");    
   fwrite($archivo, '</head>
<!-- body -->
<body>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, '<p class="centrado">
<img src="images/recepcion1024x700.jpg"  alt="bienvenido"  width="1024" height="700" title="Exposici贸n de Landing page">
 </p>
');
fwrite($archivo, " \r\n");

fwrite($archivo, '
<div class="vfpop">
<h3>Registrarte</h3>
<form action="landing2.php" method="POST">');
$s1="$";
fwrite($archivo,"<input type='hidden' name=".$primary1." value='<?php echo utf8_decode(".$s1."_GET['".$primary1."']); ?>'>");

fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
 foreach ($info_campo1 as $valor) {
 
fwrite($archivo, "<div><input type='text' name='".$valor->name."'  class='form-control' placeholder='".$valor->name."' class='form-input' required>
                </div>  \r\n");
  
   }
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
   fwrite($archivo, "<div>
             <button type='submit' class='btn btn-success'>Registrarme</button>
             </div>
             </form>
              </div>\r\n");

fwrite($archivo, "</body>
</html>");

fflush($archivo);
fclose($archivo);
}

//------------------------------------------------------------------------------ landing4 
//echo  'Archivo : '.$txt.'landing4.php listo';
   
    $archivo = fopen($dir."landing4.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
fwrite($archivo, '<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">');
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo,'<title>'.$txt1.'</title>
<meta name="keywords" content="">
<meta name="description: formulario Landing" content="">
<meta name="author: Jimmy Villatoro" content="">
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />');
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");    
   fwrite($archivo, '</head>
<!-- body -->
<body>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, '<p class="centrado">
<img src="images/gracias1024x576.jpg"  alt="bienvenido"  width="1024" height="700" title="Exposici贸n de Landing page">
 </p>
');
fwrite($archivo, " \r\n");

fwrite($archivo, "</body>
</html>");

fflush($archivo);
fclose($archivo);
}


//------------------------------------------------------------------------------style

//echo  'Archivo : db.php listo';
   
    $archivo = fopen($dir."style.css","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo, " \r\n");
fwrite($archivo, '/*
project: css landingpage
author: Jimmy Villatoro
*/

body { font: .8em "Trebuchet MS", Verdana, Helvetica, sans-serif; color: #666;  background: #F7FCFF url(../images/bg.gif) repeat-x; }
a { color: #AF1515; cursor: pointer; }
a:hover { color: #7D1919; }
h1 { font-size: 3em; clear: both; margin: 0 0 5px; }
h2 { font: normal 1.6em Arial; color: #3D3C3B; margin: 0 0 15px; }
p  { margin: 0 0 15px; line-height: 1.7em; }

.background { background: url(../images/bg.jpg) no-repeat left 42px; }
/*---------------------------------------------------------------------
    popup begin css
---------------------------------------------------------------------*/

.vfpop {
	background: none repeat scroll 0 0 #FFA200;
	border: 1px solid #DDDDDD;
	border-radius: 6px 6px 6px 6px;
	top: 122px;
	left: auto;
	margin-left: 74px;
	padding: 10px 0 0;
	position: fixed;
	text-align: center;
	width: 290px;
	z-index: 15;
}

.btn {
background-color: #FF0000; /* Green */
border: 1px solid white;
color: white;
padding: 15px 32px;
border-radius: 6px 6px 6px 6px; 
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
}

.btn:hover {
	background-color: rgb(65, 199, 70); /* Green Claro */
	box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
	opacity: 0.5;
	color: white;
}



/*---------------------------------------------------------------------
    end popup css
---------------------------------------------------------------------*/


');

fwrite($archivo,"\r\n");

fflush($archivo);
fclose($archivo);
}



//------------------------------------------------------------------------------copy
echo "</br>";
$dir2 = "php/".$txt."/icon";
if (!file_exists($dir2)) 
mkdir($dir2, 0777, true);

copy('jquery-3.6.0.min.js', $dir.'/jquery-3.6.0.min.js');
copy('icon/email.png','php/'.$txt.'/icon/email.png');
copy('icon/facebook.png','php/'.$txt.'/icon/facebook.png');
copy('icon/fb.png','php/'.$txt.'/icon/fb.png');
copy('icon/google+.png','php/'.$txt.'/icon/google+.png');
copy('icon/insta.png','php/'.$txt.'/icon/insta.png');
copy('icon/instagram.png','php/'.$txt.'/icon/instagram.png');
copy('icon/lin.png','php/'.$txt.'/icon/lin.png');
copy('icon/linkedin.png','php/'.$txt.'/icon/linkedin.png');
copy('icon/location.png','php/'.$txt.'/icon/location.png');
copy('icon/strong.png','php/'.$txt.'/icon/strong.png');
copy('icon/tellephone.png','php/'.$txt.'/icon/tellephone.png');
copy('icon/tw.png','php/'.$txt.'/icon/tw.png');
copy('icon/twitter.png','php/'.$txt.'/icon/twitter.png');
copy('icon/world.png','php/'.$txt.'/icon/world.png');

$dir3 = "php/".$txt."/images";
if (!file_exists($dir3)) 
mkdir($dir3, 0777, true);
copy('images/logo.png','php/'.$txt.'/images/logo.png');
copy('images/recepcion1024x700.jpg','php/'.$txt.'/images/recepcion1024x700.jpg');
copy('images/gracias1024x576.jpg','php/'.$txt.'/images/gracias1024x576.jpg');
copy('images/search_icon.png','php/'.$txt.'/images/search_icon.png');


//------------------------------------------------------------------------------ ZIP 

/* primero creamos la función que hace la magia
 * esta funcion recorre carpetas y subcarpetas
 * añadiendo todo archivo que encuentre a su paso
 * recibe el directorio y el zip a utilizar 
 */
function agregar_zip($dir, $zip) {
  //verificamos si $dir es un directorio
  if (is_dir($dir)) {
    //abrimos el directorio y lo asignamos a $da
    if ($da = opendir($dir)) {
      //leemos del directorio hasta que termine
      while (($archivo = readdir($da)) !== false) {
        /*Si es un directorio imprimimos la ruta
         * y llamamos recursivamente esta función
         * para que verifique dentro del nuevo directorio
         * por mas directorios o archivos
         */
        if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {
          echo "<strong>Creando directorio: $dir$archivo</strong><br/>";
          agregar_zip($dir . $archivo . "/", $zip);
 
          /*si encuentra un archivo imprimimos la ruta donde se encuentra
           * y agregamos el archivo al zip junto con su ruta 
           */
        } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {
          echo "Agregando archivo: $dir$archivo <br/>";
          $zip->addFile($dir . $archivo, $dir . $archivo);
        }
      }
      //cerramos el directorio abierto en el momento
      closedir($da);
    }
  }
}
 
//fin de la función
//creamos una instancia de ZipArchive
$zip = new ZipArchive();
 
/*directorio a comprimir
 * la barra inclinada al final es importante
 * la ruta debe ser relativa no absoluta
 */
$dir = $dir;
 
//ruta donde guardar los archivos zip, ya debe existir
$rutaFinal = "php/";
 
if(!file_exists($rutaFinal)){
  mkdir($rutaFinal);
}
 
$archivoZip = $txt.".zip";
 
if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {
  agregar_zip($dir, $zip);
  $zip->close();
 
  //Muevo el archivo a una ruta
  //donde no se mezcle los zip con los demas archivos
  rename($archivoZip, "$rutaFinal/$archivoZip");
 
  //Hasta aqui el archivo zip ya esta creado
  //Verifico si el archivo ha sido creado
  if (file_exists($rutaFinal. "/" . $archivoZip)) {
    echo "Proceso Finalizado!! <br/><br/>
                Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";
  } else {
    echo "Error, archivo zip no ha sido creado!!";
  }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------indice begin

$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);
while ($row =mysqli_fetch_array($resultado)){   
 $dato=$row[$primary];
 $dato2=$row[$bus];
}


// sql Crea la tabla usando Lenguaje PHP
$sql = "CREATE TABLE Landing (
IdL INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Nombres VARCHAR(50) NOT NULL,
Apellidos VARCHAR(50) NOT NULL,
Correo VARCHAR(50),
Movil VARCHAR(20),
Msj VARCHAR(250),
Fecha TIMESTAMP,
Tipo INT(6) ,
Estado INT(6) 
)";

echo '</br> <p>CREATE TABLE Landing ( IdL INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, Nombres VARCHAR(50) NOT NULL, Apellidos VARCHAR(50) NOT NULL,
Correo VARCHAR(50), Movil VARCHAR(20), Msj VARCHAR(250), Fecha TIMESTAMP,Tipo INT(6) , Estado INT(6) )</p>
<a href="php/'.$txt.'/landing.php" >Crear Tabla para landing page</a></br>';
echo '</br>
<a href="php/'.$txt.'/landing3.php" >Ver landing page</a></br>';
//echo '<a href="php/'.$txt.'.zip" download="php/'.$txt.'.zip">Descargar en ZIP</a></br>'; 
echo "<a href='index.php'>Regresar</a>";

  

//------------------------------------------------------------------------------indice end

mysqli_free_result($resultado);
mysqli_close($db_connection);
?>
