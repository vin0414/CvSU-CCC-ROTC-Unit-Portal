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
            'batch'=>'is_unique[student_performance.batch_id]'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['error' => 'Grades for this batch already exists.']);
        }
        else
        {
            $file = $this->request->getFile('file');
            $batch = $this->request->getPost('batch');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $uploadPath = WRITEPATH . 'uploads/'; // Use writable/uploads directory
                $file->move($uploadPath, $newName);

                return $this->scan($uploadPath . $newName,$batch); // Pass full path
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

        $columnsToRead = ['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI'];
        $startRow = 19;
        $highestRow = $sheet->getHighestRow();
        $columnIndexes = array_flip($columnsToRead);
        $columnMap = [
            'school_id' => $columnIndexes['C'],
            'present' => $columnIndexes['D'],
            'attendanceScore' => $columnIndexes['E'],
            'attendanceValue' => $columnIndexes['F'],
            'attendancePercentage' => $columnIndexes['G'],
            'physicalScore' => $columnIndexes['H'],
            'physicalValue' => $columnIndexes['I'],
            'physicalPercentage' => $columnIndexes['J'],
            'rawScore' => $columnIndexes['K'],
            'appearanceScore' => $columnIndexes['L'],
            'appearanceValue' => $columnIndexes['M'],
            'appearancePercentage' => $columnIndexes['N'],
            'disciplineScore' => $columnIndexes['O'],
            'disciplineValue' => $columnIndexes['P'],
            'disciplinePercentage' => $columnIndexes['Q'],
            'knowledge'=>$columnIndexes['R'],
            'dependability'=>$columnIndexes['S'],
            'unselfishness'=>$columnIndexes['T'],
            'decisive'=>$columnIndexes['U'],
            'qualitiesRawScore'=>$columnIndexes['V'],
            'qualitiesScore' => $columnIndexes['W'],
            'qualitiesValue' => $columnIndexes['X'],
            'qualitiesPercentage' => $columnIndexes['Y'],
            'rawLeadershipScore' => $columnIndexes['Z'],
            'leadershipScore' => $columnIndexes['AA'],
            'leadershipValue' => $columnIndexes['AB'],
            'leadershipPercentage' => $columnIndexes['AC'],
            'workRawScore' => $columnIndexes['AD'],
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
                    log_message('warning', "No students found for student ID : {$schoolId} at row {$row}");
                    continue;
                }

                foreach ($students as $student) {
                    $batchData[] = [
                        'batch_id' => $id,
                        'student_id' => $student['student_id'],
                        'present' => $rowData[$columnMap['present']] ?? 0,
                        'attendanceScore' => $rowData[$columnMap['attendanceScore']] ?? 0,
                        'attendanceValue' => $rowData[$columnMap['attendanceValue']] ?? 0,
                        'attendancePercentage' => $rowData[$columnMap['attendancePercentage']] ?? 0,
                        'physicalScore' => $rowData[$columnMap['physicalScore']] ?? 0,
                        'physicalValue' => $rowData[$columnMap['physicalValue']] ?? 0,
                        'physicalPercentage' => $rowData[$columnMap['physicalPercentage']] ?? 0,
                        'rawScore' => $rowData[$columnMap['appearanceScore']] ?? 0,
                        'appearanceScore' => $rowData[$columnMap['appearanceScore']] ?? 0,
                        'appearanceValue' => $rowData[$columnMap['appearanceValue']] ?? 0,
                        'appearancePercentage' => $rowData[$columnMap['appearancePercentage']] ?? 0,
                        'disciplineScore' => $rowData[$columnMap['disciplineScore']] ?? 0,
                        'disciplineValue' => $rowData[$columnMap['disciplineValue']] ?? 0,
                        'disciplinePercentage' => $rowData[$columnMap['disciplinePercentage']] ?? 0,
                        'knowledge' => $rowData[$columnMap['knowledge']] ?? 0,
                        'dependability' => $rowData[$columnMap['dependability']] ?? 0,
                        'unselfishness' => $rowData[$columnMap['unselfishness']] ?? 0,
                        'decisive' => $rowData[$columnMap['decisive']] ?? 0,
                        'qualitiesRawScore' => $rowData[$columnMap['qualitiesRawScore']] ?? 0,
                        'qualitiesScore' => $rowData[$columnMap['qualitiesScore']] ?? 0,
                        'qualitiesValue' => $rowData[$columnMap['qualitiesValue']] ?? 0,
                        'qualitiesPercentage' => $rowData[$columnMap['qualitiesPercentage']] ?? 0,
                        'rawLeadershipScore' => $rowData[$columnMap['rawLeadershipScore']] ?? 0,
                        'leadershipScore' => $rowData[$columnMap['leadershipScore']] ?? 0,
                        'leadershipValue' => $rowData[$columnMap['leadershipValue']] ?? 0,
                        'leadershipPercentage' => $rowData[$columnMap['leadershipPercentage']] ?? 0,
                        'workRawScore' => $rowData[$columnMap['workRawScore']] ?? 0,
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