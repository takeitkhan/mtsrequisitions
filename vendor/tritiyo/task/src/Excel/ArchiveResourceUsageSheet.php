<?php

namespace Tritiyo\Task\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use DB;

class ArchiveResourceUsageSheet implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithTitle
{
    private $id;
    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $dates = explode(' - ', $this->date);
        // Ensure there are exactly two elements in $dates
        if (count($dates) !== 2) {
            return collect([
                [
                    'error' => 'Invalid date range format. Please provide a valid range in the format "start_date - end_date".',
                ],
            ]);
        }
        $startdate = $dates[0];
        $enddate = $dates[1];
        $user_id = $this->id;
        $resourceUsedArchive = DB::select("
                          SELECT * FROM (
                              SELECT resource_id, used FROM (
                                  SELECT task_id, resource_id, 'Used' AS used FROM `tasks_site`  WHERE (task_for BETWEEN'$startdate' AND '$enddate' ) AND resource_id IS NOT NULL GROUP BY resource_id
                                  UNION
                                  SELECT id, site_head, 'Used' AS used FROM `tasks`  where (task_for BETWEEN'$startdate' AND '$enddate' )  AND site_head IS NOT NULL
                              ) AS mm WHERE mm.resource_id IS NOT NULL
                              UNION
                                  SELECT id AS resource_id, NULL AS used   FROM users WHERE users.role = 2 AND users.employee_status  NOT IN ( 'Terminated', 'Left Job')
                          ) AS www GROUP BY www.resource_id
          ");
        $nonUsed = [];
        $used = [];
        foreach ($resourceUsedArchive as $data) {
            //dump($data->resource_id);
            if (!empty($data->resource_id) && $data->used == NULL) {

                $countSiteHead = \Tritiyo\Task\Models\Task::where('site_head', $data->resource_id)->whereBetween('task_for', array($startdate, $enddate))->groupBy('task_for')->get();
                $countResource = \Tritiyo\Task\Models\TaskSite::where('resource_id', $data->resource_id)->whereBetween('task_for', array($startdate, $enddate))->where('task_for', '!=', NULL)->groupBy('task_for')->get();

                $nonUsed[] = [
                    'id' => $data->resource_id,
                    'designation'  =>  \App\Models\User::where('id', $data->resource_id)->first()->designation ?? NULL,
                    'designationName'  =>  DB::table('designations')->where('id', \App\Models\User::where('id', $data->resource_id)->first()->designation)->first()->name ?? NULL,
                    'department' => \App\Models\User::where('id', $data->resource_id)->first()->department ?? NULL,
                    'join_date' => \App\Models\User::where('id', $data->resource_id)->first()->join_date ?? NULL,
                    'emp_no' => \App\Models\User::where('id', $data->resource_id)->first()->employee_no ?? NULL,
                    'name' => \App\Models\User::where('id', $data->resource_id)->first()->name ?? NULL,
                    'count' => count($countSiteHead)+count($countResource) ?? NULL,
                    'siteHead' =>  count($countSiteHead)  ?? NULL,
                    'Resource' => count($countResource)  ?? NULL,
                ];
            } else {

                //dd($startdate);

                $countSiteHead = \Tritiyo\Task\Models\Task::where('site_head', $data->resource_id)->whereBetween('task_for', array($startdate, $enddate))->groupBy('task_for')->get();
                $countResource = \Tritiyo\Task\Models\TaskSite::where('resource_id', $data->resource_id)->whereBetween('task_for', array($startdate, $enddate))->where('task_for', '!=', NULL)->groupBy('task_for')->get();
                $used[] = [
                    'id' => $data->resource_id,
                    'designation'  =>  \App\Models\User::where('id', $data->resource_id)->first()->designation ?? NULL,
                    'designationName'  =>  DB::table('designations')->where('id', \App\Models\User::where('id', $data->resource_id)->first()->designation)->first()->name ?? NULL,
                    'department' => \App\Models\User::where('id', $data->resource_id)->first()->department ?? NULL,
                    'join_date' => \App\Models\User::where('id', $data->resource_id)->first()->join_date ?? NULL,
                    'emp_no' => \App\Models\User::where('id', $data->resource_id)->first()->employee_no ?? NULL,
                    'name' => \App\Models\User::where('id', $data->resource_id)->first()->name ?? NULL,
                    'count' => count($countSiteHead)+count($countResource)  ?? NULL,
                    'siteHead' =>  count($countSiteHead) ?? NULL,
                    'Resource' => count($countResource)  ?? NULL,
                ];
            }
        }



        $v = [];
        usort($used, function($a, $b){
            return $a['designationName'] <=> $b['designationName'];
        });
        foreach ($used as $data) {
            //Play Role
            $joinDate =  $data['join_date'] ;
            ##$task_for = Date::stringToExcel(date('m/d/Y', strtotime($getTask->task_for))) ?? NULL;
            if( $joinDate < $enddate ) {
                $value = [];
                $v[] = [
                    $value[] = $data['emp_no'],
                    $value[] = $data['name'],
                    $value[] = $data['designationName'] ?? NULL,
                    $value[] = $data['department'] ?? NULL,
                    $value[] = $data['siteHead'],
                    $value[] = $data['Resource'],
                    $value[] = $data['count'],
                ];
            }

        }
    
            return collect([$v]);

    }

    public function headings(): array
    {
        return [
            'Emp No',
            'Name',
            'Designation',
            'Department',
            'Site Head',
            'Resource',
            'Total'
        ];
    }

    public function columnFormats(): array
    {
        return [
           // 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function title(): string
    {
        return 'Used Employee at ' . $this->date;
    }
}
