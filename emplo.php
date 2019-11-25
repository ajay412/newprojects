<?php
        class Emplo extends CI_Controller
                {
                    function __construct()
                    {
                     parent::__construct();
                     $this->load->model('memply');
                    }


        function index()
                {       $query = $this->db->get('apps_countries');
		                if($query->num_rows() > 0)
		                {
			            $data = $query->result();
		                }
		                else
		                {
			            $data = array();
			
                        }
			            //echo "<pre>";
			             //print_r($data);exit;
			             $data1['data'] = $data;
                          $this->load->view('layout/header');
                          $this->load->view('employee/inde',$data1);
	                      $this->load->view('layout/footer');
                }

        function showAllEmployee()
	            {
	                     $result=$this->memply->showAllEmployee();
		                 echo  json_encode($result);
	            }
				
		public function addEmployee(){
					   
		                $result = $this->memply->addEmployee();
		                $msg['type'] = 'add';
		                if($result){
			           $msg['success'] = true;
		                          }
		                echo json_encode($msg);
	            }
				
				
				
	    public function editEmployee()
				    {
		                 $result = $this->memply->editEmployee();
		                 echo json_encode($result);
	                }
				
	    public function updateEmployee()
					{
		                 $result = $this->memply->updateEmployee();
		                 $msg['success'] = true;
		                 $msg['type'] = 'update';
		                 if($result)
						 {
			             $msg['success'] = false;
		                  }
		                 echo json_encode($msg);
	                }
				
				
				
}
?>