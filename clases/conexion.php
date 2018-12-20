<?php 
	/**
	 * 
	 */

	class conexion
	{	
		private $querys = array();
		private $con;
		private $adicionar;
		private $detallei ="";
		private $llaveprimaria = "";
		private $detallef = array();
		private $detalleespecialf = array();
		private $detalleespeciali;
		private $cabecera;
				private $datos =  array(
			'host' => "localhost:3306" ,
			'user' => "root" ,
			'pass' => "" ,
			'db' => "BdCautivo");
		/*

		
		private $datos =  array(
			'host' => "localhost" ,
			'user' => "root" ,
			'pass' => "" ,
			'db' => "sysofterp");
		*/
		public function __construct()
		{
			
			if (!isset($this->con))
			{
				$this->con = new \mysqli($this->datos['host'] ,$this->datos['user'] ,$this->datos['pass'] ,$this->datos['db']);
				if (mysqli_connect_errno())
				{
					trigger_error("Problemas en la conexion: " . mysqli_connect_errno(), E_USER_ERROR );
					
				}
			}
		}		
		private function __clone()
		{

		}		
		public function IngresarConsultas($query,$status)
		{
			$ret=array();
			$this->querys[] = $query;
			if($status)
			{
				$ret = $this->exe_transaction();
			}
			return $ret;
		}
		
		private function exe_transaction()
		{

			$ret = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$this->con->set_charset("utf8");
			$this->con->autocommit(FALSE);
			$this->con->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
			$resp=FALSE;
			for($i=0;$i < count($this->querys);$i++)
			{
				$resp = $this->con->query($this->querys[$i] );
				//var_dump($this->querys[$i]);exit;
			}			
			if($resp){
				if($this->con->commit())
				{
					$ret['STATUS']='OK';

				}else{
					$ret['ERROR'] = $this->con->error;
				}

			}else{
				$ret['ERROR'] = $this->con->error;
				$this->con->rollback();
			}
			unset($this->querys);
			//$this->close_conexion();
			return $ret;
		}
		public function exe_transaction_return_id($query)
		{

			$ret = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$this->con->set_charset("utf8");
			$this->con->autocommit(FALSE);
			$this->con->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
			$resp=FALSE;
			$resp = $this->con->query($query);
			$llaveprimaria = mysqli_insert_id($this->con);			
			if($resp){
				if($this->con->commit())
				{
					$ret['STATUS']='OK';
					$ret['ERROR'] = '' . $llaveprimaria;

				}else{
					$ret['ERROR'] = $this->con->error;
				}

			}else{
				$ret['ERROR'] = $this->con->error;
				$this->con->rollback();
			}
			unset($this->querys);
			//$this->close_conexion();
			return $ret;
		}
		public function IngresarCabecera($query,$adiciona)
		{			
			$this->cabecera = $query;
			$this->adicionar = $adiciona;
		}
		public function Ingresardetalle($detallei,$detallef,$llaveprimaria,$status)
		{
			$ret=array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$this->detallef[] = $detallef;
			$this->detallei = $detallei;
			$this->llaveprimaria = $llaveprimaria;
			if($status){
				$ret = $this->exe_transaction_full();
			}else{
				$ret['ERROR'] = "NO ESTABLECIDO COMO TRUE";		
			}			
			//$this->close_conexion();
			return $ret;
		}
		public function Ingresardetalle2($detallei,$detallef,$llaveprimaria,$status,$detalleespeciali,$detalleespecialf)
		{
			$ret=array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$float=array('CADENA' => '', 'ESPECIAL' => array());
			$this->detallei = $detallei;
			$this->llaveprimaria = $llaveprimaria;
			$this->detalleespeciali=$detalleespeciali;
			
			$float['CADENA'] = $detalleespecialf;
			$float['ESPECIAL'] = $detallef;
			$this->detalleespecialf[]=$float;
			if($status){
				$ret = $this->exe_transaction_full2();
			}else{
				$ret['ERROR'] = "NO ESTABLECIDO COMO TRUE";		
			}			
			//$this->close_conexion();
			return $ret;
		}
		public function establecercabecera($query,$status)
		{
			$ret=array();
			$this->detalle[] = $query;
			if($status){

				$ret = $this->exe_transactionfull();
			}			
			return $ret;
		}

		private function exe_transaction_full()
		{
			$ret = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$llaveprimaria = 0;
			$this->con->set_charset("utf8");
			$this->con->autocommit(FALSE);
			$this->con->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
			$respcabecera = FALSE;
			$respcabecera = $this->con->query($this->cabecera);
			//var_dump($this->con->error);exit;
			$llaveprimaria = mysqli_insert_id($this->con);
			if($respcabecera)
			{
				$ret['STATUS']='OK';
				
				for($i=0;$i < count($this->detallef);$i++)
				{
					$queryCompuesto = $this->detallei . " VALUES ( ". $llaveprimaria." , " . $this->detallef[$i] . ");";
					$resp = $this->con->query($queryCompuesto);
					//var_dump($queryCompuesto);
					//$codigo .="".mysqli_insert_id($this->con)."|";
				}
				if($resp){
					if($this->con->commit())
					{
						$ret['STATUS']='OK';
						$ret['ERROR'] = "" . $llaveprimaria;
						
					}else{
						$ret['STATUS']='ERROR';
						$ret['ERROR'] = "ERROR CONMIIT " . $this->con->error;
					}
				}else{
					$ret['STATUS']='ERROR';
					$ret['ERROR'] = "ERROR DETALLE :" . $llaveprimaria .": Error:" . $this->con->error;
					$this->con->rollback();
				}
			}else
			{
				
				$this->con->rollback();
				$ret['STATUS']='ERROR';
				$ret['ERROR'] = "ERROR CABECERA ". $this->con->error ;//. $this->con->error;
			}
			unset($this->detallef);
			unset($this->cabecera);
			//var_dump($ret);exit;
			//$this->close_conexion();
			return $ret;
		}
		private function exe_transaction_full2()
		{
			$ret = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$llaveprimaria = 0;
			$this->con->set_charset("utf8");
			$this->con->autocommit(FALSE);
			$this->con->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
			$respcabecera = FALSE;
			$respcabecera = $this->con->query($this->cabecera);
			//var_dump($this->con->error);exit;
			$llaveprimaria = mysqli_insert_id($this->con);
			if($respcabecera)
			{
				$ret['STATUS']='OK';
				
				for($i=0;$i < count($this->detalleespecialf);$i++)
				{
					$queryCompuesto = $this->detallei . " VALUES ( ". $llaveprimaria." , " . $this->detalleespecialf[$i]['ESPECIAL'] . ");";
					$resp = $this->con->query($queryCompuesto);
					$p_inidventad = mysqli_insert_id($this->con);
					$resp1=false;
					for($J=0;$J < count($this->detalleespecialf[$i]['CADENA']);$J++)
						{							
							$queryCompuesto1 = $this->detalleespeciali . " VALUES ( ". $p_inidventad." , " . $this->detalleespecialf[$i]['CADENA'][$J] . ");";
							$resp1 = $this->con->query($queryCompuesto1);
						}
					if($resp1){
						$ret['STATUS']='ERROR';
						$ret['ERROR'] = "ERROR CONMIIT " . $this->con->error;
					}
				}
				if($resp){
					if($this->con->commit())
					{
						$ret['STATUS']='OK';
						$ret['ERROR'] = "" . $llaveprimaria;
						
					}else{
						$ret['STATUS']='ERROR';
						$ret['ERROR'] = "ERROR CONMIIT " . $this->con->error;
					}
				}else{
					$ret['STATUS']='ERROR';
					$ret['ERROR'] = "ERROR DETALLE :" . $llaveprimaria .": Error:" . $this->con->error;
					$this->con->rollback();
				}
			}else
			{
				
				$this->con->rollback();
				$ret['STATUS']='ERROR';
				$ret['ERROR'] = "ERROR CABECERA ". $this->con->error ;//. $this->con->error;
			}
			unset($this->detallef);
			unset($this->cabecera);
			//var_dump($ret);exit;
			//$this->close_conexion();
			return $ret;
		}
		public function exe_str($query)
		{			
			$ret = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$this->con->set_charset("utf8");
			$resp = $this->con->query($query);
			if($resp)
			{
				$ret['STATUS']='OK';
			}else
			{
				$ret['ERROR'] = $this->con->error;
			}
			//$this->close_conexion();
			return $ret;
		}		
		
		public function exe_data($query)
		{
			$ret = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$this->con->set_charset("utf8");
			$resp = $this->con->query($query);
			if($resp)
			{
				$ret['STATUS']='OK';
				while ( $row = mysqli_fetch_array($resp))
				{
					$ret['DATA'][] = $row;
				}
			}else
			{
				$ret['ERROR'] = $this->con->error;
			}
			//$this->close_conexion();
			//var_dump(json_encode($ret));exit;		
			$this->close_conexion();
			return $ret;
		}
		public function close_conexion()
		{
			$this->con->close();
			
		}
	}
 ?>