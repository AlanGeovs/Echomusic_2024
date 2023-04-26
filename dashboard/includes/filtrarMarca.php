<?php

require_once "../model/model.php";

$marca=$_POST["marca"];

$datosModel=array($marca);
$tabla="marcas";

$respuesta=Consultas::filtroMarcas($datosModel,$tabla);

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
            echo '<tr id="eliminar'.$respuesta[$i]["ID"].'" class="no-b" >
                <td class="table-img">
                    <img src="'.$img.'" alt="" >
                </td>
                <td>
                    <h6>'.$respuesta[$i]["TITULAR"].'</h6>
                    <small class="text-muted">'.$respuesta[$i]["DENOM"].'</small>
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
                    <span>Num. Reg. '.$respuesta[$i]["NO_REG"].'</span><br>
                    <span>Num. Sol. '.$respuesta[$i]["NO_SOL"].'</span>
                    </div>
                </td>
                <td>
                    <div class="d-none d-lg-block">
                    <span><i class="icon icon-timer"></i> '.$respuesta[$i]["VIGENCIA"].'</span>
                    </div>
                </td>
                <td><div class="d-none d-lg-block">'.$respuesta[$i]["PAIS_ORI"].'
                </div></td>
                <td >
                    <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="editar_marca.php?im='.$respuesta[$i]["ID"].'"><i class="icon-pencil"></i></a>
                </td>
                <td >
                    <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="eliminarMarca('.$respuesta[$i]["ID"].');"><i class="icon-trash"></i></a>
                </td>
            </tr>';
	      
		}
		echo '</tbody>';
    echo '</table>';
}

