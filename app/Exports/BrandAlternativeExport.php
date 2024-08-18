<?php

namespace App\Exports;

use App\Models\BrandAlternative;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class BrandAlternativeExport implements FromView
{
    use Exportable;
    
    protected $ids;

    public function forIds(array $ids){
        $this->ids = $ids;
        return $this;
    }
    
    public function view(): View
    {
        return view('exports.alternatives', [
            'raws' => BrandAlternative::with('category','brands')->whereIn('id', $this->ids)->get()
        ]); 
    }
}
