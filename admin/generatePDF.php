<?php 
include '../config.php';
require_once('TCPDF-main/tcpdf.php');

$month = date('n');
$year = date('Y');

$totalMonthlyIncome = 0;
if(isset($_GET['monthpicker'])){
    $split = explode(" ",$_GET['monthpicker']);
    $month = $split[0];
    $year = $split[1];

    //sql to get the monthly income
    $sql = "SELECT 
            SUM(total_order_price) AS total,
            MONTH(date_created) AS bulan,
            YEAR(date_created) AS tahun
        FROM `costumer_order`     
        WHERE order_status = 'finished' 
        GROUP BY YEAR(date_created),MONTH(date_created)
        HAVING bulan = $month AND tahun = $year;";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $totalMonthlyIncome = $row['total'];  
                                                                              
        }
    }

    //sql to get 
    $sql = "SELECT COUNT(order_status) AS total 
    FROM `costumer_order` 
    WHERE order_status = 'finished' AND YEAR(date_created) = $year AND MONTH(date_created) = $month;";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $totalOrder = $row['total'];  
            if ($totalOrder == null) {
                $totalOrder = 0;
            }                                                                   
        }
    }

    //sql to get product sale operpiyu
    $sql = "SELECT 
                a.product_price,
                a.product_name, 
                b.total 
            FROM products  a LEFT JOIN 
                (
                        SELECT 
                            costumer_order.date_created AS date, 
                            costumer_order_products.product_id AS prodID,
                            SUM(costumer_order_products.quantity) AS total            
                        FROM `costumer_order_products` RIGHT JOIN costumer_order ON costumer_order_products.order_id = costumer_order.order_id  
                        GROUP BY YEAR(costumer_order.date_created),MONTH(costumer_order.date_created), prodID 
                        HAVING YEAR(costumer_order.date_created) = $year AND MONTH(costumer_order.date_created) = $month
                        ORDER BY `costumer_order`.`date_created` DESC
                ) b ON a.id = b.prodID  
            ORDER BY `b`.`total`  DESC";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        $myArray = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($myArray,$row);
        }        
    }

    if($month == 1){
        $prevMonth = 12;
        $prevYear = $year-1;        
    }else{
        $prevMonth = $month - 1;
        $prevYear = $year;
    }
    $sql = "SELECT 
                a.product_name, 
                b.total 
            FROM products  a LEFT JOIN 
                (
                        SELECT 
                            costumer_order.date_created AS date, 
                            costumer_order_products.product_id AS prodID,
                            SUM(costumer_order_products.quantity) AS total            
                        FROM `costumer_order_products` RIGHT JOIN costumer_order ON costumer_order_products.order_id = costumer_order.order_id  
                        GROUP BY YEAR(costumer_order.date_created),MONTH(costumer_order.date_created), prodID 
                        HAVING YEAR(costumer_order.date_created) = $prevYear AND MONTH(costumer_order.date_created) = $prevMonth
                        ORDER BY `costumer_order`.`date_created` DESC
                ) b ON a.id = b.prodID  
            ORDER BY `b`.`total`  DESC";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        $arrPrev = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($arrPrev,$row);
        }        
    }

    
}

class PDF extends TCPDF 
{
    public function Header(){
        
        $this->setFont('Helvetica','B',16);
        $this->Ln(5);
        $this->Cell(0,5,'Restaurant Binjai',0,1,'L',false);
        $this->setFont('Helvetica', 'I',8);
        $this->Cell(0,5,'Address: Kaliurang St No.Km. 14,5 Ngemplak, Sleman Regency, Special Region of Yogyakarta 55584',0,1,'L',false);
        $this->Cell(0,5,'Phone : +62 xxxxxxxxx Fax: xxxxxxxxxx',0,1,'L',false);
        $this->Cell(0,5,'E-mail : binjairestaurant@gmail.com',0,1,'L',false);
        $this->ln(3);
        $this->writeHTML('<hr>',true,false,true,false,'');

        
        
        

    }

    public function Footer(){
        $this->setY(-20);
        $this->Ln(5);
        $this->setFont('times','B',10);
        // $this->MultiCell(189,15,'the market order is valid for _______________ Days from date I/WE have deposited above _______________ Receives the above securities in advance in trus ',0,'L',false,1);

        // $this->Ln(2);
        // $this->cell(20,1,'________________________',0,0);
        // $this->Cell(118,1,'',0,0);
        // $this->Cell(51,1,'________________________',0,1);
        // $this->cell(20,5,'Authoirzed Admin',0,0);
        // $this->Cell(118,5,'',0,0);
        // $this->Cell(51,5,'Restaurant Owner',0,0);
        
        // $this->Cell(8,1,'',0,0);
        // $this->Cell(181,5,'Office Use',0,1);

        // $this->Ln(5);
        // $this->cell(100,5,'Transaction Instruction From (PAYIN)',0,1,'R');
        // $this->cell(89,5,'',0,1,'C');
        // $html = '<hr><p style="text-align:justify">asdasfenfafneknfkjnfnfkfjdfnefnefnefefnoienoemfelkwmlkmdfklemfioemfemfmefmef  sdmfsd f fosfskfnunw fowefmw fmwef wofi fuf efwe ffew fewfw fwof wfowf woifwe fowg g th y uj q dfrehy ergefgerhtrh yjyj7 je fe wfrwr5 th u jiy  ni n m h g frtd tfgvhjbjnj g tft rdt  v jbjbyvctxe b uygyf</p>';
        // $this->writeHTML($html,true,false,true,false,'');

        // $this->Ln(2);
        // $this->cell(20,1,'________________________',0,0);
        // $this->Cell(118,1,'',0,0);
        // $this->Cell(51,1,'________________________',0,1);
        // $this->cell(20,5,'Authoirzed Admin',0,0);
        // $this->Cell(118,5,'',0,0);
        // $this->Cell(51,5,'Restaurant Owner',0,0);
        
        // $this->Cell(8,1,'',0,0);
        // $this->Cell(181,5,'Office Use',0,1);

        $this->setFont('helvetica','I',8);
        //page number
        date_default_timezone_set("Asia/Jakarta");
        $today = date("F j, Y/ g:i A", time());

        $this->cell(25,5,'PDF GENERATE DATE/Time: ' .$today,0,0,'L');
        $this->cell(164,5,'page'.$this->getAliasNumPage().' of ' .$this->getAliasNbPages(),0,false,'R',0,'',0,false,'T','M');

        

    }
}


// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

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

//isi laporan 
$pdf->Ln(15);
$pdf->setFont('times', 'B', 14);
$pdf->Cell(189,1,'Monthly Report',0,1,'C');

$pdf->Ln(10);
$pdf->setFont('times', 'B', 12);
$monthNum  = $month;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F'); 
$pdf->cell(30,1,'Report as on',0,0);
$pdf->Cell(41,1,' :  '.$monthName." ".$year,0,0);
$pdf->Cell(118,1,'',0,1);

$pdf->Ln(2);
$pdf->cell(30,1,'Total Order',0,0);
$pdf->Cell(41,1,' :  '.$totalOrder." finished order",0,0);
$pdf->Cell(118,1,'',0,1);


function rupiah($angka){	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah; 
}

$pdf->Ln(2);
$pdf->cell(30,1,'Total Income',0,0);
$pdf->Cell(41,1,' :  '.rupiah($totalMonthlyIncome),0,0);
$pdf->Cell(118,1,'',0,1);


$pdf->Ln(4);
$pdf->setFont('Helvetica', 'B', 11);
$pdf->Cell(189,1,'Product Sale Overview',0,1,'C');

$pdf->Ln(3);
$pdf->setFont('times', 'B', 10);
$pdf->setFillColor(224,235,255);
$pdf->Cell(10,5,'No',1,0,'C',1);
$pdf->Cell(68,5,'Product Name',1,0,'C',1);
$pdf->Cell(15,5,'Qty Sale',1,0,'C',1);
$pdf->Cell(25,5,'Performance',1,0,'C',1);
$pdf->Cell(25,5,'Unit Price',1,0,'C',1);
$pdf->Cell(40,5,'Total Income',1,0,'C',1);

$no = 1;
for ($i=0; $i < count($myArray); $i++) { 
    $temp = $myArray[$i];
    $tempPrev = $arrPrev[$i];

    if($temp['total'] == null){
        $temp['total']=0;         
    }

    $selisih = $temp['total']-$tempPrev['total'];
    $val = $selisih;
    $sign = "";
    if($selisih < 0){
        $val = abs($selisih);
        $sign = "-";
    }else{
        $sign = "+";
    }

    $pdf->Ln(16);    
    $pdf->Cell(10,4,$no,0,0,'C');
    $pdf->Cell(68,4,$temp['product_name'],0,0,'C');
    $pdf->Cell(15,4,$temp['total'],0,0,'C');    
    if($sign == "-"){
        $pdf->setColor('text',255,0,0);
        $pdf->Cell(25,4,$sign." ".$val,0,0,'C');
        $pdf->setColor('text',0,0,0);
    }else{
        $pdf->setColor('text',0,170,0);
        $pdf->Cell(25,4,$sign." ".$val,0,0,'C');
        $pdf->setColor('text',0,0,0);
    }    
    $pdf->Cell(25,4,Rupiah($temp['product_price']),0,0,'C');
    $pdf->Cell(40,4,Rupiah($temp['total']*$temp['product_price']),0,0,'C');

    $no++;

    if($pdf->GetY() >= 250){
        $pdf->AddPage();
        $pdf->Ln(16);
        $pdf->Ln(3);
        $pdf->setFont('times', 'B', 10);
        $pdf->setFillColor(224,235,255);
        $pdf->Cell(10,5,'No',1,0,'C',1);
        $pdf->Cell(68,5,'Product Name',1,0,'C',1);
        $pdf->Cell(15,5,'Qty Sale',1,0,'C',1);
        $pdf->Cell(25,5,'Performance',1,0,'C',1);
        $pdf->Cell(25,5,'Unit Price',1,0,'C',1);
        $pdf->Cell(40,5,'Total Income',1,0,'C',1);
    }
}


$pdf->Ln(15);
$pdf->setFont('Helvetica','B',11);
$pdf->Cell(0,5,'Insight for the periods',0,1,'L',false);
$pdf->setFont('times','',12);
$pdf->MultiCell(189,15,$_GET['insight'],0,'L',false,1);



$pdf->Ln(26);
$pdf->cell(20,1,'________________________',0,0);
$pdf->Cell(118,1,'',0,0);
$pdf->Cell(51,1,'________________________',0,1);
$pdf->cell(20,5,'Authoirzed Admin',0,0);
$pdf->Cell(118,5,'',0,0);
$pdf->Cell(51,5,'Restaurant Owner',0,0);



// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

?>

