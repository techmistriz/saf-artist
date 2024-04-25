<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ExportUser implements FromCollection, WithHeadings {

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

        User::$withoutAppends = true;
        $User = User::select(           
            'name',
            'email'
        );

        if ($this->category_ids && $this->individual_ids) {
            $User->whereIn('category_id', $this->category_ids);
            $User->whereIn('id', $this->individual_ids);
        }

        return $User->get();
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
