<?php

namespace App\Imports;

use App\Models\GroupMember;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class GroupMemberImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $dob = isset($row['dob']) ? Date::excelToDateTimeObject($row['dob'])->format('Y-m-d') : null;
        // dd($row);
        if (!empty($row['name'])) {
            return new GroupMember([
                'name'            => $row['name'] ?? null,
                'poc_id'          => $row['poc_id'] ?? null,
                'email'           => $row['email'] ?? null, 
                'contact'         => $row['contact'] ?? null,
                'dob'             => $dob,
                'stage_name'      => $row['stage_name'] ?? null,
                'artist_bio'      => $row['artist_bio'] ?? null,
                'instagram_url'   => $row['instagram_url'] ?? null,
                'facebook_url'    => $row['facebook_url'] ?? null,
                'linkdin_url'     => $row['linkdin_url'] ?? null,
                'twitter_url'     => $row['twitter_url'] ?? null,
                'website'         => $row['website'] ?? null,
                'status'          => $row['status'] ?? null,
            ]);
        }        
    }
}
