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
            ['id' => 20, 'name' => 'National Coordinator'],
            ['id' => 30, 'name' => 'Regional Coordinator'],
            ['id' => 40, 'name' => 'Local Coordinator'],
            ['id' => 50, 'name' => 'Submitter'],
        ];
    }

    static public function get_name_by_id($id){
        if ($id == 20) return 'National Coordinator';
        if ($id == 30) return 'Regional Coordinator';
        if ($id == 40) return 'Local Coordinator';
        if ($id == 50) return 'Submitter';

        return '';
    }
}