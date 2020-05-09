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
		
		// TEST 1
		$urlTest1 = 'http://localhost/index.php?action=datosjson&github=yes';
        $ch = curl_init($urlTest1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			$response1 = curl_exec($ch);
        curl_close($ch);
		
		echo "\n\nJSON obtenido con el GET de ".$urlTest1."\n";
		echo $response1;
		$data1 = json_decode($response1, true);

		// TEST 2
		$urlTest2 = 'http://localhost/index.php?action=empleados&value=count';
        $ch = curl_init($urlTest2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			$response2 = curl_exec($ch);
        curl_close($ch);
		
		echo "\n\nJSON obtenido con el GET de ".$urlTest2."\n";
		echo $response2;
		$data2 = json_decode($response2, true);


		$this->assertSame(count($GLOBALS['tablas']), 1);

		$this->assertSame($data1['params']['github'], 'yes');
		
		$this->assertSame($data2['total_registros'], '7');
		
    } 

}
?>
