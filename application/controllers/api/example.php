<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{
	function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        //$user = $this->some_model->getSomething( $this->get('id') );
        $this->load->model('user_model');
        $users = $this->user_model->get_batch('');

        /*
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!'),
		);
		*/

    	//$user = @$users[$this->get('id')];
    	
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$user = $this->some_model->getSomething( $this->get('id') );
        $this->load->model('user_model');
        $users = $this->user_model->get_batch('');

        /*
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!'),
		);
		*/

        //$user = @$users[$this->get('id')];

        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }





    function ajax_filter_services_get() {

       $key=$this->post('key');

        try {
            /*
            if ($this->privileges[PRIV_SERVICES]['view'] == FALSE) {
                throw new Exception('You do not have the required privileges for this task.');
            }
            */
            $this->load->model('services_model');
           // $key = mysql_real_escape_string($_POST['key']);
            $where =
                '(name LIKE "%' . $key . '%" OR duration LIKE "%' . $key . '%" OR ' .
                'price LIKE "%' . $key . '%" OR currency LIKE "%' . $key . '%" OR ' .
                'description LIKE "%' . $key . '%")';
            $services = $this->services_model->get_batch($where);

            $this->response($services, 200); // 200 being the HTTP response code
            echo json_encode($services);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }


    //get all from service with new price from id=2
    function services_by_id_get() {


        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $this->load->model('services_model');
        $service = $this->services_model->get_service_by_id($this->get('id'));


        if($service)
        {
            $this->response($service, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Services list could not be found'), 404);
        }
    }
}