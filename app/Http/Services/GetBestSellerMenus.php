<?php
use Illuminate\Support\Facades\DB;

class GetBestSellerMenus{

public function getBestSellerMenus()
{
    $startDate = '2024-01-01';
    $endDate = '2024-06-30';

    $results = DB::select('CALL GetBestSellerMenus(?, ?)', [$startDate, $endDate]);

    return $results;
}

}
