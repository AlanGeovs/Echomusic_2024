<?php

require_once "../model/model.php";

$inventario=$_POST["inventario"];

$datosModel=array($inventario);
$tabla="inventario";

$respuesta=Consultas::filtroInventario($datosModel,$tabla);

if ($respuesta=="") {
	
}else{
	echo '<table class="table table-hover">';
        echo '<tbody>';
		for ($i=0; $i < count($respuesta); $i++) { 
            if (preg_match("/|\b/", $respuesta[$i]["IMG"])) {
                $fotos=explode("|",$respuesta[$i]["IMG"]);
                //var_dump($fotos);
                $total=count($fotos) - 1;
                $indice=mt_rand(0,intval($total));
                $img=substr($fotos[0],3);
                //echo $img."<br>";
                //echo "verdadero";
            }else{
                $img=substr($respuesta[$i]["IMG"], 3);
                //echo "falso";
            } 
            echo '<tr id="eliminar'.$respuesta[$i]["id"].'" class="no-b" >
                <td class="table-img">
                    <img src="'.$img.'" alt="" >
                </td>
                <td>
                    <h6>'.$respuesta[$i]["marca"].' '.$respuesta[$i]["modelo"].' '.$respuesta[$i]["ano"].'</h6>
                    <small class="text-muted">'.$respuesta[$i]["version"].'</small>
                </td>
                <td><div class="d-none d-lg-block">';
                $t=explode(",", $respuesta[$i]["CLASE"]);
                $r="";
                for ($j=0; $j < count($t); $j++) { 
                    $tags=Consultas::tagCategorias($t[$j]);
                    $r.=$tags["tag"]." | ";
                }
                echo substr($r,0,-2);
                
                echo '</div></td>
                <td>
                    <div class="d-none d-lg-block">
                    <span><i class="icon icon-tags2"></i> '.$respuesta[$i]["car_code"].'</span><br>
                    <span><i class="icon icon-tags"></i> '.$respuesta[$i]["condicion"].'</span>
                    </div>
                </td>
                <td>
                    <div class="d-none d-lg-block">
                    <span>Precio <b>$ '.number_format($respuesta[$i]["precio"],0).'</b></span><br>
                    <span>Kilometraje <b>'.number_format($respuesta[$i]["kilometraje"],0).' KM</b></span>
                    </div>
                </td>

                <td><div class="d-none d-lg-block">
                </div></td>

                <td>
                    <div class="d-none d-lg-block">
                    <span> '.strtoupper($respuesta[$i]["tipo"]).' </span><br>
                    <span> '.strtoupper($respuesta[$i]["transmision"]).' </span>
                    </div>
                </td>
                <td >
                    <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="editar_inventario.php?im='.$respuesta[$i]["id"].'"><i class="icon-pencil"></i></a>
                </td>
                <td >
                    <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="eliminarInventario('.$respuesta[$i]["id"].');"><i class="icon-trash"></i></a>
                </td>
            </tr>';
	      
		}
		echo '</tbody>';
    echo '</table>';
}

