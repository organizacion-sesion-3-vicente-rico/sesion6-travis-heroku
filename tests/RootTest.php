<?php
use PHPUnit\Framework\TestCase;

require_once "apirest_variables.php";

class RootTest extends TestCase
{
    protected $tablasValidas;

    public function setUp()
    {
		global $tablas;
		
		$this->tablasValidas=array();
		foreach ($tablas as $key => $value) {
			$this->tablasValidas[]=$key;
		}
    }

    /** @test */
    public function rootGet() {
		global $servername;
		
		//$urlTest = 'http://localhost/github/datosjson?github=yes';
		$urlTest = 'http://localhost/github/datos.txt';
		//$urlTest = 'http://www.riconet.es/fp/apirest/libros/count';
		
        //url contra la que atacamos
        $ch = curl_init($urlTest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        //obtenemos la respuesta
        $response = curl_exec($ch);
 
		// Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);
		
		echo "\n\nJSON obtenido con el GET de ".$urlTest."\n";
		echo $response;

		//$data = json_decode($response, true);
		//$this->assertSame($data['params']['github'], 'yes');
		$this->assertSame($response, 'Hola');
		
    } 

}
?>
