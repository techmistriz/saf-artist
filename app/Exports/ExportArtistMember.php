<?php

namespace App\Exports;
use App\Models\ArtistMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ExportArtistMember implements FromCollection, WithHeadings {

	public $category_ids;
    public $individual_ids;

	public function __construct($category_ids = null, $individual_ids = null)
    {
        $this->category_ids = $category_ids;

        $this->individual_ids = $individual_ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {

    	ArtistMember::$withoutAppends = true;
        $artistMember = ArtistMember::select(        	
        	'name',
        	'email'
        );

        if ($this->category_ids && $this->individual_ids) {
            $artistMember->whereIn('category_id', $this->category_ids);
            $artistMember->whereIn('id', $this->individual_ids);
        }

        return $artistMember->get();
    }

    public function headings(): array
    {
        $arr =  [
        	'name',
        	'email'
        ];

        foreach ($arr as $key => $value) {
        	$arr[$key] = ucwords(str_replace("_", " ", $value));
        }

        return $arr;
    }

    

}
