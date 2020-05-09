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
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$conn->set_charset("utf8");
		if ($conn->connect_error) {
			echo "ERROR en la conexión: " . $conn->connect_error;
		}
		$result = $conn->query("select count(*) as numregistros from empleados");
		if (!$result) {
			echo $conn->errno." - ".$conn->error;
		}
		
		$numregistros=-1;
		if ($result!=null) {
			if ($result->num_rows > 0) {
				while($registro = $result->fetch_array()) {
					$numregistros=$registro['numregistros'];
				}
			}
		}
		$conn->close();

		// COMPROBACIONES
		$this->assertSame(count($GLOBALS['tablas']), 1);

		$this->assertSame($data1['params']['github'], 'yes');
		
		$this->assertSame($numregistros, 7);
		
    } 

}
?>
