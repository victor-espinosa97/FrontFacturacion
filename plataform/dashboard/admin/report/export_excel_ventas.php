<?php
session_start();
require_once '../config/global.php';
require_once '../config/log.php';
require_once '../config/http_client.php';
require_once '../../session/verifica_session.php';
date_default_timezone_set("America/Lima");
ini_set('display_errors', '1');
error_reporting( E_ALL );

require_once '../model/facturas.php';
require '../../ext/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};



class Exporta{
	
	private $facturas;
	private $data = array();
	
	public function __CONSTRUCT(){
		$this->facturas = new class_facturas();
	}
	
	public function Exportar_informe(){  
		
		
		$ventas = $this->facturas->reporte_general();
		
		
    	$date_actual = date('Y-m-d h:i');
    	$date = date('Y-m-d-h-i-s');
		$nombreArchivo = 'Informe_ventas_'.$date.'.xlsx'; 
		
		try{
			$excel = new Spreadsheet();	
			$hoja = $excel->createSheet();
        	$primer_hoja = true;
        	$hoja -> setTitle('Ventas');
			
			$hoja->getColumnDimension('A')->setWidth(10);
			$hoja->setCellValue('A1', 'Nro Factura');
			$hoja->getColumnDimension('B')->setWidth(30);
			$hoja->setCellValue('B1', 'Fecha');
			$hoja->getColumnDimension('C')->setWidth(30);
			$hoja->setCellValue('C1', 'Cliente');
			$hoja->getColumnDimension('D')->setWidth(20);
			$hoja->setCellValue('D1', 'Descripcion');
			$hoja->getColumnDimension('E')->setWidth(15);
			$hoja->setCellValue('E1', 'Subtotal');
			
			$contadorFila = 2;
			foreach($ventas as $r): 
				
				$hoja->setCellValue('A'.$contadorFila, $r['nroFactura']);
				$hoja->setCellValue('B'.$contadorFila, $r['fechaVenta']);
				$hoja->setCellValue('C'.$contadorFila, $r['cliente']['nombreCompleto']);
				$hoja->setCellValue('D'.$contadorFila, $r['descripcion']);
				$hoja->setCellValue('E'.$contadorFila, number_format($r['subTotal']));
				$contadorFila +=1;
												
			endforeach;
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$nombreArchivo.'"');
            header('Cache-Control: max-age=0');
            
            $writer = IOFactory::createWriter($excel, 'Xlsx');
            $writer->save('php://output');
            exit;
		}catch(Exception $e){
		  echo $e;
		}
		
	}
	
	
}
if(isset($_POST['btn_export_rep_ventas'])){
	
	if (isset ($_SESSION['SESION']))
    {
        $id = openssl_decrypt($_SESSION['SESION']['ID'], COD, KEY);
        
        if(is_numeric($id)){
    		call_user_func( array( new Exporta, 'Exportar_informe' ) );
    	}else{
    	    header('Location: ../');
    	}
    }else{
        header('Location: ../');
    }
}	

?>