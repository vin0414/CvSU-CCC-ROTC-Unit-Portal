<?php
namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelScanner extends BaseController
{
    public function upload()
    {
        $file = $this->request->getFile('file');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filePath = WRITEPATH . 'uploads/' . $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $file->getRandomName());

            return $this->scan($filePath);
        }

        return $this->response->setJSON(['error' => 'Invalid file']);
    }

    private function scan(string $filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = [];

        foreach ($sheet->getRowIterator() as $row) 
        {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) 
            {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
        }

        return $this->response->setJSON(['data' => $data]);
    }
}