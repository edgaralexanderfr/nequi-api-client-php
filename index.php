<?php  
/*
 * @description Utiliza el cliente del API de Nequi
 * @author michel.lugo@pragma.com.co, jomgarci@bancolombia.com.co
 */
	include 'clientAPI.php';

	echo "Test consumo API Nequi"."<br>"."<br>";

	/**
   * @todo TODO: Se debe crear el archivo keys.php con el número de teléfono
   */
	$validateClientResponse = validateClient("12345", $phoneNumber, "100");

	echo json_encode($validateClientResponse);

?>