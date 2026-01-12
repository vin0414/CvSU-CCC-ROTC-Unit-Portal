<?php

namespace App\Controllers;
use Dompdf\Dompdf;

class Export extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function exportMeritsDemerits()
    {
        $result = $this->db->table('reports a')
                ->select('a.*,b.lastname,b.firstname,b.middlename,c.fullname,d.fullname as user')
                ->join('students b','b.student_id=a.student_id','LEFT')
                ->join('accounts c','c.account_id=a.approver','LEFT')
                ->join('accounts d','d.account_id=a.user','LEFT')
                ->where('type_report !=','Violations')
                ->where('a.status',1)
                ->groupBy('a.report_id')
                ->get()->getResult();
        $image = FCPATH . 'assets/images/header.png';
        $imgData = base64_encode(file_get_contents($image));
        $src = 'data:image/png;base64,' . $imgData;

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 6px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <center>
                <img src='".$src."' />
            </center>
            <table>
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Details</th>
                        <th>Cadets</th>
                        <th>Points</th>
                        <th>Reported By</th>
                        <th>Approver</th>
                    </tr>
                </thead>
                <tbody>";
                foreach ($result as $row) {
                $html.='<tr>
                            <td>'.date('M d, Y h:i a',strtotime($row->created_at)).'</td>
                            <td>'.$row->violation.'</td>
                            <td>'.$row->category.'</td>
                            <td>'.$row->details.'</td>
                            <td>'.$row->lastname.',&nbsp;'.$row->firstname.'&nbsp;'.$row->middlename.'</td>
                            <td>'.$row->points.'</td>
                            <td>'.$row->user.'</td>
                            <td>'.$row->fullname.'</td>
                        </tr>';
                    }
                $html .= '
            </tbody>
        </table>
        </body>

        </html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Paper setup
        $dompdf->setPaper('A4', 'portrait');

        // Render
        $dompdf->render();

        // Stream to browser
        $dompdf->stream("merits-demerits.pdf", ["Attachment" => true]);
    }

    public function exportViolations()
    {
        $result = $this->db->table('reports a')
                ->select('a.*,b.lastname,b.firstname,b.middlename,c.fullname,d.fullname as user')
                ->join('students b','b.student_id=a.student_id','LEFT')
                ->join('accounts c','c.account_id=a.approver','LEFT')
                ->join('accounts d','d.account_id=a.user','LEFT')
                ->where('type_report','Violations')
                ->where('a.status',1)
                ->groupBy('a.report_id')
                ->get()->getResult();
        $image = FCPATH . 'assets/images/header.png';
        $imgData = base64_encode(file_get_contents($image));
        $src = 'data:image/png;base64,' . $imgData;

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 6px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <center>
                <img src='".$src."' />
            </center>
            <table>
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Details</th>
                        <th>Cadets</th>
                        <th>Reported By</th>
                        <th>Approver</th>
                    </tr>
                </thead>
                <tbody>";
                foreach ($result as $row) {
                $html.='<tr>
                            <td>'.date('M d, Y h:i a',strtotime($row->created_at)).'</td>
                            <td>'.$row->violation.'</td>
                            <td>'.$row->category.'</td>
                            <td>'.$row->details.'</td>
                            <td>'.$row->lastname.',&nbsp;'.$row->firstname.'&nbsp;'.$row->middlename.'</td>
                            <td>'.$row->user.'</td>
                            <td>'.$row->fullname.'</td>
                        </tr>';
                    }
                $html .= '
            </tbody>
        </table>
        </body>

        </html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Paper setup
        $dompdf->setPaper('A4', 'portrait');

        // Render
        $dompdf->render();

        // Stream to browser
        $dompdf->stream("violations.pdf", ["Attachment" => true]);
    }

    public function exportInventory()
    {
        $result = $this->db->table('inventory a')
        ->select('a.item,a.details,b.borrower,b.created_at,b.date_expected,c.created_at as date_return,c.status,c.remarks')
        ->join('borrow_item b','b.inventory_id=a.inventory_id','INNER')
        ->join('return_item c','c.borrow_id=b.borrow_id','LEFT')
        ->groupBy('b.borrow_id')->get()->getResult();
        $image = FCPATH . 'assets/images/header.png';
        $imgData = base64_encode(file_get_contents($image));
        $src = 'data:image/png;base64,' . $imgData;

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 6px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <center>
                <img src='".$src."' />
            </center>
            <h2>
                <center>Inventory Report</center>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Borrower's Name</th>
                        <th>Date Borrowed</th>
                        <th>Due Date</th>
                        <th>Date Returned</th>
                        <th>Conditions</th>
                    </tr>
                </thead>
                <tbody>";
                foreach ($result as $row) {
                if(!empty($row->date_return))
                {
                $html .= '<tr>
                    <td>'.$row->item.'</td>
                    <td>'.$row->details.'</td>
                    <td>'.$row->borrower.'</td>
                    <td>'.date('M d, Y H:i:s',strtotime($row->created_at)).'</td>
                    <td>'.date('M d, Y H:i:s',strtotime($row->date_expected)).'</td>
                    <td>'.date('M d, Y H:i:s',strtotime($row->date_return)).'</td>
                    <td>'.$row->remarks.'</td>
                </tr>';
                }
                else
                {
                $html .= '<tr>
                    <td>'.$row->item.'</td>
                    <td>'.$row->details.'</td>
                    <td>'.$row->borrower.'</td>
                    <td>'.date('M d, Y H:i:s',strtotime($row->created_at)).'</td>
                    <td>'.date('M d, Y H:i:s',strtotime($row->date_expected)).'</td>
                    <td>-</td>
                    <td>'.$row->remarks.'</td>
                </tr>';
                }
                }

                $html .= '
            </tbody>
        </table>
        </body>

        </html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Paper setup
        $dompdf->setPaper('A4', 'portrait');

        // Render
        $dompdf->render();

        // Stream to browser
        $dompdf->stream("inventory.pdf", ["Attachment" => true]);
    }
}