<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29.09.2017
 * Time: 20:33
 */

namespace tests\unit\entities;

use core\forms\Patient\PatientForm;
use core\entities\Patient\Patient;
class PatientCreateTest extends \Codeception\Test\Unit
{
    public function testSuccess()
    {
        $first_name='Roger';
        $last_name='Rabbit';
        $address='forest';
        $city='city forest';
        $zip_code='123321';
        $patient_insurance='Medicare';
        $d_o_b='123';
        $gender='male';
        $phone1='+38(097) 967-17-48';
        $phone2='+38(097) 967-17-49';
        $phone3='+38(097) 967-17-50';
        $agency_phone='+38(097) 967-17-51';
        $agency_fax='+38(097) 967-17-52';
        $agency_name='Agency';
        $pcp_name='PCP';
        $comments='asdasdadasdasd';
        $status='All statuses';
        $do_not_fax=false;
        $medicare_number='12345';

        $form=new PatientForm();
        $form->first_name='Roger';
        $form->last_name='Rabbit';
        $form->address='forest';
        $form->city='city forest';
        $form->zip_code='123321';
        $form->patient_insurance='Medicare';
        $form->d_o_b='123';
        $form->gender='male';
        $form->phone1='+38(097) 967-17-48';
        $form->phone2='+38(097) 967-17-49';
        $form->phone3='+38(097) 967-17-50';
        $form->agency_phone='+38(097) 967-17-51';
        $form->agency_fax='+38(097) 967-17-52';
        $form->agency_name='Agency';
        $form->pcp_name='PCP';
        $form->comments='asdasdadasdasd';
        $form->status='All statuses';
        $form->do_not_fax=0;
        $form->medicare_number='12345';


        expect_that($form->validate());

        $patient = Patient::create($form);


        $patient->save();


        $this->assertEquals($first_name,$patient->first_name);
        $this->assertEquals($last_name,$patient->last_name);
        $this->assertEquals($address,$patient->address);
        $this->assertEquals($city,$patient->city);
        $this->assertEquals($zip_code,$patient->zip_code);
        $this->assertEquals($patient_insurance,$patient->patient_insurance);
        $this->assertEquals($d_o_b,$patient->d_o_b);
        $this->assertEquals($gender,$patient->gender);
        $this->assertEquals($phone1,$patient->phone1);
        $this->assertEquals($phone2,$patient->phone2);
        $this->assertEquals($phone3,$patient->phone3);
        $this->assertEquals($agency_phone,$patient->agency_phone);
        $this->assertEquals($agency_fax,$patient->agency_fax);
        $this->assertEquals($agency_name,$patient->agency_name);
        $this->assertEquals($pcp_name,$patient->pcp_name);
        $this->assertEquals($comments,$patient->comments);
        $this->assertEquals($status,$patient->status);
        $this->assertEquals($do_not_fax,$patient->do_not_fax);
        $this->assertEquals($medicare_number,$patient->medicare_number);
        expect_that($patient->save());
    }
}