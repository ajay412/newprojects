<?php
class Memployee extends CI_Model
{
	
	
	     



    function showAllEmployee(){
	             $this->db->order_by('created_at','desc');
	             $this->db->where('is_active',1);
                  $this->db->order_by("id", "desc");
                $this->db->select('employee.*,apps_countries.country_name');
                $this->db->from('employee');
                $this->db->join('apps_countries', 'apps_countries.id = employee.country_id'); 
                $query = $this->db->get();
				
                return $query->result();

            }	

                  
	
	    function restoreAllEmployee()
	                {     
	     
	                $this->db->where('is_active',0);
	                $query = $this->db->get('employee');
			
					//return $query->result();
		            if($query->num_rows() > 0)
		            {
		            return $query->result();
		            }
		            else
		            {
		            return false;
		            }
	         } 
	
	   function restoreData(){
		        $this->db->where_in('employee')->update('is_active',1);
		              }
					  
					  
					  
					  
					  
	
	    public function addEmployee(){
		                            $field = array(
									'employee_name'=>$this->input->post('name'),
									'address'=>$this->input->post('address'),
									'created_at'=>date('Y-m-d H:i:s'),
									'city'=>$this->input->post('city'),
									'country_id'=>$this->input->post('country'),
										);
										
									$insertid=$this->db->insert('employee',$field);
								  $insert_id = $this->db->insert_id();
								  //return $insert_id;
								  			//$this->db->select('employee.*');
                    $this->db->select('employee.*,apps_countries.country_name,apps_countries.id cid');
                    $this->db->from('employee');
				
                   $this->db->join('apps_countries', 'apps_countries.id=employee.country_id'); 
						$this->db->where('employee.id',  $insert_id);
                    $query = $this->db->get();
					
                    return $query->row();
								
									
								
	        }
			
			
					  
	        public function editEmployee(){
		             $id = $this->input->get('id');
			
					
					//$this->db->select('employee.*');
                    $this->db->select('employee.*,apps_countries.country_name,apps_countries.id cid');
                    $this->db->from('employee');
				
                   $this->db->join('apps_countries', 'apps_countries.id=employee.country_id'); 
						$this->db->where('employee.id', $id);
                    $query = $this->db->get();
					
                    return $query->row();
		       
	             }
		
	        public function updateEmployee(){
		             $id = $this->input->post('id');
		             $field = array(
		             'employee_name'=>$this->input->post('name'),
		             'address'=>$this->input->post('address'),
					 'city'=>$this->input->post('city'),
		             'updated_at'=>date('Y-m-d H:i:s'),
				     'country_id'=>$this->input->post('country'),
		             );
			         $this->db->where('id', $id);
		            $s=$this->db->update('employee', $field);
				 
				  

		       return $s;
		             }
		    
		
	 function deleteEmployee(){
		             $id = $this->input->get('id');
				     $field = array(
		             'is_active'=>0,
		
		              );
		             $this->db->where('id', $id);
		             $this->db->update('employee',$field );
		             if($this->db->affected_rows() > 0){
			         return true;
		             }else{
			         return false;
		           }
	        }
}	


?>