<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use Redirect;

class EmployeeController extends Controller
{
    public function manageEmployee()
    {
        $data = array();
        $data["title"] = "Employee Management";
        $data["employees"] = DB::table('employees')->get();

        return view('pages.employees', $data);
    }
    
    public function add()
    {
     
         $country=DB::table('countries')->get();
         return view('pages.addEmployee',compact('country'));
    }
    public function store(Request $request)
    {
         // dd($request->all());
         // exit();
        $data=array();
        $data['employee_code']=$request->employee_code;
        $data['first_name']=$request->first_name;
        $data['surname']=$request->surname;
        $data['nickname']=$request->nickname;
        $data['id_no']=$request->id_no;
        $data['passport_no']=$request->passport_no;
        $data['dob']=$request->dob;
        $data['email']=$request->email;
        $data['this_employee_is']=$request->this_employee_is;
        $data['e_is_refugee']=$request->e_is_refugee;

        //$data['passport_country']=$request->passport_country;
        $employee_id = DB::table('employees')->insertGetId($data);

        if($employee_id){

            $data2=array();
            $data2['employee_id']=$employee_id;
            //$data2['unit_number']=$request->p_unit_number;
            //$data2['complex_name']=$request->p_complex_name;
            $data2['street_name']=$request->street_name;
            //$data2['street_name']=$request->p_street_name;
            $data2['city']=$request->city;
            $data2['state']=$request->state;
            $data2['postal_code']=$request->postal_code;
            $data2['country']=$request->country;
            //$data2['created_by']=Session::get('id');
            //$data2['created_at']=date('Y-m-d h:i:s');
            $physical_address=DB::table('employee_physical_address')->insert($data2);

            $data3=array();

            $data3['employee_id']=$employee_id;
            
            //$data3['address_type']=$request->address_type;
            //$data3['unit_number']=$request->po_unit_number;
            //$data3['complex_name']=$request->po_complex_name;
            $data3['street_name']=$request->p_street;
            $data3['city']=$request->p_city;
            $data3['state']=$request->p_state;
            $data3['potal_code']=$request->p_postal;
            $data3['country']=$request->p_country;
            //$data3['country']=$request->po_country;
            
            
            $postal_address=DB::table('employee_postal_address')->insert($data3);

            $data7=array();
            $data7['employee_id']=$employee_id;
            $data7['working_hours_per_day']=$request->working_hours_per_day;
            $data7['working_days_per_week']=$request->working_days_per_week;
            $data7['estart_date']=$request->estart_date;
            $data7['e_is_paid']=$request->e_is_paid;
            $data7['weekly_wage']=$request->weekly_wage;
            $data7['working_hour_per_week']=$request->working_hour_per_week;
            $data7['annual_wage']=$request->annual_wage;
            $data7['rate_per_hour']=$request->rate_per_hour;
            $data7['fortnighlty_wage']=$request->fortnighlty_wage;
            $data7['rate_per_day']=$request->rate_per_day;
            $data7['monthly_salary']=$request->monthly_salary;
            $data7['working_hour_bi_week']=$request->working_hour_bi_week;
            $data7['bi_annual_wage']=$request->bi_annual_wage;
            $data7['bi_rate_per_day']=$request->bi_rate_per_day;
            $data7['bi_rate_per_hour']=$request->bi_rate_per_hour;
            $data7['working_hour_month']=$request->working_hour_month;
            $data7['monthly_annual_wage']=$request->monthly_annual_wage;
            $data7['monthly_rate_per_day']=$request->monthly_rate_per_day;
            $data7['monthly_rate_per_hour']=$request->monthly_rate_per_hour;
            
            $employee_wage=DB::table('employment_details')->insert($data7);

            $data5=array();
            $data5['employee_id']=$employee_id;
            $data5['emergency_contact_name']=$request->emergency_contact_name;
            $data5['emergency_contact_number1']=$request->emergency_contact_number1;
            $data5['emergency_contact_number2']=$request->emergency_contact_number2;
            
            $contact_info=DB::table('employee_contact_info')->insert($data5);

            $data4=array();
            $data4['employee_id']=$employee_id;
             
            $data4['tax_e_according_to']=$request->tax_e_according_to;
            $data4['irp5_start_date']=$request->irp5_start_date;
            $data4['directories_number_1']=$request->directories_number_1;
            $data4['directories_number_2']=$request->directories_number_2;
            $data4['directories_number_3']=$request->directories_number_3;
            $data4['income_tax_number']=$request->income_tax_number;
            $data4['voluntary_paye']=$request->voluntary_paye;
            $data4['select_a_reason']=$request->select_a_reason;
            $data4['sdl']=$request->sdl;
            $data4['oid']=$request->oid;
            
            $work_address=DB::table('employee_taxes')->insert($data4);

            

            $data6=array();
            $data6['employee_id']=$employee_id;
            $data6['pay_this_e_by']=$request->pay_this_e_by;
            $data6['account_type']=$request->account_type;
            //$data6['relationship']=$request->relationship;
            $data6['bank_name']=$request->bank_name;
            $data6['other_bank']=$request->other_bank;
            $data6['branch_name']=$request->branch_name;
            $data6['branch_code']=$request->branch_code;
            $data6['acc_holder_name']=$request->acc_holder_name;
            $data6['acc_holder_relation']=$request->acc_holder_relation;
            $data6['account_number']=$request->account_number;
            
            $bank_info=DB::table('employee_bank_info')->insert($data6);


            $data9=array();
            $data9['employee_id']=$employee_id;
            $data9['type_of_medical_aid']=$request->type_of_medical_aid;
            $data9['no_of_beneficiaries']=$request->no_of_beneficiaries;
            $data9['frequency_medical_aid']=$request->frequency_medical_aid;
            $data9['total_paid_frequency']=$request->total_paid_frequency;
            $data9['private_portion']=$request->private_portion;
            $data9['company_portion']=$request->company_portion;
            $data9['tax_credits']=$request->tax_credits;
            
            $result=DB::table('employee_medical_aid')->insert($data9);

            $data10=array();
            $data10['employee_id']=$employee_id;
            $data10['e_contributes_r1']=$request->e_contributes_r1;
            $data10['e_contributes_r11']=$request->e_contributes_r11;
            $data10['e_contributes_r111']=$request->e_contributes_r111;
            $data10['e_contributes_r2']=$request->e_contributes_r2;
            $data10['e_contributes_r22']=$request->e_contributes_r22;
            $data10['e_contributes_r3']=$request->e_contributes_r3;
            $data10['e_ra_from1']=$request->e_ra_from1;
            $data10['e_ra_from11']=$request->e_ra_from11;
            $data10['e_ra_from111']=$request->e_ra_from111;
            $data10['e_ra_from2']=$request->e_ra_from2;
            $data10['e_ra_from22']=$request->e_ra_from22;
            $data10['e_ra_from3']=$request->e_ra_from3;
            $data10['e_clearence_no1']=$request->e_clearence_no1;
            $data10['e_clearence_no11']=$request->e_clearence_no11;
            $data10['e_clearence_no111']=$request->e_clearence_no111;
            $data10['e_clearence_no2']=$request->e_clearence_no2;
            $data10['e_clearence_no22']=$request->e_clearence_no22;
            $data10['e_clearence_no3']=$request->e_clearence_no3;

            $result=DB::table('employee_private_ra')->insert($data10);
        }

        if($result){
            return redirect('/cubebooks/employee');
        }else {
            return "Something was wrong";
        }
    }
    public function editEmployee(Request $request, $id)
    {   
        $data = array();
        $data['title'] = "Employee Edit Management";
        $e_id = $id;
        $data['employees'] = DB::table('employees')->where('employee_id', $e_id)->first();
        $data['physical_address'] = DB::table('employee_physical_address')->where('employee_id', $e_id)->first();
        $data['postal_address'] = DB::table('employee_postal_address')->where('employee_id', $e_id)->first();
        $data['e_details'] = DB::table('employment_details')->where('employee_id', $e_id)->first();
        $data['contact_info'] = DB::table('employee_contact_info')->where('employee_id', $e_id)->first();
        $data['e_taxes'] = DB::table('employee_taxes')->where('employee_id', $e_id)->first();
        $data['bank_info'] = DB::table('employee_bank_info')->where('employee_id', $e_id)->first();
        $data['e_medical'] = DB::table('employee_medical_aid')->where('employee_id', $e_id)->first();
        $data['e_private'] = DB::table('employee_private_ra')->where('employee_id', $e_id)->first();
        
        return view('pages.editEmployee', $data); 
    }
    public function updateEmployee(Request $request)
    {   

        $e_id = $request->e_id;
        $private_e_id = $e_id;
        
        
            
        $data=array();
        $data['employee_code']=$request->employee_code;
        $data['first_name']=$request->first_name;
        $data['surname']=$request->surname;
        $data['nickname']=$request->nickname;
        $data['id_no']=$request->id_no;
        $data['passport_no']=$request->passport_no;
        $data['dob']=$request->dob;
        $data['start_date']=$request->start_date;
        $data['this_employee_is']=$request->this_employee_is;
        $data['e_is_refugee']=$request->e_is_refugee;

        //$data['passport_country']=$request->passport_country;
        $employees = DB::table('employees')->where('employee_id', $e_id)->update($data);

        $private=array();
            //$private['employee_id']=$e_id;
        $private['e_contributes_r1']=$request->e_contributes_r1;
        $private['e_contributes_r11']=$request->e_contributes_r11;
        $private['e_contributes_r111']=$request->e_contributes_r111;
        $private['e_contributes_r2']=$request->e_contributes_r2;
        $private['e_contributes_r22']=$request->e_contributes_r22;
        $private['e_contributes_r3']=$request->e_contributes_r3;
        $private['e_ra_from1']=$request->e_ra_from1;
        $private['e_ra_from11']=$request->e_ra_from11;
        $private['e_ra_from111']=$request->e_ra_from111;
        $private['e_ra_from2']=$request->e_ra_from2;
        $private['e_ra_from22']=$request->e_ra_from22;
        $private['e_ra_from3']=$request->e_ra_from3;
        $private['e_clearence_no1']=$request->e_clearence_no1;
        $private['e_clearence_no11']=$request->e_clearence_no11;
        $private['e_clearence_no111']=$request->e_clearence_no111;
        $private['e_clearence_no2']=$request->e_clearence_no2;
        $private['e_clearence_no22']=$request->e_clearence_no22;
        $private['e_clearence_no3']=$request->e_clearence_no3;
        $result=DB::table('employee_private_ra')->where('employee_id', $private_e_id)->update($private);



        $data2=array();
        // $data2['employee_id']=$employee_id;
        //$data2['unit_number']=$request->p_unit_number;
        //$data2['complex_name']=$request->p_complex_name;
        $data2['street_name']=$request->street_name;
        //$data2['street_name']=$request->p_street_name;
        $data2['city']=$request->city;
        $data2['state']=$request->state;
        $data2['postal_code']=$request->postal_code;
        $data2['country']=$request->country;
        //$data2['created_by']=Session::get('id');
        //$data2['created_at']=date('Y-m-d h:i:s');
        $physical_address=DB::table('employee_physical_address')->where('employee_id', $e_id)->update($data2);

        $data3=array();

        //$data3['employee_id']=$employee_id;
        
        //$data3['address_type']=$request->address_type;
        //$data3['unit_number']=$request->po_unit_number;
        //$data3['complex_name']=$request->po_complex_name;
        $data3['street_name']=$request->p_street;
        $data3['city']=$request->p_city;
        $data3['state']=$request->p_state;
        $data3['potal_code']=$request->p_postal;
        $data3['country']=$request->p_country;
        //$data3['country']=$request->po_country;
        
        
        $postal_address=DB::table('employee_postal_address')->where('employee_id', $e_id)->update($data3);

        $data7=array();
        //$data7['employee_id']=$employee_id;
        $data7['working_hours_per_day']=$request->working_hours_per_day;
        $data7['working_days_per_week']=$request->working_days_per_week;
        $data7['estart_date']=$request->estart_date;
        $data7['e_is_paid']=$request->e_is_paid;
        $data7['weekly_wage']=$request->weekly_wage;
        $data7['working_hour_per_week']=$request->working_hour_per_week;
        $data7['annual_wage']=$request->annual_wage;
        $data7['rate_per_hour']=$request->rate_per_hour;
        $data7['fortnighlty_wage']=$request->fortnighlty_wage;
        $data7['rate_per_day']=$request->rate_per_day;
        $data7['monthly_salary']=$request->monthly_salary;
        $data7['working_hour_bi_week']=$request->working_hour_bi_week;
        $data7['bi_annual_wage']=$request->bi_annual_wage;
        $data7['bi_rate_per_day']=$request->bi_rate_per_day;
        $data7['bi_rate_per_hour']=$request->bi_rate_per_hour;
        $data7['working_hour_month']=$request->working_hour_month;
        $data7['monthly_annual_wage']=$request->monthly_annual_wage;
        $data7['monthly_rate_per_day']=$request->monthly_rate_per_day;
        $data7['monthly_rate_per_hour']=$request->monthly_rate_per_hour;
        
        $employee_wage=DB::table('employment_details')->where('employee_id', $e_id)->update($data7);

        $data5=array();
        //$data5['employee_id']=$employee_id;
        $data5['emergency_contact_name']=$request->emergency_contact_name;
        $data5['emergency_contact_number1']=$request->emergency_contact_number1;
        $data5['emergency_contact_number2']=$request->emergency_contact_number2;
        
        $contact_info=DB::table('employee_contact_info')->where('employee_id', $e_id)->update($data5);

        $data4=array();
        //$data4['employee_id']=$employee_id;
         
        $data4['tax_e_according_to']=$request->tax_e_according_to;
        $data4['irp5_start_date']=$request->irp5_start_date;
        $data4['directories_number_1']=$request->directories_number_1;
        $data4['directories_number_2']=$request->directories_number_2;
        $data4['directories_number_3']=$request->directories_number_3;
        $data4['income_tax_number']=$request->income_tax_number;
        $data4['voluntary_paye']=$request->voluntary_paye;
        $data4['select_a_reason']=$request->select_a_reason;
        $data4['sdl']=$request->sdl;
        $data4['oid']=$request->oid;
        
        $work_address=DB::table('employee_taxes')->where('employee_id', $e_id)->update($data4);

        

        $data6=array();
        //$data6['employee_id']=$employee_id;
        $data6['pay_this_e_by']=$request->pay_this_e_by;
        $data6['account_type']=$request->account_type;
        //$data6['relationship']=$request->relationship;
        $data6['bank_name']=$request->bank_name;
        $data6['other_bank']=$request->other_bank;
        $data6['branch_name']=$request->branch_name;
        $data6['branch_code']=$request->branch_code;
        $data6['acc_holder_name']=$request->acc_holder_name;
        $data6['acc_holder_relation']=$request->acc_holder_relation;
        $data6['account_number']=$request->account_number;
        
        $bank_info=DB::table('employee_bank_info')->where('employee_id', $e_id)->update($data6);


        $data9=array();
        //$data9['employee_id']=$employee_id;
        $data9['type_of_medical_aid']=$request->type_of_medical_aid;
        $data9['no_of_beneficiaries']=$request->no_of_beneficiaries;
        $data9['frequency_medical_aid']=$request->frequency_medical_aid;
        $data9['total_paid_frequency']=$request->total_paid_frequency;
        $data9['private_portion']=$request->private_portion;
        $data9['company_portion']=$request->company_portion;
        $data9['tax_credits']=$request->tax_credits;
        
        $medical_aid=DB::table('employee_medical_aid')->where('employee_id', $e_id)->update($data9);

            
        

            

        

        if($medical_aid){
            return redirect('/cubebooks/employee');
        }else {
            return "Something was wrong";
        }   
    }
    public function employeeInfo(Request $request)
    {
        $c_id = $request->c_id;

        $employees = DB::table('employees')->where('employee_id', $c_id)->first();
        $physical_address=DB::table('employee_physical_address')->where('employee_id', $c_id)->first();
        $postal_address=DB::table('employee_postal_address')->where('employee_id', $c_id)->first();
        $e_details=DB::table('employment_details')->where('employee_id', $c_id)->first();
        $contact_info=DB::table('employee_contact_info')->where('employee_id', $c_id)->first();
        $e_taxes=DB::table('employee_taxes')->where('employee_id', $c_id)->first();
        $bank_info=DB::table('employee_bank_info')->where('employee_id', $c_id)->first();
        $e_medical=DB::table('employee_medical_aid')->where('employee_id', $c_id)->first();
        $e_private=DB::table('employee_private_ra')->where('employee_id', $c_id)->first();
        // dd($employees);
        // exit();

        $ren_data ='
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="'.$employees->first_name.'" >
                        <input type="hidden" name="employee_id" value="'.$c_id.'">
                
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>SurName</label>
                        <input type="text" name="surname" class="form-control" value="'.$employees->surname.'" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Known as Name</label>
                        <input type="text" name="nickname" class="form-control" value="'.$employees->nickname.'" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="timesheetinput2">RSA ID Number</label>
                    <div class="position-relative has-icon-left">
                        <input type="text" name="id_no" class="form-control" value="'.$employees->id_no.'">
                        
                    
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="timesheetinput2">Passport Number</label>
                    <div class="position-relative has-icon-left">
                        <input type="text" name="passport_no" class="form-control" value="'.$employees->passport_no.'" >
                        
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lastName2">Date of Birth:</label>
                        <input type="date" name="dob" id="" class="form-control" value="'.$employees->dob.'" required>
                        
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lastName2">Start Date:</label>
                        <input type="date" name="start_date" id="" class="form-control" value="'.$employees->start_date.'" required>
                        
                       
                    </div>
                </div>
                
                
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label>This Employee is</label>
                        <select class="select2 form-control" name="this_employee_is">
                            <option value="Asylum Seeker"> an Asylum Seeker</option>
                            <option value="Refugee">a Refugee </option>
                        </select>
                    </div>
                </div>
                
                
                
            </div>  
                                            
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="base-tab20" data-toggle="tab" aria-controls="tab20" href="#tab20" role="tab" aria-selected="true">Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab21" data-toggle="tab" aria-controls="tab21" href="#tab21" role="tab" aria-selected="false">Employment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="tab6" href="#tab6" role="tab" aria-selected="false">Emergency Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab7" data-toggle="tab" aria-controls="tab7" href="#tab7" role="tab" aria-selected="false">Payment Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" role="tab" aria-selected="false">Taxes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab8" data-toggle="tab" aria-controls="tab8" href="#tab8" role="tab" aria-selected="false">Medical Aid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Private RA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" role="tab" aria-selected="false">Payslip</a>
                        </li>
                        
                        
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div class="tab-pane active" id="tab20" role="tabpanel" aria-labelledby="base-tab20">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Physical Address</label>
                                                <input type="text" class="form-control" name="street_name" id="b_street" placeholder="Street" value="'.$physical_address->street_name.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" id="b_city" placeholder="City/Town" value="'.$physical_address->city.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="state" id="b_state" placeholder="State/Province" value="'.$physical_address->state.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="postal_code" id="b_postal" placeholder="Postal Code" value="'.$physical_address->postal_code.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="country" id="b_country" placeholder="Country" value="'.$physical_address->country.'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Postal Address</label>
                                                
                                                <input type="text" class="form-control" name="p_street" id="c_street" placeholder="Street" value="'.$postal_address->street_name.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_city" id="c_city" placeholder="City/Town" value="'.$postal_address->city.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_state" id="c_state" placeholder="State/Province" value="'.$postal_address->state.'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_postal" id="c_postal" placeholder="Postal Code" value="'.$postal_address->potal_code.'">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_country" id="c_country" placeholder="Country" value="'.$postal_address->country.'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                        </div>
                        
                        
                        <div class="tab-pane" id="tab21" role="tabpanel" aria-labelledby="base-tab21    ">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Employee is Paid</label>
                                        <select class="select2 form-control employee_pay_type" name="e_is_paid" id="select-pay-cycle">
                                            <option value="">Select Option</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="fortnightly">Fortnightly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Working Hours Per Day</label>
                                        <input type="number" id="working_hours_per_day" onkeyup="get_week_hour_sum();"  value="0" name="working_hours_per_day" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Working Days Per Week</label>
                                        <input type="number" id="working_days_per_week" onkeyup="get_week_hour_sum();" value="0" name="working_days_per_week" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="estart_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row hide" id="weekly-pay">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fixed Weekly Wage</label>
                                        <input type="text" id="weekly_wage" onkeyup="get_weekly_wage();" name="weekly_wage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Average Working Hours per week</label>
                                        <input type="text" name="working_hour_per_week" value="0" id="working_hour_per_week" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Annual Wage</label>
                                        <input type="text" id="annual_wage" onkeyup="get_annual_wage();" value="0"  name="annual_wage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rate per Day</label>
                                        <input type="text" id="rate_per_day" name="rate_per_day" value="0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rate per Hour</label>
                                        <input type="text" id="rate_per_hour" value="0"  name="rate_per_hour" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row hide" id="fortnightly-pay">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fixed Bi-Weekly Wage</label>
                                        <input type="text" id="bi_weekly_wage" onkeyup="get_weekly_wage();" name="fortnighlty_wage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Average Working Hours per Bi-Week</label>
                                        <input type="text" name="working_hour_per_week" class="form-control" id="working_hour_bi_week">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Annual Wage</label>
                                        <input type="text"  name="annual_wage" id="bi_annual_wage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rate per Day</label>
                                        <input type="text" id="bi_rate_per_day" value="0" name="rate_per_day" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rate per Hour</label>
                                        <input type="text" id="bi_rate_per_hour" value="0"   name="rate_per_hour" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row hide" id="monthly-pay">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fixed Monthly Salary</label>
                                        <input type="text" id="monthly_wage" onkeyup="get_weekly_wage();" name="monthly_salary" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Average Working Hours per Month</label>
                                        <input type="text" name="vat_reg_no" class="form-control" id="working_hour_month">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Annual Salary</label>
                                        <input type="text" id="monthly_annual_wage" name="annual_wage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rate per Day</label>
                                        <input type="text" id="monthly_rate_per_day" value="0" name="rate_per_day" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rate per Hour</label>
                                        <input type="text"  name="monthly_rate_per_hour" id="monthly_rate_per_hour" value="0"  class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab6" role="tabpanel" aria-labelledby="base-tab6">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" class="form-control" name="emergency_contact_name" id="b_street" placeholder="Contact Person">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contact Telephone Number 1</label>
                                                <input type="text" class="form-control" name="emergency_contact_number1" id="b_street" placeholder="Contact Telephone Number 1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contact Telephone Number 2</label>
                                                <input type="text" class="form-control" name="emergency_contact_number2" id="b_street" placeholder="Contact Telephone Number 2">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        
                                    </div>
                                    
                                </div>
                            </div> 
                            
                        </div>
                        <div class="tab-pane" id="tab7" role="tabpanel" aria-labelledby="base-tab7">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>I pay this employee by:</label>
                                        <select class="select2 form-control" name="pay_this_e_by" id="select-pay-terms">
                                            <option value="">Select Option</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="electronic">Electronic Transfer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row hide" id="electronic-terms">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type of Account:</label>
                                            <select class="select2 form-control" name="account_type" >
                                                <option value="">Select Option</option>
                                                <option value="">Cash</option>
                                                <option value="">Cheque</option>
                                                <option value="">Electronic</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank: <br></label>
                                            <select class="select2 form-control" name="bank_name" >
                                                <option value="">Select Option</option>
                                                <option value="">Cash</option>
                                                <option value="">Cheque</option>
                                                <option value="">Electronic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Other Bank</label>
                                            <input type="text" name="other_bank" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Code</label>
                                            <input type="text" name="branch_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" name="branch_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="text" name="account_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account holder name</label>
                                            <input type="text" name="acc_holder_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account holder relationship:</label>
                                            <select class="select2 form-control" name="acc_holder_relation" >
                                                <option value="">Select Option</option>
                                                <option value="">Cash</option>
                                                <option value="">Cheque</option>
                                                <option value="">Electronic</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tax this employee according to</label>
                                        <select class="select2 form-control" name="tax_e_according_to">
                                            <option value="1">Statutory Tables</option>
                                            <option value="2">Check</option>
                                            <option value="3">Credit</option>
                                            <option value="4">Debit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IRP5 Start Date</label>
                                        <input type="date" name="irp5_start_date" id="" class="form-control form-control-sm datepicker ren_due change_data" value="">
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Directives Number</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="directories_number_1" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="directories_number_2" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="directories_number_3" class="form-control" >
                                </div>
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Income Tax Number</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" name="income_tax_number" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Voluntary PAYE Over Deduction:</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <input type="checkbox" name="voluntary_paye" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Select a reason if this employee must not pay Unemployment Insurance (UIF):</label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2 " name="select_a_reason">
                                            <option value="1">Not Selected</option>
                                            <option value="2">Check</option>
                                            <option value="3">Credit</option>
                                            <option value="4">Debit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Skills Development levy (SDL) must not be paid for this employee:</label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="sdl" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Exclude this employee from the Occupational Injuries and Diseases (OID) report:</label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" name="oid" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab8" role="tabpanel" aria-labelledby="base-tab8">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Type of medical aid:</label>
                                        <select class="select2 form-control" name="type_of_medical_aid" id="medical-aid">
                                            <option value="private">Private</option>
                                            <option value="company">Company</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No of beneficiaries (Main member & dependant)</label>
                                        <input type="text" name="no_of_beneficiaries" class="form-control">
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Frequency Medical Aid is Paid: <br></label>
                                        <select class="select2 form-control" name="frequency_medical_aid" >
                                            <option value="">Select Option</option>
                                            <option value="">Week</option>
                                            <option value="">Cheque</option>
                                            <option value="">Electronic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Paid per frequency: </label>
                                        <input type="text" name="total_paid_frequency" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 hide" id="company-portion">
                                    <div class="form-group">
                                        <label>Copmany Portion: </label>
                                        <input type="text" name="company_portion" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4" id="private-portion">
                                    <div class="form-group">
                                        <label>Private Portion: </label>
                                        <input type="text" name="private_portion" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4" id="aid-credits">
                                    <div class="form-group">
                                        <label>Medical Aid Tax Credits:</label>
                                        <input type="text" name="tax_credits" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Private RA <br></label>
                                        <select class="select2 form-control " id="private-ra" name="payment_method" >

                                            <option value="">Select Option</option>
                                            <option value="private-ra1">1</option>
                                            <option value="private-ra2">2</option>
                                            <option value="private-ra-3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="private-r1 hide" id="ra1">
                                
                                <div class="row field_wrapper">
                                    <div class="col-md-4">
                                        
                                            <div class="form-group">
                                                <label>The Employee Contributes R</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_contributes_r1" id="b_street" placeholder="Contribution">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>per month to a retirement annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label>From:</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="date" class="form-control" name="e_ra_from1" id="" placeholder="">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>with clrearence number annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_clearence_no1" id="b_street" placeholder="Contribution">
                                            </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="private-r2 hide" id="ra2">
                                <div class="row field_wrapper">
                                    <div class="col-md-4">
                                        
                                            <div class="form-group">
                                                <label>The Employee Contributes R</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_contributes_r1" id="b_street" placeholder="Contribution">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>per month to a retirement annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label>From:</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="date" class="form-control" name="e_ra_from1" id="" placeholder="">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>with clrearence number annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_clearence_no1" id="b_street" placeholder="Contribution">
                                            </div>
                                        
                                    </div>
                                </div>
                                <div class="row field_wrapper">
                                    <div class="col-md-4">
                                        
                                            <div class="form-group">
                                                <label>The Employee Contributes R</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_contributes_r2" id="b_street" placeholder="Contribution">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>per month to a retirement annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label>From:</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="date" class="form-control" name="e_ra_from2" id="" placeholder="">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>with clrearence number annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_clearence_no2" id="b_street" placeholder="Contribution">
                                            </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="private-r3 hide" id="ra3">
                                <div class="row field_wrapper">
                                    <div class="col-md-4">
                                        
                                            <div class="form-group">
                                                <label>The Employee Contributes R</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_contributes_r1" id="b_street" placeholder="Contribution">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>per month to a retirement annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label>From:</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="date" class="form-control" name="e_ra_from1" id="" placeholder="">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>with clrearence number annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_clearence_no1" id="b_street" placeholder="Contribution">
                                            </div>
                                        
                                    </div>
                                </div>
                                <div class="row field_wrapper">
                                    <div class="col-md-4">
                                        
                                            <div class="form-group">
                                                <label>The Employee Contributes R</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_contributes_r2" id="b_street" placeholder="Contribution">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>per month to a retirement annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label>From:</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="date" class="form-control" name="e_ra_from2" id="" placeholder="">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>with clrearence number annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_clearence_no2" id="b_street" placeholder="Contribution">
                                            </div>
                                        
                                    </div>
                                </div>
                                <div class="row field_wrapper">
                                    <div class="col-md-4">
                                        
                                            <div class="form-group">
                                                <label>The Employee Contributes R</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_contributes_r3" id="b_street" placeholder="Contribution">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>per month to a retirement annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label>From:</label>
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="date" class="form-control" name="e_ra_from3" id="" placeholder="">
                                                
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <label>with clrearence number annuity</label>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                
                                                <input type="text" class="form-control" name="e_clearence_no3" id="b_street" placeholder="Contribution">
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div> 
        ';
        echo $ren_data;
    }
}
