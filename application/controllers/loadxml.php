<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loadxml extends CI_Controller {

	function php_info(){
		phpinfo();
	}

	public function index(){

		$tabla = "wc_bosques_coordenadas";
		$kml_file = "test";
		$tabla_campo = "idBosque";
		$index_campo = 0;

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$placemark = $kml_data->Document->Folder;

		$idObject = null;

		$output = "<pre>";
		$output .= "insert into ".$tabla." ( ".$tabla_campo.", longitude, latitude ) values \n";
		foreach($placemark->Placemark as $placemark){

			$coordenadas = explode("," , $placemark->Point->coordinates);

			$id_obj = $placemark->ExtendedData->SchemaData->SimpleData[$index_campo];

			if($idObject != $id_obj){
				$output .= "( " . $id_obj . ", " . $coordenadas[0] . ", " . $coordenadas[1] . " ),\n";
			}

			$idObject = $id_obj;
		}
		$output .= "</pre>";
		echo $output;
	}

	public function ecol_tipo(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_poligonos = "wc_ecologico_poligonos";

		$idTipo = $this->uri->segment(3);

		switch($idTipo){
			case 1:
				$kml_file = "ecol-bhdm"; break;
			case 2:
				$kml_file = "ecol-bsdc"; break;
			case 3:
				$kml_file = "ecol-bsdll"; break; // bad
			case 4:
				$kml_file = "ecol-bsmrc"; break;
			case 5:
				$kml_file = "ecol-bsmrll"; break; // bad
			case 6:
				$kml_file = "ecol-bsmrm"; break;
			case 7:
				$kml_file = "ecol-bsrc"; break; // bad
			case 8:
				$kml_file = "ecol-bsrll"; break; // bad
			case 9:
				$kml_file = "ecol-bsrm"; break; // bad
			case 10:
				$kml_file = "ecol-bssdc"; break; // bad
			case 11:
				$kml_file = "ecol-bssdll"; break; // bad
			case 12:
				$kml_file = "ecol-bssdm"; break; // bad
		}

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$placemark = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $placemark->Placemark;

		// poligonos
		echo "-- poligonos \n";

		foreach($placemarks as $placemark){

			/*if(isset($placemark->MultiGeometry)){

				foreach($placemark->MultiGeometry->Polygon as $polygon){

					$coordinates = trim($polygon->outerBoundaryIs->LinearRing->coordinates);

					echo "insert into ".$tabla_poligonos." ( idTipo, coordinates ) values ";
					echo "(" . $idTipo . ", '" .  $coordinates . "'); \n";
				}
			}else{*/

				$coordinates = trim($placemark->Polygon->outerBoundaryIs->LinearRing->coordinates);

				echo "insert into ".$tabla_poligonos." ( idTipo, coordinates ) values ";
				echo "(" . $idTipo . ", '" .  $coordinates . "'); \n";
			//}

		}
		echo "</pre>";
	}

	/*public function ecologico(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_poligonos = "wc_ecologico_poligonos";
		$tabla_coordenadas = "wc_ecologico_coordenadas";
		$kml_file = "ma/ecol";
		$index_campo = 4;

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$placemark = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $placemark->Placemark;

		// poligonos
		echo "-- poligonos \n";

		$idPoligono = 1;

		$idGrupo = 1;

		foreach($placemarks as $placemark){

			if(isset($placemark->MultiGeometry)){

				foreach($placemark->MultiGeometry->Polygon as $polygon){

						echo "insert into ".$tabla_poligonos." ( entry ) values ";
						echo "(" . $idPoligono . ");\n";

					$idPoligono += 1;
				}
			}else{

					echo "insert into ".$tabla_poligonos." ( entry ) values ";
					echo "(" . $idPoligono . ");\n";

				$idPoligono += 1;

			}
		}

		// coordenadas
		echo "-- coordenadas \n";

		$idPoligono = 1;

		foreach($placemarks as $placemark){

			if(isset($placemark->MultiGeometry)){

				foreach($placemark->MultiGeometry->Polygon as $polygon){

					$coordinates = trim($polygon->outerBoundaryIs->LinearRing->coordinates);

					echo "insert into ".$tabla_coordenadas." ( idPoligono, coordinates ) values ";
					echo "(" . $idPoligono . ", '" .  $coordinates . "'); \n";

					$idPoligono += 1;
				}
			}else{

				$coordinates = trim($placemark->Polygon->outerBoundaryIs->LinearRing->coordinates);

				echo "insert into ".$tabla_coordenadas." ( idPoligono, coordinates ) values ";
				echo "(" . $idPoligono . ", '" .  $coordinates . "'); \n";

				$idPoligono += 1;
			}

		}
		echo "</pre>";
	}*/

	public function distritos(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_poligonos = "wc_distritos";
		$tabla_coordenadas = "wc_distritos_coordenadas";
		$kml_file = "dst";

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$placemark = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $placemark->Placemark;

		// poligonos
		echo "\n-- poligonos \ninsert into ".$tabla_poligonos." \n";
		echo "( entry, entry2, nombre, idProvincia, idFrentes, frentes, pob2007, area ) values \n";

		//$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$idPolilinea = $placemark->ExtendedData->SchemaData->SimpleData[0];
			$idPolilinea2 = $placemark->ExtendedData->SchemaData->SimpleData[1];
			$nombre = $placemark->ExtendedData->SchemaData->SimpleData[2];
			$idProvincia = $placemark->ExtendedData->SchemaData->SimpleData[5] * 1;
			$idFrentes = $placemark->ExtendedData->SchemaData->SimpleData[6];
			$frentes = $placemark->ExtendedData->SchemaData->SimpleData[7];
			$pob2007 = $placemark->ExtendedData->SchemaData->SimpleData[9] * 1;
			$area = $placemark->ExtendedData->SchemaData->SimpleData[13];

				echo "(" .
					$idPolilinea . 
					", " . $idPolilinea2 .
					", '" . $nombre . "', " . 
					$idProvincia . ", " . 
					$idFrentes . 
					", '" . $frentes . "', " . 
					$pob2007 . ", " . 
					$area; 
				echo "),\n";

			//$idPolilinea += 1;

		}

		// coordenadas
		echo "\n-- coordenadas \ninsert into ".$tabla_coordenadas." \n( idPolilinea, longitude, latitude ) values \n";

		//$idPolilinea = 1;

		foreach($placemarks as $placemark){


			$idPolilinea = $placemark->ExtendedData->SchemaData->SimpleData[0];
			$idPolilinea2 = $placemark->ExtendedData->SchemaData->SimpleData[1];

			$coordinates = $placemark->Polygon->outerBoundaryIs->LinearRing->coordinates;

			$coordenadas = explode(" ", $coordinates);

			foreach($coordenadas as $punto_xy){
				
				$lat_lng = explode("," , $punto_xy);

				echo "(" . 
					$idPolilinea . ", " . 
					//$tipoBloque . ", " . 
					//$descripcion . "', " . 
					trim($lat_lng[0]) . ", " . 
					trim($lat_lng[1]) . "),";
				echo "\n";
			}

			//$idPolilinea += 1;

		}
		echo "</pre>";
	}

	public function rios(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_poligonos = "wc_rios";
		$tabla_coordenadas = "wc_rios_coordenadas";
		$kml_file = "rios";

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$folder = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $folder->Placemark;

		// poligonos
		/*echo "\n-- poligonos \ninsert into ".$tabla_poligonos." \n";
		echo "( entry, entry2, nombre, idProvincia, idFrentes, frentes, pob2007, area ) values \n";

		//$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$start = count($placemark->ExtendedData->SchemaData->SimpleData) == 5 ? 0 : 1;

			$nombre = ($start == 0) ? "" : $placemark->ExtendedData->SchemaData->SimpleData[0];
			$tipo = $placemark->ExtendedData->SchemaData->SimpleData[$start + 0];
			$estado = $placemark->ExtendedData->SchemaData->SimpleData[$start + 1];
			$codigo = $placemark->ExtendedData->SchemaData->SimpleData[$start + 2];
			$id = $placemark->ExtendedData->SchemaData->SimpleData[$start + 3];
			$length = $placemark->ExtendedData->SchemaData->SimpleData[$start + 4];

				echo "(" .
					"'" . $nombre . "'" . 
					", '" . $tipo . "'" . 
					", " . $estado .
					", '" . $codigo . "', " . 
					$id . ", " . 
					$length; 
				echo "),\n";

			//$idPolilinea += 1;

		}*/

		// coordenadas
		echo "\n-- coordenadas \ninsert into ".$tabla_coordenadas." \n";
		echo "( nombre, tipo, estado, codigo, id, size, longitude, latitude ) values \n";

		//$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$num_data = count($placemark->ExtendedData->SchemaData->SimpleData);

			if($num_data >= 5){

				$start = ($num_data == 5) ? 0 : 1;

				$nombre = ($start == 0) ? "" : $placemark->ExtendedData->SchemaData->SimpleData[0];
				$tipo = $placemark->ExtendedData->SchemaData->SimpleData[$start + 0];
				$estado = $placemark->ExtendedData->SchemaData->SimpleData[$start + 1];
				$codigo = $placemark->ExtendedData->SchemaData->SimpleData[$start + 2];
				$id = $placemark->ExtendedData->SchemaData->SimpleData[$start + 3];
				$length = $placemark->ExtendedData->SchemaData->SimpleData[$start + 4] * 1;

				$coordinates = trim($placemark->LineString->coordinates);

				$coordenadas = explode(" ", $coordinates);

				foreach($coordenadas as $punto_xy){
					
					$lat_lng = explode("," , trim($punto_xy));

					if(count($lat_lng) > 1){
						$longitude = trim($lat_lng[0]);
						$latitude = trim($lat_lng[1]);

						echo "(" . 
							"'" . $nombre . "', " . 
							"'" . $tipo . "', " . 
							$estado . ", " . 
							$codigo . ", " . 
							$id . ", " . 
							$length . ", " . 
							$longitude . ", " . 
							$latitude . "),";
						echo "\n";/**/
					}
				}
			}

			//$idPolilinea += 1;

		}
		echo "</pre>";
	}

	public function hidrografia(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_polilineas_test = "wc_hidrografia_polilineas_test";
		$tabla_poligonos = "wc_hidrografia_polilineas";
		$tabla_coordenadas = "wc_hidrografia_coordenadas";
		$kml_file = "riosf";

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$folder = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $folder->Placemark;

		// poligonos
		echo "\n-- poligonos\n";

		$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$num_data = count($placemark->ExtendedData->SchemaData->SimpleData);

			if($num_data >= 5){

				$start = 0;

				switch($placemark->ExtendedData->SchemaData->SimpleData[3]){
					case "NO" :
					case "SI" :
						$existe = 1;
						break;
					default:
						$existe = 0;
				}

				$nombre = "";
				if($num_data == 6 and !$existe){
					$nombre = $placemark->ExtendedData->SchemaData->SimpleData[0];
					$tipo = $placemark->ExtendedData->SchemaData->SimpleData[1];
					$estado = $placemark->ExtendedData->SchemaData->SimpleData[2];
					$codigo = $placemark->ExtendedData->SchemaData->SimpleData[3];
					$length = $placemark->ExtendedData->SchemaData->SimpleData[4];
					$id = $placemark->ExtendedData->SchemaData->SimpleData[5];
				}else if($num_data == 6 and $existe){
					$tipo = $placemark->ExtendedData->SchemaData->SimpleData[0];
					$estado = $placemark->ExtendedData->SchemaData->SimpleData[1];
					$codigo = $placemark->ExtendedData->SchemaData->SimpleData[2];
					$length = $placemark->ExtendedData->SchemaData->SimpleData[4];
					$id = $placemark->ExtendedData->SchemaData->SimpleData[5];
				}else if($num_data == 7) {
					$nombre = $placemark->ExtendedData->SchemaData->SimpleData[0];
					$tipo = $placemark->ExtendedData->SchemaData->SimpleData[1];
					$estado = $placemark->ExtendedData->SchemaData->SimpleData[2];
					$codigo = $placemark->ExtendedData->SchemaData->SimpleData[3];
					$length = $placemark->ExtendedData->SchemaData->SimpleData[5];
					$id = $placemark->ExtendedData->SchemaData->SimpleData[6];
				}else if($num_data == 5) {
					$tipo = $placemark->ExtendedData->SchemaData->SimpleData[0];
					$estado = $placemark->ExtendedData->SchemaData->SimpleData[1];
					$codigo = $placemark->ExtendedData->SchemaData->SimpleData[2];
					$length = $placemark->ExtendedData->SchemaData->SimpleData[3];
					$id = $placemark->ExtendedData->SchemaData->SimpleData[4];
				}

				$coordinates = trim($placemark->LineString->coordinates);

				echo "insert into ".$tabla_polilineas_test;
				echo " values ";

				echo "(" .
					$idPolilinea . ", " .
					"'" . $coordinates . "'"; 
				echo ");\n";
			}

			$idPolilinea += 1;

		}

		// coordenadas
		/*echo "\n-- coordenadas \n";
		$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$num_data = count($placemark->ExtendedData->SchemaData->SimpleData);

			if($num_data >= 5){

				$coordinates = trim($placemark->LineString->coordinates);

				$coordenadas = explode(" ", $coordinates);

				foreach($coordenadas as $punto_xy){
					$lat_lng = explode("," , trim($punto_xy));

					if(count($lat_lng) > 1){
						$longitude = trim($lat_lng[0]);
						$latitude = trim($lat_lng[1]);
					
						echo "insert into ".$tabla_coordenadas." ";
						echo "( idPolilinea, longitude, latitude ) values ";

						echo "(" . 
							$idPolilinea . ", " . 
							$longitude . ", " . 
							$latitude . ");";
						echo "\n";
					}
				}
			}

			$idPolilinea += 1;

		}*/
		echo "</pre>";
	}

	public function vias(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_polilineas_test = "wc_vias_polilineas_test";
		$tabla_polilineas = "wc_vias_polilineas";
		$tabla_coordenadas = "wc_vias_coordenadas";
		$kml_file = "vias";

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$folder = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $folder->Placemark;

		// poligonos
		/*echo "\n-- poligonos\n";

		//$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$entry = $placemark->ExtendedData->SchemaData->SimpleData[0];
			$obj_id = $placemark->ExtendedData->SchemaData->SimpleData[9] + 0;
			$size = $placemark->ExtendedData->SchemaData->SimpleData[5];
			$nombre = $placemark->ExtendedData->SchemaData->SimpleData[12];

			echo "insert into ".$tabla_polilineas;
			echo "( entry, obj_id, size, nombre )";
			echo " values ";

			echo "(" .
				$entry . ", " .
				$obj_id . ", " .
				$size . ", " .
				"'" . $nombre . "'"; 
			echo ");\n";

			//$idPolilinea += 1;

		}*/

		// coordenadas
		echo "\n-- coordenadas \n";
		//$idPolilinea = 1;

		foreach($placemarks as $placemark){

			$entry = $placemark->ExtendedData->SchemaData->SimpleData[0];

			$coordinates = trim($placemark->LineString->coordinates);

			///$coordenadas = explode(" ", $coordinates);

			//foreach($coordenadas as $punto_xy){
				//$lat_lng = explode("," , trim($punto_xy));

				//if(count($lat_lng) > 1){
					//$longitude = trim($lat_lng[0]);
					//$latitude = trim($lat_lng[1]);
				
					echo "insert into ".$tabla_coordenadas." ";
					echo "( idPolilinea, coordinates ) values ";

					echo "(" . 
						$entry . ", " . 
						"'".$coordinates . "');";
					echo "\n";
				//}
			//}
			//$idPolilinea += 1;

		}
		echo "</pre>";
	}

	public function forestal(){

		echo "<style>";
		echo "body { font-family: verdana; font-size: 12px; }";
		echo "</style>";

		$tabla_poligonos = "wc_forestal_poligonos";
		$tabla_coordenadas = "wc_forestal_coordenadas";
		$kml_file = "ma/fores";
		$index_campo = 4;

		$kml_data = simplexml_load_file('static/kml/'.$kml_file.'.kml');

		$placemark = $kml_data->Document->Folder;

		echo "<pre>";

		$placemarks = $placemark->Placemark;

		// poligonos
		echo "-- poligonos \n";

		$idPoligono = 1;

		$idGrupo = 1;

		foreach($placemarks as $placemark){

			if(isset($placemark->MultiGeometry)){

				foreach($placemark->MultiGeometry->Polygon as $polygon){

						echo "insert into ".$tabla_poligonos." ( entry ) values ";
						echo "(" . $idPoligono . ");\n";

					$idPoligono += 1;
				}
			}else{

					echo "insert into ".$tabla_poligonos." ( entry ) values ";
					echo "(" . $idPoligono . ");\n";

				$idPoligono += 1;

			}
		}

		// coordenadas
		echo "-- coordenadas \n";

		$idPoligono = 1;

		foreach($placemarks as $placemark){

			if(isset($placemark->MultiGeometry)){

				foreach($placemark->MultiGeometry->Polygon as $polygon){

					$coordinates = trim($polygon->outerBoundaryIs->LinearRing->coordinates);

					echo "insert into ".$tabla_coordenadas." ( idPoligono, coordinates ) values ";
					echo "(" . $idPoligono . ", '" .  $coordinates . "'); \n";

					$idPoligono += 1;
				}
			}else{

				$coordinates = trim($placemark->Polygon->outerBoundaryIs->LinearRing->coordinates);

				echo "insert into ".$tabla_coordenadas." ( idPoligono, coordinates ) values ";
				echo "(" . $idPoligono . ", '" .  $coordinates . "'); \n";

				$idPoligono += 1;
			}

		}
		echo "</pre>";
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */