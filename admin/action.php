<?php

  if(!empty($_POST["nama_layanan"])){

    /* RE-ESTABLISH YOUR CONNECTION */
    $con = new mysqli("localhost", "root", "", "laundry");

    /* CHECK CONNECTION */
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    /* PREPARE YOUR QUERY */
    $stmt = $con->prepare("SELECT  FROM layanan WHERE id_layanan = ?");
    $stmt->bind_param("i", $_POST["id_layanan"]); /* PARAMETIZE THIS VARIABLE TO YOUR QUERY */
    $stmt->execute(); /* EXECUTE QUERY */
    $stmt->bind_result($biaya_layanan); /* BIND THE RESULTS TO THESE VARIABLES */
    $stmt->fetch(); /* FETCH THE RESULTS */
    $stmt->close(); /* CLOSE THE PREPARED STATEMENT */

    /* RETURN THIS DATA TO THE MAIN FILE */
    echo json_encode(array("biaya_layanan" => $biaya_layanan));

  } /* END OF IF NOT EMPTY loadnumber */

?>
