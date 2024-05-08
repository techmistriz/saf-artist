<?php

namespace App\Imports;

use App\Models\GroupMember;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupMemberImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dob = date('Y-m-d', strtotime($row['dob']));
        // dd($row);
        return new GroupMember([
            'name'            => $row['name'],
            'poc_id'          => $row['poc_id'],
            'email'           => $row['email'], 
            'contact'         => $row['contact'],
            'dob'             => $dob,
            'stage_name'      => $row['stage_name'],
            'artist_bio'      => $row['artist_bio'],
            'instagram_url'   => $row['instagram_url'],
            'facebook_url'    => $row['facebook_url'],
            'linkdin_url'     => $row['linkdin_url'],
            'twitter_url'     => $row['twitter_url'],
            'website'         => $row['website'],
            'status'          => $row['status'],
        ]);
    }
}
