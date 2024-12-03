<?php
    require('rounded_rect.php');
    setlocale(LC_TIME, "Spanish_Mexican");

    // Verificar si el parámetro usuario está establecido
    if(isset($_GET['usuario'])) {
        $usuarioB = strtolower($_GET['usuario']);
        $nombreDB = "../BDatos/BDSugarAcademy.db";
        $db = new SQLite3($nombreDB);

        $sqlB = "SELECT * FROM Colegiaturas WHERE lower(Usuario) = '$usuarioB'";

        //Aqui estamos trayendo los datos del usuario que se está filtrando, no del de la sesión...
        $resultsB = $db->query($sqlB);

        $nombreB=""; $apellidosB = ""; $passwordB = ""; $correoB =""; $telefonoB = "";
        if ($rowB = $resultsB->fetchArray()) { //Aqui funciona si tiene datos
          $nombreB = $rowB['Usuario'];
          $AreaB = $rowB['Area'];
          $EstadoB = $rowB['Estado'];
          $MontoB = $rowB['Monto'];
          $AsigB = $rowB['Asignaciones'];
          $FecR = $rowB['FechaReg'];
        }
        $db->close();
    }

    // Si alguna de las variables está indefinida, asignar un valor por defecto para evitar errores
    
    //Logo y Encabezados
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Courier','B',20);
    $pdf->Cell(285,8,'',0,1,'C');

    $pdf->SetFont('Courier','B',16);
    $pdf->Cell(285,4,'Bueno por:',0,1,'C');
    $pdf->Image('logoVG.png',10,5,85,30);
    $pdf->Cell(285,12,'',0,1,'C');
    $Lugar =  utf8_decode('N°:');
    $pdf->Cell(285,2,$Lugar,0,1,'C');
    $pdf->Ln(25);
    $pdf->Cell(82,-9,' ', 0,1, 'R');
    $pdf->Ln(25); 

    $pdf->SetLineWidth(0);
    $pdf->SetFillColor(255, 108, 13);
    $pdf->RoundedRect(10, 40, 190, 8, 0, 'F');

    $pdf->Cell(53,-1,' ', 0,1, 'R');
    $pdf->RoundedRect(10,5,190,145, 1.5, 'D'); 

    $pdf->Cell(32,100,' ', 0,1, 'R');
    $pdf->Cell(52,-20,' ', 0,1, 'R');
    $pdf->Cell(56,113,' ', 0,1, 'R');

    $pdf->RoundedRect(13,129,100,18, 1.5, 'D');

    $pdf->Cell(40,-16,'', 0,0, 'R'); 
    $pdf->Cell(102,-16,'', 0,0, 'R');

    $pdf->SetFont('Courier','',12);
    $pdf->Cell(-113.5,-425,'RECIBI DE:', 0,0, 'R');
    $pdf->Line(38,58,190,58);

    $pdf->Cell(16,-400,'LA CANTIDAD DE $', 0,0, 'R');
    $pdf->Line(55,70.5,190,70.5);

    $pdf->Cell(140,-375,'(                                                                     )', 0,0, 'R');
    $pdf->Line(14.5,83.5,192,83.5);

    $pdf->Cell(-140,-350,'POR CONCEPTO DE:', 0,0, 'R');
    $pdf->Line(55,95.5,190,95.5);

    $pdf->Cell(125,-300, 'DURANGO, DGO.', 0,0, 'R');
    $pdf->Line(15,120.5,190,120.5);

    $pdf->Line(13,108,190,108);
    $pdf->Cell(-70,-270,'UNA VEZ REALIZADO EL PAGO, NO HABRA ', 0,0, 'R');   $pdf->Cell(-23,-255,'DEVOLUCIONES EN NINGUN CASO', 0,0, 'R');
    //x,grados,y,grados

    $pdf->Cell(85,-247, 'R E C I B I', 0,0, 'R');
    $pdf->Line(123,140.5,190,140.5);

    $pdf->SetFont('Courier','B',12);
    $pdf->SetXY(45,56); $pdf->Write(0,$nombreB);
    $pdf->SetXY(45,79); $pdf->Write(0,$EstadoB);
    $pdf->SetXY(59,69); $pdf->Write(0,$MontoB);
    $pdf->SetXY(59,93); $pdf->Write(0,$AsigB);
    $pdf->SetXY(60,119); $pdf->Write(0,$FecR);


   
    $pdf->Output();
?>
