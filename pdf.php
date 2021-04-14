<?php

require 'config/config.php';

require 'TCPDF-master/tcpdf.php';

// Connexion avec la database
$pdo = pdo_connect_mysql();

$mi = "Angel";


if (isset($_GET['pdf_btn']))
{
    $dd =date("d-m-Y", strtotime($_GET['date_debut']));  
     
    $df = date("d-m-Y", strtotime($_GET['date_fin']));

    if (isset($_GET['date_debut'],$_GET['date_fin']))
    {
        $q_rap = $pdo->prepare('SELECT * FROM tickets WHERE creation BETWEEN :date_debut AND :date_fin');
        $q_rap->bindParam(':date_debut', $_GET['date_debut']);
        $q_rap->bindParam(':date_fin', $_GET['date_fin']);
        $q_rap->execute();
        $rapports = $q_rap->fetchAll(PDO::FETCH_ASSOC);
    }
        
            
       


class pdf extends TCPDF
{
     public function Header(){
        // Logo
        $image_file = K_PATH_IMAGES.'cnigs.png';
        $this->Image($image_file,20,10,28,'','PNG','','T',false,300,'',false,false,0,false,false,false);
        // Set font
        $this->Ln(1);
        $this->SetFont('helvetica','B',12);
        // Title
        $moi ='ANGEL';
        $this->Cell(189,5,"Rapport de $moi",0,1,'C');

        $this->SetFont('helvetica','B',8);
        $this->Cell(189,3,'BUREAU 10, TURGEAU , HAITI',0,1,'C');
        $this->Cell(189,3,'PORT-AU-PRINCE',0,1,'C');
        $this->Cell(189,3,'DELMAS , 120',0,1,'C');
        $this->Cell(189,3,'EMAIL.COM',0,1,'C');
        $this->Cell(189,3,'48409219',0,1,'C');
        $this->SetFont('helvetica','B',11);
        $this->Ln(2);
        $this->Cell(189,3,'HELLO',0,1,'C');

     }

     /* public function Footer(){
        $this->SetY(-148);//15 mm a partir du bas
        $this->Ln(5);
        $this->SetFont('times','B',10);
        $this->MultiCell(189,15,'000000000000000000000000000000000000___________________00000
        0000000000000000000______________0000000000000',0,'L',0,1,'','',true);
     } */
}

// A4 paper 189 width
$pdf = new PDF('p','mm','A4'); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($mi);
$pdf->SetTitle('RAPPORT');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


$pdf->AddPage();

$pdf->Ln(18);

$pdf->SetFont('times','B',10);
$pdf->Cell(189,3,'From :-'.$dd,0,1,'C');
$pdf->Cell(189,3,'To :-'.$df,0,1,'C');
$pdf->Ln(5);


$pdf->SetFillColor(224,235,255);
$pdf->Cell(20,5,'ID Titre',1,0,'C',1);
$pdf->Cell(40,5,'Description',1,0,'C',1);
$pdf->Cell(20,5,'Statut',1,0,'C',1);
$pdf->SetFont('times','',10);
$pdf->ln(5);

$i = 1; //no of page start
$max = 7; //when sl no == 6 go to next page

      foreach($rapports as $rapport):
            {

                $titre = $rapport['id_titre'];
                $description = $rapport['description'];
                $statut = $rapport['statut'];

                if($i%$max==0){
                    

                        $pdf->AddPage();

                        $pdf->Ln(18);

                        $pdf->SetFont('times','B',10);
                        $pdf->Cell(189,3,'From :-'.$dd,0,1,'C');
                        $pdf->Cell(189,3,'To :-'.$df,0,1,'C');
                        $pdf->Ln(5);


                        $pdf->SetFillColor(224,235,255);
                        $pdf->Cell(20,5,'ID Titre',1,0,'C',1);
                        $pdf->Cell(40,5,'Description',1,0,'C',1);
                        $pdf->Cell(20,5,'Statut',1,0,'C',1);
                        $pdf->SetFont('times','',10);
                        $pdf->ln(5);

                }
                //$pdf->ln(5);
                $pdf->MultiCell(20, 20, $titre, 1, 'J', 0, 0, '', '', true, 0, false, true, 20, 'M', true);
                //$pdf->MultiCell(20, 20, $description, 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'M');
                $pdf->MultiCell(40, 20, $description, 1, 'J', 0, 0, '', '', true, 0, false, true, 20, 'M', true);
                $pdf->MultiCell(20, 20, $statut, 1, 'J', 0, 1, '', '', true, 0, false, true, 20, 'M', true);
                $i++;

            }
        endforeach;
}


// ---------------------------------------------------------

// Clean any content of the output buffer
ob_end_clean();

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php

/* // create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true); */

?>