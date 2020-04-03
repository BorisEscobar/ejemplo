<?php
#require_once("conexion.php");

# RUTA PARA GUARDAR ARCHIVOS QUE SON SUBIDOS A MSQL 
	$ruta = 'Upload/';	
$destino = "";
print_r($_FILES)

	foreach ($_FILES as $key) {

		$nombre=$key["name"];
		$ruta_temporal=$key["tmp_name"];		
		
		$fecha=getdate();
		$nombre_v=$fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"]."_".$fecha["hours"]."-".$fecha["minutes"]."-".$fecha["seconds"].".csv";		
		echo "holallllll";
		$destino=$ruta.$nombre_v;
		$explo=explode(".",$nombre);


		if($explo[1] != "csv"){
			$alert=1;
		}else{

			if(move_uploaded_file($ruta_temporal, $destino)){
				$alert=2;
			}

		}

	}
	echo $destino;

# SE ABRE EL ARCHIVO CSV Y SE GUARDA EN $data
	$x=0;
	$data=array();
	$fichero=fopen($destino, "r");

	while(($datos= fgetcsv($fichero,1000)) != FALSE){

		$x++;
		if($x>1){

			$data[]='('.$datos[0].',"'.$datos[1].'",'.$datos[2].')';

		}

	}
print_r("<pre>");
	print_r($data);
print_r("<pre>");
/*

$ultimoRegistroCompras = "select max(idCompra) idCompra from compra ";
$ultimaComprar = mysqli_query($conecciom,$ultimoRegistroCompras);
$idUltimaCompraFila = mysqli_fetch_array($ultimaComprar);
$idUltimaCompra = $idUltimaCompraFila['idCompra'];
echo $idUltimaCompra;


for ($i=0; $i < sizeof($data) ; $i++) {  
	# CARGA DE DATOS DE CADA MES
	$aux_1 = explode(",",$data[$i]); # Usuario i de la Tabla nueva del mes 
	$aux_3 = $aux_1[0];
	$aux_5 = explode("(", $aux_3); # Cedulas Nueva lista
	$Cedula = $aux_5[1];
	$valor =  $aux_1[2];
	#echo 'lazo for'.$i."<br>";
	$idUltimaCompra++;
	$solicitud = "select * from usuarios where 1";
	$a = mysqli_query($conecciom,$solicitud);

	while ($fila = mysqli_fetch_array($a) ) { 

		$cedula = $fila["cedula"];
		$id = $fila["Id"];
		if (strcmp($Cedula, $cedula) === 0) {
			$aux = explode(")", $valor);
			$valor = $aux[0];
			echo "insert into compra value"."(".$idUltimaCompra.','.$id.","."1".",".$valor.","."4,"."1".")"."<br>";
			#echo "insert into usuarios value"."(".$id.",".$cedula.",".$valor.")"."<br>";
			$query = "insert into compra value"."(".$idUltimaCompra.','.$id.","."1".",".$valor.","."4,"."1".")";

			mysqli_query($conecciom,$query);

		}
	 	}
}
/*
?>