<?php

namespace App\Enums;

final class UserType
{
    const Administrator = 1;
    const NationalCoordinator = 20;
    const RegionalCoordinator = 30;
    const LocalCoordinator = 40;
    const Submitter = 50;

    static public function all_except_admin(){
        return [
            //['id' => 1,  'name' => 'Administrator'],
            ['id' => 20, 'name' => 'Koordinator Nasional'],
            ['id' => 30, 'name' => 'Koordinator Regional'],
            ['id' => 40, 'name' => 'Koordinator Lokal'],
            ['id' => 50, 'name' => 'Submitter'],
        ];
    }

    static public function get_name_by_id($id){
        if ($id == 20) return 'Koordinator Nasional';
        if ($id == 30) return 'Koordinator Regional';
        if ($id == 40) return 'Koordinator Lokal';
        if ($id == 50) return 'Submitter';

        return '';
    }
}