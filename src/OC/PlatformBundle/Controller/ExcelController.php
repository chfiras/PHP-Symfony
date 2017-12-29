<?php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_Style_Color;


class ExcelController extends Controller
{

    public function ExcelAction()

    {

        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getFiches()
        ;

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();



        function cellColor($cells,$color,$phpExcelObject){


            $phpExcelObject->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }

        cellColor('A1', '0099ff',$phpExcelObject);
        cellColor('B1', '0099ff',$phpExcelObject);
        cellColor('C1', '0099ff',$phpExcelObject);
        cellColor('D1', '0099ff',$phpExcelObject);
        cellColor('A2', '0099ff',$phpExcelObject);
        cellColor('B2', 'b3d9ff',$phpExcelObject);
        cellColor('C2', 'b3d9ff',$phpExcelObject);
        cellColor('D2', 'b3d9ff',$phpExcelObject);

       $phpExcelObject->getActiveSheet()->mergeCells('B1:D1');

        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->applyFromArray($style);
        $phpExcelObject->getActiveSheet()->getStyle('A1:D2')->applyFromArray($style);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                )
            )
        );




        // ask the service for a excel object
        $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('D')->setWidth(20);


        $phpExcelObject->setActiveSheetIndex(0)

            ->setCellValue('A1', 'Client')->mergeCells("A1:A2")
            ->setCellValue('B1', 'Nom(s) de Domaine')->mergeCells("B1:C1:D1")
            ->setCellValue('B2','Nom de Domaine')
            ->setCellValue('C2', 'Date de création')
            ->setCellValue('D2', 'Date d\'expiration');

        $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
        $phpExcelObject->getActiveSheet()->getRowDimension(2)->setRowHeight(30);


        // Do whatever
        $i=3;
        $j=3;

        foreach ($em as $e)
        {

            $phpExcelObject->setActiveSheetIndex(0)

                ->setCellValue('A'.$i , $e->getClient());
            //$phpExcelObject->getActiveSheet()->getRowDimension($i)->setRowHeight(30);

            foreach($e->getNomDeDomaine() as $n)
            {
                $phpExcelObject->getActiveSheet()->getRowDimension($j)->setRowHeight(20);

                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('B'.$j, $n->getDomaine())

                    ->setCellValue('C'.$j , $n->getDateDeCreation()->format('d-M-Y'))

                    ->setCellValue('D'.$j , $n->getDateDExpiration()->format('d-M-Y'));

                $j++;

            }

            $phpExcelObject->getActiveSheet()->mergeCells("A".$i.":A".($j-1));
            $i=$j;



        }
        $phpExcelObject->getActiveSheet()->getStyle('A1:D'.($i-1))->applyFromArray($styleArray);


        $phpExcelObject->getActiveSheet()->getStyle('A1:D2')->getFont()->setBold(true);




        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Liste_des_domaines.xls"');

        // The save method is documented in the official PHPExcel library
        $writer->save('php://output');


        // Return a Symfony response (a view or something or this will thrown error !!!)

        return $this->redirectToRoute('oc_platform_listDomaine');


    }




    public function ExcelContactAction()

    {


        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getFiches()
        ;

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();


        function cellColor($cells,$color,$phpExcelObject){


            $phpExcelObject->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }

        cellColor('A1', '99ccff',$phpExcelObject);
        cellColor('B1', '99ccff',$phpExcelObject);
        cellColor('C1', '99ccff',$phpExcelObject);
        cellColor('D1', '99ccff',$phpExcelObject);
        cellColor('E1', '99ccff',$phpExcelObject);


        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->applyFromArray($style);
        $phpExcelObject->getActiveSheet()->getStyle('A1:E1')->applyFromArray($style);


        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                )
            )
        );

        // ask the service for a excel object
        $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(35);
        $phpExcelObject->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('E')->setWidth(30);


        $phpExcelObject->setActiveSheetIndex(0)

            ->setCellValue('A1', 'Client')
            ->setCellValue('B1', 'Responsable')
            ->setCellValue('C1', 'Site(s) web')
            ->setCellValue('D1', 'Téléphone/Fax')
            ->setCellValue('E1', 'Mail Principal');
        $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);

        // Do whatever
        $i=2;
        $j=2;
        $k=2;
        foreach ($em as $e)
        {

            $phpExcelObject->setActiveSheetIndex(0)

                ->setCellValue('A'.$i , $e->getClient());

            $phpExcelObject->setActiveSheetIndex(0)

                ->setCellValue('B'.$i , $e->getResponsable());

            foreach($e->getSiteWeb() as $n)
            {
                $phpExcelObject->setActiveSheetIndex(0)

                    ->setCellValue('C'.$k , $n->getName());

                $k++;

            }

            foreach($e->getTelFax() as $n)
            {
                $phpExcelObject->setActiveSheetIndex(0)

                    ->setCellValue('D'.$j , $n->getName());


                $j++;

            }

            $phpExcelObject->setActiveSheetIndex(0)

                ->setCellValue('E'.$i , $e->getMailPrincipal());


            $phpExcelObject->getActiveSheet()->mergeCells("A".$i.":A".(max(($j-1),($k-1))));
            $phpExcelObject->getActiveSheet()->mergeCells("B".$i.":B".(max(($j-1),($k-1))));
            $phpExcelObject->getActiveSheet()->mergeCells("E".$i.":E".(max(($j-1),($k-1))));


            $i=max($j,$k);
            $k=max($j,$k);
            $j=max($j,$k);

        }

        $phpExcelObject->getActiveSheet()->getStyle('A1:E'.($i-1))->applyFromArray($styleArray);



        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Infos_de_contact.xls"');

        // The save method is documented in the official PHPExcel library
        $writer->save('php://output');


        // Return a Symfony response (a view or something or this will thrown error !!!)

        return $this->redirectToRoute('oc_platform_listClient');


    }

    public function ExcelEmailsAction()

    {


        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getEmails()
        ;

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();


        function cellColor($cells,$color,$phpExcelObject){


            $phpExcelObject->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }

        cellColor('A1', '99ccff',$phpExcelObject);
        cellColor('B1', '99ccff',$phpExcelObject);
        cellColor('C1', '99ccff',$phpExcelObject);


        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->applyFromArray($style);
        $phpExcelObject->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style);


        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                )
            )
        );

        $phpExcelObject->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);

        // ask the service for a excel object
        $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(30);

        //$phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(20);


        $phpExcelObject->setActiveSheetIndex(0)

            ->setCellValue('A1', 'Client')
            ->setCellValue('B1', 'Mail Principal')
            ->setCellValue('C1', 'Email(s)');
        $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(40);



        $i=2;
        $j=2;

        foreach ($em as $e)
        {

            $phpExcelObject->setActiveSheetIndex(0)

                ->setCellValue('A'.$i , $e->getClient())
            ->setCellValue('B'.$i , $e->getMailPrincipal());

            foreach($e->getEmails() as $m)
            {
                $phpExcelObject->setActiveSheetIndex(0)

                    ->setCellValue('C'.$j , $m->getEmail());

                $j++;

            }
            $phpExcelObject->getActiveSheet()->mergeCells("A".$i.":A".($j-1));
            $phpExcelObject->getActiveSheet()->mergeCells("B".$i.":B".($j-1));

            $i=$j;

        }
        $phpExcelObject->getActiveSheet()->getStyle('A1:C'.($i-1))->applyFromArray($styleArray);

        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->applyFromArray($style);


        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Liste_des_Emails.xls"');

        $writer->save('php://output');


        return $this->redirectToRoute('oc_platform_listEmails');


    }

    public function ExcelFactureAction($fid)
    {
        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Facturation')
            ->find($fid)
        ;

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();


        function cellColor($cells,$color,$phpExcelObject){


            $phpExcelObject->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }

        cellColor('A1', '0099ff',$phpExcelObject);
        cellColor('B1', '0099ff',$phpExcelObject);
        cellColor('C1', '0099ff',$phpExcelObject);
        cellColor('A2', '99ccff',$phpExcelObject);
        cellColor('B2', '99ccff',$phpExcelObject);
        cellColor('C2', '99ccff',$phpExcelObject);


        $array[0]='Steg';
        $array[1]='Sonede';
        $array[2]='Télécom';
        $array[3]='Gestion des ressources';
        $array[4]='Salaire du personnel';
        $array[5]='Frais de location';
        $array[6]='Divers frais';


        if($em->getPeriode()->format("M") == 'Jan') {$month = 'Janvier';}
        elseif ($em->getPeriode()->format("M") == 'Feb') {$month = 'Février';}
        elseif ($em->getPeriode()->format("M") == 'Mar') {$month = 'Mars';}
        elseif ($em->getPeriode()->format("M") == 'Apr') {$month = 'Avril';}
        elseif ($em->getPeriode()->format("M") == 'May') {$month = 'Mai';}
        elseif ($em->getPeriode()->format("M") == 'Jun') {$month = 'Juin';}
        elseif ($em->getPeriode()->format("M") == 'Jul') {$month = 'Juillet';}
        elseif ($em->getPeriode()->format("M") == 'Aug') {$month = 'Aout';}
        elseif ($em->getPeriode()->format("M") == 'Sep') {$month = 'Septembre';}
        elseif ($em->getPeriode()->format("M") == 'Oct') {$month = 'Octobre';}
        elseif ($em->getPeriode()->format("M") == 'Nov') {$month = 'Novembre';}
        elseif ($em->getPeriode()->format("M") == 'Dec') {$month = 'Décembre';}


        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A1', 'Période : '.$month.$em->getPeriode()->format(' Y'))->mergeCells("A1:C1");
        $phpExcelObject->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('A1:C1')->getFont()->setSize(22);
        $phpExcelObject->getActiveSheet()->getStyle('A1:C1')->getFont()->getColor()->setRGB('ffffff');
        $phpExcelObject->getActiveSheet()->getRowDimension(1)->setRowHeight(50);


        $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(40);


        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A2','Catégorie')
            ->setCellValue('B2','Montant')
            ->setCellValue('C2','Note');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $phpExcelObject->getActiveSheet()->getStyle('A1:C2')->applyFromArray($style);
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->applyFromArray($style);

        $i=3;
        $j=3;
        $sum = 0;
        foreach ($array as $a)
        {
            $test = 0;
            foreach ($em->getblocFacture() as $b)
            {
                if($b->getcategorie() == $a)
                {
                    $phpExcelObject->getActiveSheet()->getRowDimension($j)->setRowHeight(-1);
                    if($test == 0)
                    {
                        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.$i,$b->getcategorie());
                        $test = 1;
                    }

                    $phpExcelObject->setActiveSheetIndex(0)->setCellValue('B'.$j,$b->getmontant().' Dt');

                    if($b->getnote() != null)
                    {
                        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C'.$j,$b->getnote());
                    }
                    else
                    {
                        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C'.$j,mb_convert_encoding("&empty;", 'UTF-8','HTML-ENTITIES'));
                    }
                    $j++;
                    $sum = $sum + $b->getmontant();
                }

            }
            if($j>$i)
            {
                $phpExcelObject->getActiveSheet()->mergeCells('A'.$i.':A'.($j-1));
            }
            $i=$j;
        }
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.$i,'Total :')->getStyle('A'.$i)->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->mergeCells('B'.$i.':C'.$i);
        $phpExcelObject->getActiveSheet()->getStyle('A'.$i)->getFont()->getColor()->setRGB('ff0000');
        $phpExcelObject->setActiveSheetIndex(0)->setCellValue('B'.$i,$sum.' DT')->getStyle('B'.$i)->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                )
            )
        );
        $phpExcelObject->getActiveSheet()->getStyle('A1:C'.$i)->applyFromArray($styleArray);

        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Facture'.$month.$em->getPeriode()->format(" Y").'.xls');

        $writer->save('php://output');


        return $this->redirectToRoute('oc_platform_listFactures');



    }
}
