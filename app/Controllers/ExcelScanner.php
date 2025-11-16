<?php
namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;
use \App\Models\performanceModel;
use \App\Models\studentModel;

class ExcelScanner extends BaseController
{
    public function upload()
    {
        $validation = $this->validate([
            'subject'=>'is_unique[student_performance.subject_id]'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['error' => 'Subject already exists.']);
        }
        else
        {
            $file = $this->request->getFile('file');
            $subject = $this->request->getPost('subject');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $uploadPath = WRITEPATH . 'uploads/'; // Use writable/uploads directory
                $file->move($uploadPath, $newName);

                return $this->scan($uploadPath . $newName,$subject); // Pass full path
            }
            return $this->response->setJSON(['error' => 'Invalid file']);
        }
    }

    private function scan(string $filePath,$subject)
    {
        $spreadsheet = IOFactory::load($filePath);
        $id = $subject;
        $sheet = $spreadsheet->getActiveSheet();
        $model = new performanceModel();
        $studentModel = new studentModel();

        $columnsToRead = ['C', 'E', 'F','G','H','I','J','L','M','N','O','P','Q','W','X','Y','AA','AB','AC','AE','AF','AG','AH','AI'];
        $startRow = 19;
        $highestRow = $sheet->getHighestRow();
        $columnIndexes = array_flip($columnsToRead);
        $columnMap = [
            'school_id' => $columnIndexes['C'],
            'attendanceScore' => $columnIndexes['E'],
            'attendanceValue' => $columnIndexes['F'],
            'attendancePercentage' => $columnIndexes['G'],
            'physicalScore' => $columnIndexes['H'],
            'physicalValue' => $columnIndexes['I'],
            'physicalPercentage' => $columnIndexes['J'],
            'appearanceScore' => $columnIndexes['L'],
            'appearanceValue' => $columnIndexes['M'],
            'appearancePercentage' => $columnIndexes['N'],
            'disciplineScore' => $columnIndexes['O'],
            'disciplineValue' => $columnIndexes['P'],
            'disciplinePercentage' => $columnIndexes['Q'],
            'qualitiesScore' => $columnIndexes['W'],
            'qualitiesValue' => $columnIndexes['X'],
            'qualitiesPercentage' => $columnIndexes['Y'],
            'leadershipScore' => $columnIndexes['AA'],
            'leadershipValue' => $columnIndexes['AB'],
            'leadershipPercentage' => $columnIndexes['AC'],
            'workScore' => $columnIndexes['AE'],
            'workValue' => $columnIndexes['AF'],
            'workPercentage' => $columnIndexes['AG'],
            'finalScore' => $columnIndexes['AH'],
            'finalGrade' => $columnIndexes['AI'],
        ];

        $batchData = [];

        for ($row = $startRow; $row <= $highestRow; $row++) {
            $rowData = [];

            foreach ($columnsToRead as $col) {
                $cell = $sheet->getCell($col . $row);
                $value = $cell->getCalculatedValue();
                $rowData[] = $value !== null ? $value : '';
            }

            if (array_filter($rowData)) {
                $schoolId = $rowData[$columnMap['school_id']];
                $students = $studentModel->where('school_id', $schoolId)->findAll();

                if (empty($students)) {
                    log_message('warning', "No students found for school_id: {$schoolId} at row {$row}");
                    continue;
                }

                foreach ($students as $student) {
                    $batchData[] = [
                        'subject_id' => $id,
                        'student_id' => $student['student_id'],
                        'attendanceScore' => $rowData[$columnMap['attendanceScore']] ?? 0,
                        'attendanceValue' => $rowData[$columnMap['attendanceValue']] ?? 0,
                        'attendancePercentage' => $rowData[$columnMap['attendancePercentage']] ?? 0,
                        'physicalScore' => $rowData[$columnMap['physicalScore']] ?? 0,
                        'physicalValue' => $rowData[$columnMap['physicalValue']] ?? 0,
                        'physicalPercentage' => $rowData[$columnMap['physicalPercentage']] ?? 0,
                        'appearanceScore' => $rowData[$columnMap['appearanceScore']] ?? 0,
                        'appearanceValue' => $rowData[$columnMap['appearanceValue']] ?? 0,
                        'appearancePercentage' => $rowData[$columnMap['appearancePercentage']] ?? 0,
                        'disciplineScore' => $rowData[$columnMap['disciplineScore']] ?? 0,
                        'disciplineValue' => $rowData[$columnMap['disciplineValue']] ?? 0,
                        'disciplinePercentage' => $rowData[$columnMap['disciplinePercentage']] ?? 0,
                        'qualitiesScore' => $rowData[$columnMap['qualitiesScore']] ?? 0,
                        'qualitiesValue' => $rowData[$columnMap['qualitiesValue']] ?? 0,
                        'qualitiesPercentage' => $rowData[$columnMap['qualitiesPercentage']] ?? 0,
                        'leadershipScore' => $rowData[$columnMap['leadershipScore']] ?? 0,
                        'leadershipValue' => $rowData[$columnMap['leadershipValue']] ?? 0,
                        'leadershipPercentage' => $rowData[$columnMap['leadershipPercentage']] ?? 0,
                        'workScore' => $rowData[$columnMap['workScore']] ?? 0,
                        'workValue' => $rowData[$columnMap['workValue']] ?? 0,
                        'workPercentage' => $rowData[$columnMap['workPercentage']] ?? 0,
                        'finalScore' => $rowData[$columnMap['finalScore']] ?? 0,
                        'finalGrade' => $rowData[$columnMap['finalGrade']] ?? 0,
                        'remarks' => 'TBD',
                        'status' => 0
                    ];
                }
            }
        }

        if (!empty($batchData)) {
            if (!$model->insertBatch($batchData)) {
                return $this->response->setJSON(['error' => 'Insert batch failed '.json_encode($model->errors())]);
            } else {
                return $this->response->setJSON(['success' => 'Successfully saved']);
            }
        } else {
            return $this->response->setJSON(['error' => 'No valid data found to insert.']);
        }
    }
}